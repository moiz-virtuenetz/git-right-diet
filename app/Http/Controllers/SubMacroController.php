<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\Macro;
use App\Models\SubMacro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubMacroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $groups = group::status()->get();
        $subMacros = SubMacro::with('group')->get();
        // return $subMacros;
        return view('pages.sub_macros.list', compact('subMacros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = group::get();
        // return $macros;
        return view('pages.sub_macros.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:100',
            'group' => 'required|integer', //group_id
        ];
        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, create a new user instance
        $submacro = new SubMacro();
        $submacro->group_id = $request->input('group');
        $submacro->name = $request->input('name');
        $submacro->status = 1;
        $submacro->created_by = 1;

        // Save the new group to the database
        $submacro->save();

        // Redirect the user to the home page or to a success message
        // return 'save-calorie';
        return back()->with('success', 'Action completed successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubMacro  $subMacro
     * @return \Illuminate\Http\Response
     */
    public function show(SubMacro $subMacro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubMacro  $subMacro
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        if (!is_null($id) && ctype_digit($id)) {
            $submacro = SubMacro::find($id);
            $groups = group::get();

            if (isset($submacro)) {
                // return $submacro;
                return view('pages.sub_macros.edit', compact('submacro','groups'));
            } else {
                return redirect()->route('sub-macro-list')->with('warning', 'Make sure to use correct record');
            }
        } else {
            return redirect()->route('sub-macro-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubMacro  $subMacro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        // Define validation rules for the input fields
        $rules = [
            'submacro_id' => 'required|integer',
            'name' => 'required|min:3|max:100',
            'group' => 'required|integer', //group_id
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validation failed');
        }

        // If validation passes, create a new user instance
        $submacro = SubMacro::find($request->submacro_id);
        if (isset($submacro)) {
            $submacro->name = $request->input('name');
            $submacro->group_id = $request->input('group');
            // $group->created_by = 1;
            // Save the new group to the database
            $submacro->update();
            return redirect()->route('sub-macro-list')->with('success', 'Data update successfully');
        } else {
            return redirect()->route('sub-macro-list')->with('error', 'Data not updated');
        }

        // Redirect the user to the home page or to a success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMacro  $subMacro
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMacro $subMacro)
    {
        //
    }

    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $submacro = SubMacro::find($request->submacro_id);
        // return $request;
        if (isset($submacro)) {
            $submacro_update = SubMacro::where('id', $request->submacro_id)->update(['status' => $request->submacro_status]);
            if ($submacro_update) {
                return redirect()->route('sub-macro-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('sub-macro-list')->with('warning', 'Make sure to use correct record');
        }
    }
    // 
    // 
    // 
}
