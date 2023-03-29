<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $groups = group::status()->get();
        $groups = group::get();
        return view('pages.group.list', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.group.create');
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
            'group_name' => 'required|min:3|max:25|unique:groups,name',
            'carbohydrate' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'protein' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'fat' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'calories' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not add');
        }

        // If validation passes, create a new user instance
        $group = new group;
        $group->name = $request->input('group_name');
        $group->carbohydrate = $request->input('carbohydrate');
        $group->protein = $request->input('protein');
        $group->fat = $request->input('fat');
        $group->calories = $request->input('calories');
        $group->created_by = 1;
        $group->status = 1;

        // Save the new group to the database
        $group->save();

        // Redirect the user to the home page or to a success message
        return redirect()->route('group-create')->with('success', 'Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        if (!is_null($id) && ctype_digit($id)) {
            $group = group::find($id);
            return view('pages.group.edit', compact('group'));
        } else {
            return redirect()->route('group-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        // Define validation rules for the input fields
        $rules = [
            'group_id' => 'required|integer',
            // 'group_name' => 'required|min:3|max:25|unique:groups,name',
            'group_name' => 'required|min:3|max:25|unique:groups,name,'.$request->group_id,
            'carbohydrate' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'protein' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'fat' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'calories' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not added');
        }

        // If validation passes, create a new user instance
        $group = group::find($request->group_id);
        if (isset($group)) {
            $group->name = $request->input('group_name');
            $group->carbohydrate = $request->input('carbohydrate');
            $group->protein = $request->input('protein');
            $group->fat = $request->input('fat');
            $group->calories = $request->input('calories');
            // $group->created_by = 1;

            // Save the new group to the database
            $group->update();
            return redirect()->route('group-list')->with('success', 'Data updated Successfully');
        }
        else{
            return redirect()->route('group-list')->with('error', 'Data not updated');
        }

        // Redirect the user to the home page or to a success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(group $group)
    {
        //
    }

    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $group = group::find($request->group_id);
        // return $request;
        if (isset($group)) {
            $group_update = group::where('id', $request->group_id)->update(['status' => $request->group_status]);
            if ($group_update) {
                return redirect()->route('group-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('group-list')->with('warning', 'Make sure to use correct record');
        }
    }
}
