<?php

namespace App\Http\Controllers;

use App\Models\CaloriesField;
use Illuminate\Http\Request;

class CaloriesFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->input('data');
        return $data;
        //
        $calorieField = new CaloriesField;
        $calorieField->submacro_id = $request->input('sub_macro');
        $calorieField->macro_id = $request->input('macro');
        $calorieField->food_name = $request->input('food_name');
        $calorieField->serving = $request->input('serving');
        $calorieField->count_as = $request->input('count_as');
        $calorieField->status = 1;
        $calorieField->created_by = 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaloriesField  $caloriesField
     * @return \Illuminate\Http\Response
     */
    public function show(CaloriesField $caloriesField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaloriesField  $caloriesField
     * @return \Illuminate\Http\Response
     */
    public function edit(CaloriesField $caloriesField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaloriesField  $caloriesField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaloriesField $caloriesField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaloriesField  $caloriesField
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaloriesField $caloriesField)
    {
        //
    }
}
