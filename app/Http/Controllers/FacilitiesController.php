<?php

namespace App\Http\Controllers;

use App\model\facilities;
use Illuminate\Http\Request;
class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities=facilities::all();
        return view('backend.pages.facilities')->with('facilities',$facilities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function show(facilities $facilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function edit(facilities $facilities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, facilities $facilities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function destroy(facilities $facilities)
    {
        //
    }
}
