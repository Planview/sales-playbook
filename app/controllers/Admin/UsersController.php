<?php

namespace Admin;

use Response;
use Redirect;
use View;

use User;
use Role;

class UsersController extends \BaseController
{

    /**
     * Constructor, applies filters
     */
    public function __construct() {
        $this->beforeFilter('can:manage_users');
        $this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $users = User::paginate(25);

        return View::make('admin.users.index')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::optionsList();
        $user = new User();

        return View::make('admin.users.form')->with([
            'title'     => 'Create a New User',
            'action'    => 'admin.users.store',
            'user'      => $user,
            'roles'     => $roles
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        return Redirect::route('admin.users.create')
            ->withInput()
            ->withMessage("You're pretty");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($user)
    {
        //
        $roles = Role::optionsList();

        return View::make('admin.users.form')->with([
            'title'     => "Update User: {$user->username}",
            'action'    => 'admin.users.update',
            'user'      => $user,
            'roles'     => $roles
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
