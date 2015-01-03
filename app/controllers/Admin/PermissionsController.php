<?php

namespace Admin;

use Input;
use Redirect;
use View;

use Permission;
use Role;

class PermissionsController extends \BaseController
{

    protected $permission = 'manage_permissions';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::paginate(25);

        return View::make('admin.permissions.index')
            ->with('permissions', $permissions);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.permissions.form')
            ->with('title', 'Create a New Permission')
            ->with('action', 'admin.permissions.store')
            ->with('method', 'post')
            ->with('roles', Role::optionsList())
            ->with('permission', new Permission());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $permission = new Permission();

        $permission->name = Input::get('name');
        $permission->display_name = Input::get('display_name');

        if ($permission->save()) {
            $permission->roles()->sync(Input::get('roles'));

            return Redirect::route('admin.permissions.show', $permission->id)
                ->withMessage('The permission has been created');
        } else {
            return Redirect::route('admin.permissions.create')
                ->withError('There were problems creating this permission. ' .
                    'See below for more details')
                ->withInput()
                ->withErrors($permission->errors());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function show($permission)
    {
        return View::make('admin.permissions.form')
            ->with('title', "Edit Permission: {$permission->display_name}")
            ->with('action', ['admin.permissions.update', $permission->id])
            ->with('method', 'put')
            ->with('roles', Role::optionsList())
            ->with('permission', $permission);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function update($permission)
    {
        $permission->name = Input::get('name');

        $permission->display_name = Input::get('display_name');

        if ($permission->save()) {
            $permission->roles()->sync(Input::get('roles'));

            return Redirect::route('admin.permissions.show', $permission->id)
                ->withMessage('The permission has been successfully updated');
        } else {
            return Redirect::route('admin.permissions.show', $permission->id)
                ->withError('The permission could not be updated. ' .
                    'See below for more information')
                ->withInput()
                ->withErrors($permission->errors());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function destroy($permission)
    {
        $permission->delete();

        return Redirect::route('admin.permissions.index')
            ->withMessage('The permission has been deleted.');
    }


}
