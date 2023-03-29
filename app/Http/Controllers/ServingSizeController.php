<?php

namespace App\Http\Controllers;

use App\Models\ServingSize;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ServingSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servingsizes = ServingSize::get();
        return view('pages.servingsize.list', compact('servingsizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.servingsize.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define validation rules for the input fields
        $rules = [
            'name' => 'required|min:3|max:25|unique:serving_sizes,name'
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not add');
        }

        // If validation passes, create a new user instance
        $size = new ServingSize;
        $size->name = $request->input('name');
        $size->created_by = 1;
        $size->status = 1;

        // Save the new size to the database
        $size->save();

        // Redirect the user to the home page or to a success message
        return redirect()->route('serving-size-create')->with('success', 'Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServingSize  $servingSize
     * @return \Illuminate\Http\Response
     */
    public function show(ServingSize $servingSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServingSize  $servingSize
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        if (!is_null($id) && ctype_digit($id)) {
            $servingsize = ServingSize::find($id);

            if (isset($servingsize)) {
                // return $size;
                return view('pages.servingsize.edit', compact('servingsize'));
            } else {
                return redirect()->route('serving-size-list')->with('warning', 'Make sure to use correct record');
            }
        } else {
            return redirect()->route('serving-size-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServingSize  $servingSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        // Define validation rules for the input fields
        $rules = [
            'size_id' => 'required|integer',
            'name' => 'required|min:3|max:25|unique:serving_sizes,name,'.$request->size_id
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data not added');
        }

        // If validation passes, create a new user instance
        $servingsize = ServingSize::find($request->size_id);
        if (isset($servingsize)) {
            $servingsize->name = $request->input('name');
            // $servingsize->created_by = 1;

            // update serving size to the database
            $servingsize->update();
            return redirect()->route('serving-size-list')->with('success', 'Data updated Successfully');
        }
        else{
            return redirect()->route('serving-size-list')->with('error', 'Data not updated');
        }

        // Redirect the user to the home page or to a success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServingSize  $servingSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServingSize $servingSize)
    {
        //
    }

    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $servingsize = ServingSize::find($request->serving_id);
        // return $request;
        if (isset($servingsize)) {
            $servingsize_update = ServingSize::where('id', $request->serving_id)->update(['status' => $request->serving_status]);
            if ($servingsize_update) {
                return redirect()->route('serving-size-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('serving-size-list')->with('warning', 'Make sure to use correct record');
        }
    }
    // 
    // 
    // 
}
