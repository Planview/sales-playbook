<?php

namespace Admin;

use Response;
use Redirect;
use View;
use App;
use Input;
use Config;
use Mail;
use Lang;

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
            'roles'     => $roles,
            'method'    => 'post'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Input::has('roles')) {
                $user->roles()->sync(Input::get('roles'));
            }

            if (null === Input::get('auto_confirm') && Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            } else {
                $user->confirm();
            }

            return Redirect::action('admin.users.show', $user->id)
                ->with('message', "The user {$user->username} was successfully created");
        } else {
            \Log::info($user->errors());
            $error = $user->errors()->all(':message');

            return Redirect::route('admin.users.create')
                ->withInput(Input::except('password'))
                ->withError('There was a problem with your submission. ' .
                    'See below for more information')
                ->with('form_errors', $user->errors());
        }
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
            'action'    => ['admin.users.update', $user->id],
            'user'      => $user,
            'roles'     => $roles,
            'method'    => 'put'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($user)
    {
        return Redirect::route('admin.users.show', $user->id)
            ->withInput()
            ->withMessage("You're pretty");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user)
    {
        $username = $user->username;
        $user->delete();

        return Redirect::route('admin.users.index')
            ->withMessage("The user $username has been deleted.");
    }

}
