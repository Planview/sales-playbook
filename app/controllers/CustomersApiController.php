<?php

class CustomersApiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Customer::all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Response::json(Customer::with(
            'markets',
            'industry',
            'planviewSubRegionVerbose',
            'operatingRegion',
            'competitors'
        )->findOrFail($id));
    }


}
