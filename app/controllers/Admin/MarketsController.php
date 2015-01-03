<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use \Market;

class MarketsController extends \BaseController
{

    protected $permission = 'manage_playbook_meta';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $markets = Market::paginate(25);

        return View::make('admin.markets.index')
            ->with('markets', $markets);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.markets.form')
            ->with('title', 'Add New Market')
            ->with('action', 'admin.markets.store')
            ->with('method', 'post')
            ->with('market', new Market());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $market = Market::create(Input::all());

        if ($market->save()) {
            return Redirect::route('admin.markets.show', $market->id)
                ->withMessage('The market has been successfully created.');
        } else {
            return Redirect::route('admin.markets.create')
                ->withError('The market could not be saved. ' .
                    'See below for more information.')
                ->withErrors($market->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  Market  $market
     * @return Response
     */
    public function show($market)
    {
        return View::make('admin.markets.form')
            ->with('title', "Edit Market: {$market->name}")
            ->with('action', ['admin.markets.update', $market->id])
            ->with('method', 'put')
            ->with('market', $market);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Market  $market
     * @return Response
     */
    public function update($market)
    {
        $market->name = Input::get('name');

        if ($market->save()) {
            return Redirect::route('admin.markets.show', $market->id)
                ->withMessage('The market was successfully updated');
        } else {
            return Redirect::route('admin.markets.show', $market->id)
                ->withError('The market could not be saved. ' .
                    'See below for more information.')
                ->withErrors($market->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Market  $market
     * @return Response
     */
    public function destroy($market)
    {
        $market->delete();

        return Redirect::route('admin.markets.index')
            ->withMessage('The item has been deleted');
    }


}
