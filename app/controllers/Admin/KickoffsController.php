<?php

namespace Admin;

use \Response;
use \Redirect;
use \Input;
use \View;

use \Kickoff;

class KickoffsController extends \BaseController
{
    protected $permission = 'manage_kickoffs';

    public function index()
    {
        $kickoffs = Kickoff::paginate(15);

        return View::make('admin.kickoffs.index')
            ->with('kickoffs', $kickoffs);
    }

    public function create()
    {
        return View::make('admin.kickoffs.form')
            ->with('kickoff', new Kickoff())
            ->with('title', 'Add New Kickoff Site')
            ->with('action', 'admin.kickoffs.store')
            ->with('method', 'post');
    }

    public function store()
    {
        $kickoff = new Kickoff(Input::all());

        $kickoff->name = Input::get('name', null);

        if (Input::get('active', false)) {
            Kickoff::clearActive();
            $kickoff->active = true;
        }

        if ($kickoff->save()) {
            return Redirect::route('admin.kickoffs.show', $kickoff->id)
                ->withMessage('The item has been successfully saved.');
        } else {
            return Redirect::route('admin.kickoffs.create')
                ->withError('The item could not be saved.' .
                    'Please see below for more information.')
                ->withErrors($kickoff->errors())
                ->withInput();
        }
    }

    public function show($kickoff)
    {
        return View::make('admin.kickoffs.form')
            ->with('kickoff', $kickoff)
            ->with('title', "Edit Sales Kickoff Site: {$kickoff->name}")
            ->with('action', ['admin.kickoffs.update', $kickoff->id])
            ->with('method', 'put');
    }

    public function update($kickoff)
    {
        $kickoff->fill(Input::all());

        if ($kickoff->active && !Input::get('active')) {
            return Redirect::route('admin.kickoffs.show', $kickoff->id)
                ->withError('There must be an active site.')
                ->withInput();
        } elseif (Input::get('active', false) && !$kickoff->active) {
            Kickoff::clearActive();
            $kickoff->active = true;
        }

        if ($kickoff->save()) {
            return Redirect::route('admin.kickoffs.show', $kickoff->id)
                ->withMessage('The item has been successfully updated.');
        } else {
            return Redirect::route('admin.kickoffs.show', $kickoff->id)
                ->withError('The item could not be saved.' .
                    'Please see below for more information.')
                ->withErrors($kickoff->errors())
                ->withInput();
        }
    }

    public function destroy($kickoff)
    {

    }

}
