<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

use App\Notifications\TelegramNotif;

use Notification;
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
        $todos  = Todo::where('user_id', $userId)->whereMonth('date', date('m'))->orderBy('date', 'desc')->get();

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

        $input = $request->all();
        
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
            'user_id' => Auth::user()->id,
            'date'    => $input['date']
        ];

        $data = [
            'user_id' => Auth::user()->id,
            'date'    => $input['date'],
            'todo'    => json_encode($todos)
        ];

        try {
            $todo = Todo::updateOrInsert($params, $data);

            Notification::send($todo, new TelegramNotif());
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

}
