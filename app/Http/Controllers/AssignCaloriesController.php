<?php

namespace App\Http\Controllers;

use App\Models\AssignCalories;
use App\Models\CaloriesList;
use App\Models\Macro;
use App\Models\group;
use App\Models\SubGroup;
use Illuminate\Http\Request;

class AssignCaloriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allGroups = group::with('calSubgroup')->get();
        // return $allGroups;
        // $calorie_with_details = CaloriesList::with('servingsize')->with('group')->
        // with('macro')->with('macros')->get();
        // $all_groups = group::get();
        // $all_subgroup = SubGroup::get();
        // $all_macros = Macro::get();
        // // return $all_subgroup;
        // // return $calorie_with_details;
        return view('pages.new_calories.list', compact('allGroups'));
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
     * @param  \App\Models\AssignCalories  $assignCalories
     * @return \Illuminate\Http\Response
     */
    public function show(AssignCalories $assignCalories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignCalories  $assignCalories
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignCalories $assignCalories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignCalories  $assignCalories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignCalories $assignCalories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignCalories  $assignCalories
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignCalories $assignCalories)
    {
        //
    }
}
