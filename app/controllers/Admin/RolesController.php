<?php

namespace Admin;

use View;
use Redirect;
use Input;

use Role;

class RolesController extends \BaseController {

    protected $permission = 'manage_roles';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::paginate(25);

        return View::make('admin.roles.index')
            ->with('roles', $roles);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.roles.form')
            ->with('title', 'Create a New Role')
            ->with('action', 'admin.roles.store')
            ->with('method', 'post')
            ->with('role', new Role());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $role = new Role();

        $role->name = Input::get('name');

        if ($role->save()) {
            return Redirect::route('admin.roles.show', $role->id)
                ->withMessage('The role has been created');
        } else {
            return Redirect::route('admin.roles.create')
                ->withError('The role could not be created. See the errors below')
                ->withErrors($role->errors());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $role
     * @return Response
     */
    public function show($role)
    {
        return View::make('admin.roles.form')
            ->with('title', 'Edit Role: ' . $role->name)
            ->with('action', ['admin.roles.update', $role->id])
            ->with('method', 'put')
            ->with('role', $role);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $role
     * @return Response
     */
    public function update($role)
    {
        $role->name = Input::get('name');

        if ($role->save()) {
            return Redirect::route('admin.roles.show', $role->id)
                ->withMessage('The role has been successfully updated');
        } else {
            return Redirect::route('admin.roles.show', $role->id)
                ->withError('The role could not be saved. See below for more information')
                ->withErrors($role->errors());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $role
     * @return Response
     */
    public function destroy($role)
    {
        $role->delete();

        return Redirect::route('admin.roles.index')
            ->withMessage('The role has been deleted');
    }


}
