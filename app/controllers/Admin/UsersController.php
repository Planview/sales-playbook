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

    protected $permission = 'manage_users';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$users = User::paginate(25);
        $users = User::orderBy('username', 'asc')->paginate(100);

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
        $password = '';

        $user = new User();

        $user->username = Input::get('username');
        $user->email    = Input::get('email');
        $user->confirmation_code = md5(uniqid(mt_rand(), true));

        if (Input::get('auto_password', false)) {
            $password = $user->autoGeneratePassword();
        } else {
            $user->password = Input::get('password');
            $user->password_confirmation = Input::get('password_confirmation');
        }

        if ($user->save()) {
            if (Input::has('roles')) {
                $user->roles()->sync(Input::get('roles'));
            }

            if (Input::get('auto_password', false)) {
                $user->confirm();

                Mail::send(
                    'emails.auth.auto-password', ['user' => $user, 'password' => $password],
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject('Your Planview Sales Site Credentials');
                    });
            } elseif (null === Input::get('auto_confirm') && Config::get('confide::signup_email')) {
                Mail::send(
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
            $error = $user->errors()->all(':message');

            return Redirect::route('admin.users.create')
                ->withInput(Input::except('password'))
                ->withError('There was a problem with your submission. ' .
                    'See below for more information')
                ->withErrors($user->errors());
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
        if (Input::has('email')) {
            $user->email = Input::get('email');
        }

        if (Input::has('password')) {
            $user->password = Input::get('password');
            $user->password_confirmation = Input::get('password_confirmation');
        }

        if (Input::has('roles')) {
            $user->roles()->sync(Input::get('roles'));
        }

        $result = $user->save();

        if ($result) {
            return Redirect::route('admin.users.show', $user->id)
                ->withMessage('The user has been updated');
        } else {
            return Redirect::route('admin.users.show', $user->id)
                ->withInput(Input::except('password'))
                ->withError('There was a problem with your submission. ' .
                    'See below for more information')
                ->withErrors($user->errors());
        }
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
