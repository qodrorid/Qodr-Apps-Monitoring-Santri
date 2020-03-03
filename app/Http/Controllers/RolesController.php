<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('description', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $roles->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.roles.' . $view, compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Role::select('name', 'description')->find($id);
        return $this->success('Successfuly get data role!', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        try {
            $role->update($request->all());
            return $this->success('Successfuly update data role!');
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
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return $this->success('Successfuly delete role!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

}
