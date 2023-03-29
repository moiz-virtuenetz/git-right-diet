<?php

namespace App\Http\Controllers;

use App\Models\Macro;
use App\Models\group;
use App\Models\SubGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMacroRequest;
use App\Http\Requests\UpdateMacroRequest;
use Illuminate\Support\Facades\Validator;

class MacroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $macros = Macro::with('subgroup')->get();
        return view('pages.macros.list', compact('macros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subgroups = SubGroup::get();
        // return 'macro-create';
        return view('pages.macros.create', compact('subgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMacroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        // Define validation rules for the input fields
        $rules = [
            'subgroup' => 'required|integer',
            'macro_name' => 'required|min:3|max:45|unique:macros,name',
            'countas' => 'required|min:3|max:45',
            'carbohydrate' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'protein' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'fat' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'calories' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];

        // $messages = [
        //     'price.regex' => 'The price field must be a valid decimal number with up to two decimal places.',
        //     'price.regex' => 'The price field must be a valid decimal number with up to two decimal places.',
        // ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, create a new user instance
        $macro = new Macro;
        $macro->subgroup_id = $request->input('subgroup');
        $macro->name = $request->input('macro_name');
        $macro->carbohydrate = $request->input('carbohydrate');
        $macro->protein = $request->input('protein');
        $macro->fat = $request->input('fat');
        $macro->calories = $request->input('calories');
        $macro->countas = $request->input('countas');
        $macro->status = 1;
        $macro->created_by = 1;

        // Save the new group to the database
        $macro->save();

        // Redirect the user to the home page or to a success message
        // return 'save-macro';
        return redirect()->route('macro-create')->with('success', 'Data updated Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function show(Macro $macro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        if (!is_null($id) && ctype_digit($id)) {
            $subgroups = SubGroup::get();
            $macro = Macro::find($id);
            return view('pages.macros.edit', compact('macro', 'subgroups'));
        } else {
            return redirect()->route('macro-list')->with('warning', 'Make sure to use correct record');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMacroRequest  $request
     * @param  \App\Models\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;

        // Define validation rules for the input fields
        $rules = [
            'macro_id' => 'required|integer',
            'subgroup' => 'required|integer',
            'macro_name' => 'required|min:3|max:45|unique:macros,name,'.$request->macro_id,
            'countas' => 'required|min:3|max:45',
            'carbohydrate' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'protein' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'fat' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'calories' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, create a new user instance
        $macro = Macro::find($request->macro_id);
        // return $macro;
        if ($macro) {
            $macro->subgroup_id = $request->input('subgroup');
            $macro->name = $request->input('macro_name');
            $macro->carbohydrate = $request->input('carbohydrate');
            $macro->protein = $request->input('protein');
            $macro->fat = $request->input('fat');
            $macro->calories = $request->input('calories');
            $macro->countas = $request->countas;
            // $macro->created_by = 1;
            // Save the new group to the database
            $macro->update();
            return redirect()->route('macro-list')->with('success', 'Data updated successfully!');
        } else {
            return redirect()->route('macro-list')->with('error', 'Data update failed!');
        }

        // Redirect the user to the home page or to a success message

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Macro $macro)
    {
        //
    }

    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $macro = Macro::find($request->macro_id);
        // return $request;
        if (isset($macro)) {
            $macro_update = Macro::where('id', $request->macro_id)->update(['status' => $request->macro_status]);
            if ($macro_update) {
                return redirect()->route('macro-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('macro-list')->with('warning', 'Make sure to use correct record');
        }
    }
    /**
     * 
     * 
     * 
     */
}
