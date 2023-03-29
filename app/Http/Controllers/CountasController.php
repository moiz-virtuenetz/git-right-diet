<?php

namespace App\Http\Controllers;

use App\Models\Countas;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class CountasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countas = Countas::get();
        return view('pages.countas.list', compact('countas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.countas.create');
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
            'name' => 'required|min:3|max:25|unique:countas,name'
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not added');
        }

        // If validation passes, create a new user instance
        $count = new Countas;
        $count->name = $request->input('name');
        $count->created_by = 1;
        $count->status = 1;

        // Save the new count to the database
        $count->save();

        // Redirect the user to the home page or to a success message
        return redirect()->route('count-as-create')->with('success', 'Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Countas  $countas
     * @return \Illuminate\Http\Response
     */
    public function show(Countas $countas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Countas  $countas
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        if (!is_null($id) && ctype_digit($id)) {
            $countas = Countas::find($id);

            if (isset($countas)) {
                // return $size;
                return view('pages.countas.edit', compact('countas'));
            } else {
                return redirect()->route('count-as-list')->with('warning', 'Make sure to use correct record');
            }
        } else {
            return redirect()->route('count-as-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Countas  $countas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        // Define validation rules for the input fields
        $rules = [
            'name' => 'required|min:3|max:25|unique:countas,name',
            'countas_id' => 'required|integer'
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not added');
        }

        // If validation passes, create a new user instance
        $countas = Countas::find($request->countas_id);
        if (isset($countas)) {
            $countas->name = $request->input('name');
            // $countas->created_by = 1;

            // update serving size to the database
            $countas->update();
            return redirect()->route('count-as-list')->with('success', 'Data updated Successfully');
        }
        else{
            return redirect()->route('count-as-list')->with('error', 'Data not updated');
        }

        // Redirect the user to the home page or to a success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Countas  $countas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countas $countas)
    {
        //
    }
    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $count = Countas::find($request->countas_id);
        // return $request;
        if (isset($count)) {
            $count_update = Countas::where('id', $request->countas_id)->update(['status' => $request->countas_status]);
            if ($count_update) {
                return redirect()->route('count-as-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('count-as-list')->with('warning', 'Make sure to use correct record');
        }
    }
    // 
    // 
    // 
}
