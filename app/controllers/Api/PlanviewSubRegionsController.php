<?php

namespace Api;

use PlanviewSubRegion;
use Response;

class PlanviewSubRegionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(PlanviewSubRegion::orderBy('name')->with('planviewRegion')->get());
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(PlanviewSubRegion::with('planviewRegion')->findOrFail($id));
	}


}
