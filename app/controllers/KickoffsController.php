<?php

class KickoffsController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /kickoffs
     *
     * @return Response
     */
    public function index()
    {
        return Redirect::route('kickoff.show', Kickoff::getActive()->name);
    }

    /**
     * Display the specified resource.
     * GET /kickoffs/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($kickoff)
    {
        return $this->makePage($kickoff, 'home');
    }

    public function showPage($kickoff, $pageSlug)
    {
        return $this->makePage($kickoff, $pageSlug);
    }

    public function makePage($kickoff, $pageSlug)
    {
        return $kickoff->pageBySlug($pageSlug)->buildPage();
    }
}
