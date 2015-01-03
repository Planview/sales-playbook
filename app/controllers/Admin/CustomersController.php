<?php

namespace Admin;

use \View;
use \Response;
use \Redirect;
use \Input;

use \Customer;

class CustomersController extends \BaseController
{

    public $permission = 'manage_playbook';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $customers = Customer::with([
            'industry',
            'markets',
            'planviewSubRegionVerbose',
            'operatingRegion',
            'competitors'
        ])->paginate(25);

        return View::make('admin.customers.index')
            ->with('customers', $customers);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.customers.form')
            ->with('title', 'Add New Customer')
            ->with('action', 'admin.customers.store')
            ->with('method', 'post')
            ->with('customer', new Customer());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $customer = new Customer(Input::all());

        if ($customer->save()) {
            $customer->markets()->sync(Input::get('markets'));
            $customer->competitors()->sync(Input::get('competitors'));

            return Redirect::route('admin.customers.show', $customer->id)
                ->withMessage('The item has been successfully created.');
        } else {
            return Redirect::route('admin.customers.create')
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($customer->errors())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  Customer     $customer
     * @return Response
     */
    public function show($customer)
    {
        return View::make('admin.customers.form')
            ->with('title', "Edit Customer: {$customer->name}")
            ->with('action', ['admin.customers.update', $customer->id])
            ->with('method', 'put')
            ->with('customer', $customer);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Customer     $customer
     * @return Response
     */
    public function update($customer)
    {
        $customer->fill(Input::all());

        if ($customer->save()) {
            $customer->markets()->sync(Input::get('markets'));
            $customer->competitors()->sync(Input::get('competitors'));

            return Redirect::route('admin.customers.show', $customer->id)
                ->withMessage('The item has been successfully updated.');
        } else {
            return Redirect::route('admin.customers.show', $customer->id)
                ->withError('The item could not be saved. ' .
                    'See below for more information.')
                ->withErrors($customer->errors())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer     $customer
     * @return Response
     */
    public function destroy($customer)
    {
        $customer->delete();

        return Redirect::route('admin.customers.index')
            ->withMessage('The item has been deleted.');
    }


}
