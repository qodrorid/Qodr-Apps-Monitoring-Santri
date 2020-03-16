<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TodoJob;
use App\Models\Todo;
use App\Models\User;

use Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $todos  = Todo::where('user_id', $userId)->whereMonth('date', date('m'))->whereYear('date', date('Y'))->orderBy('date', 'desc')->get();

        $view = ($request->ajax()) ? 'list' : 'index';

        return view('pages.todo.' . $view, compact('todos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'   => 'required',
            'todo'   => 'present|array',
            'status' => 'present|array'
        ]);

        $userId = Auth::user()->id;
        $token  = Auth::user()->branch->telegram;
        $input  = $request->all();
        
        if (empty($input['todo']) or is_null($input['todo'][0])) abort(400, 'Todo required!');

        $todos = [];

        foreach ($input['status'] as $key => $status) {
            if (!is_null($input['todo'][$key])) {
                $todos[] = [
                    'status' => $status,
                    'todo'   => $input['todo'][$key]
                ];
            }
        }

        $params = [
            'user_id' => $userId,
            'date'    => $input['date']
        ];

        $data = [
            'user_id' => $userId,
            'date'    => $input['date'],
            'todo'    => json_encode($todos)
        ];

        try {
            Todo::updateOrInsert($params, $data);
            TodoJob::dispatch($params, $token);
            return $this->success('Successfuly save todo!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'todo' => 'required'
        ]);

        $data['todo'] = json_encode($request->todo);
        
        try {
            $todo->update($data);
            return $this->success('Successfuly update data setting!', $todo->todo);
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function student(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $users = User::where(function ($query) use ($request, $branchId) {
            if (!is_null($branchId)) {
                $query->where('branch_id', $branchId);
            }

            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('username', 'like', "%$request->keyword%")
                    ->orWhere('email', 'like', "%$request->keyword%");
            }
        })->where('role_id', 9)->paginate($request->showitem ?? 5);
        
        $users->appends($request->query());

        $view = $request->ajax() ? 'list-student' : 'student';

        return view('pages.todo.' . $view, compact('users'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, User $user)
    {
        $branchId = Auth::user()->branch_id;
        $userId   = $user->id;

        if ((!is_null($branchId) and $branchId !== $user->branch_id) or $user->role_id !== 9) abort(403);

        $view  = true;
        $date  = (!is_null($request->month_year)) ? $request->month_year . '-01' : date('Y-m-d');
        $todos = Todo::where('user_id', $userId)->whereMonth('date', date('m', strtotime($date)))->whereYear('date', date('Y', strtotime($date)))->orderBy('date', 'desc')->get();

        $view = ($request->ajax()) ? 'list' : 'index';

        return view('pages.todo.' . $view, compact('todos', 'view', 'userId'));
    }

}
