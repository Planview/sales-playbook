<?php

namespace Admin;

use Input;
use Redirect;
use View;

use Permission;

class PermissionsController extends \BaseController {

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
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function show($permission)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function update($permission)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return Response
     */
    public function destroy($permission)
    {
        //
    }


}
