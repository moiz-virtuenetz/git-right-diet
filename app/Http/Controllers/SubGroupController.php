<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\SubGroup;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class SubGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subgroup = SubGroup::with('group')->get();
        // return $subgroup;
        return view('pages.sub_group.list', compact('subgroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = group::get();
        return view('pages.sub_group.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // Define validation rules for the input fields
        $rules = [
            'name' => 'required|min:3|max:25|unique:sub_groups,name',
            'group' => 'required|integer'
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not add');
        }

        // If validation passes, create a new user instance
        $subgroup = new SubGroup;
        $subgroup->name = $request->input('name');
        $subgroup->group_id = $request->input('group');
        $subgroup->created_by = 1;
        $subgroup->status = 1;

        // Save the new subgroup to the database
        $subgroup->save();

        // Redirect the user to the home page or to a success message
        return redirect()->route('subgroup-create')->with('success', 'Data added Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SubGroup $subGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        if (!is_null($id) && ctype_digit($id)) {
            $subgroup = SubGroup::find($id);
        $groups = group::get();


            if (isset($subgroup)) {
                // return $size;
                return view('pages.sub_group.edit', compact('subgroup','groups'));
            } else {
                return redirect()->route('subgroup-list')->with('warning', 'Make sure to use correct record');
            }
        } else {
            return redirect()->route('subgroup-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        // Define validation rules for the input fields
        $rules = [
            'subgroup_id' => 'required|integer',
            'name' => 'required|min:3|max:25|unique:sub_groups,name,'.$request->subgroup_id,
            'group' => 'required|integer'
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not added');
        }

        // If validation passes, create a new user instance
        $subgroup = SubGroup::find($request->subgroup_id);
        if (isset($subgroup)) {
            $subgroup->name = $request->input('name');
            // $subgroup->subgroup = $request->input('subgroup_id');
            $subgroup->group_id = $request->input('group');
            // $subgroup->created_by = 1;

            // update serving size to the database
            $subgroup->update();
            return redirect()->route('subgroup-list')->with('success', 'Data updated Successfully');
        }
        else{
            return redirect()->route('subgroup-list')->with('error', 'Data not updated');
        }

        // Redirect the user to the home page or to a success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubGroup $subGroup)
    {
        //
    }

    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $subgroup = SubGroup::find($request->subgroup_id);
        // return $request;
        if (isset($subgroup)) {
            $subgroup_update = SubGroup::where('id', $request->subgroup_id)->update(['status' => $request->subgroup_status]);
            if ($subgroup_update) {
                return redirect()->route('subgroup-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('subgroup-list')->with('warning', 'Make sure to use correct record');
        }
    }
    // 
    // 
    // 
}
