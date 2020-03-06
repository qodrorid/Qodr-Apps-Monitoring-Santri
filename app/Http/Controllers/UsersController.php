<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('username', 'like', "%$request->keyword%")
                    ->orWhere('email', 'like', "%$request->keyword%");
            }
        })->where('role_id', '!=', 1)->paginate($request->showitem ?? 5);

        $users->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.users.' . $view, compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required',
            'username' => 'required',
            'password' => 'required',
            'role_id'  => 'required'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        try {
            User::create($data);
            return $this->success('Successfuly create new user!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::select('name', 'username', 'email', 'password', 'role_id', 'branch_id')->find($id);
        return $this->success('Successfuly get data user!', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required',
            'username'     => 'required',
            'email'        => 'required',
            'role_id'      => 'required'
        ]);

        if (
            ($request->role_id != 1 and $request->role_id != 2) and
            $request->branch_id === null
        ) abort(404);
        
        $data = $request->all();
        $data['branch_id'] = $request->branch_id;
        
        try {
            $user->update($data);
            return $this->success('Successfuly update data user!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return $this->success('Successfuly delete user!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Verify User
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verified(User $user)
    {
        try {
            $user->email_verified_at = now();
            $user->update();
            return $this->success('Successfuly verified user!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'new_password'     => 'required',
            'confirm_password' => 'required'
        ]);

        if ($request->new_password !== $request->confirm_password) 
        return $this->error(400, 'Password not match!');

        try {
            $user->password = bcrypt($request->confirm_password);
            $user->update();
            return $this->success('Successfuly reset passwrd user!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

}
