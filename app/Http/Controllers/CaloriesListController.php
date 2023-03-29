<?php

namespace App\Http\Controllers;

use App\Models\Macro;
use App\Models\SubMacro;
use App\Models\CaloriesList;
use App\Models\group;
use App\Models\SubGroup;
use App\Models\ServingSize;
use App\Models\CaloriesField;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class CaloriesListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calories = CaloriesList::with('servingsize')->with('macro')->with('subgroup')->get();

        // return CaloriesList::with('calCaloriesField')->with('servingsize')->get();

        // return $calories;
        return view('pages.calories.list', compact('calories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subgroups = SubGroup::get();
        $macros = Macro::get();
        $servingsizes = ServingSize::get();
        return view('pages.calories.create', compact('subgroups', 'macros', 'servingsizes'));
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
            'subgroup' => 'required|integer',
            'macro' => 'required|integer',
            'food_name' => 'required|min:3|max:100|unique:calories_lists,name',
            'servingsize' => 'required|integer',
            'countas.*' => 'required|string',
            'quantity.*' => 'required|string|regex:/^\d+(\.\d{1,2})?$/',
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, create a new user instance
        $calorie = new CaloriesList;
        $calorie->subgroup_id = $request->input('subgroup');
        $calorie->macro_id = $request->input('macro');
        $calorie->name = $request->input('food_name');
        $calorie->serving = $request->input('servingsize');
        $calorie->status = 1;
        $calorie->created_by = 1;

        // Save the new group to the database
        $calorie->save();
        $calId = $calorie->getKey();

        $countasArr = $request->input('countas');
        $quantityArr = $request->input('quantity');

        if (!is_null($countasArr) && !is_null($quantityArr)) {
            if (count($countasArr) == count($quantityArr) && count($quantityArr) != 0) {
                foreach ($countasArr as $key => $value) {
                    // echo "The value of element $key is $value.<br>";

                    // echo "The arrays have equal length.";
                    $calorieField = new CaloriesField;
                    $calorieField->macro_id = $countasArr[$key];
                    $calorieField->m_qty = $quantityArr[$key];
                    $calorieField->calorie_id = $calId;

                    $calorieField->c_m_qty = 0;
                    $calorieField->c_macro_id = 0;
                    $calorieField->g_qty = 0;
                    $calorieField->group_id = 0;
                    // $calorieField->status = 1;
                    // $calorieField->created_by = 1;
                    $calorieField->save();
                }
            } else {
                if (count($countasArr) < count($quantityArr)) {
                    // echo "countasArr is less in length than quantityArr.";
                    return back()->with('warning', 'Countas not added, please select in equal length');
                } else {
                    // echo "quantityArr is less in length than countasArr.";
                    return back()->with('warning', 'Countas not added, please select in equal length');
                }
            }
        } else {
            return back()->with('warning', 'Countas not added, please select in equal length');
        }

        // Redirect the user to the home page or to a success message
        // return 'save-calorie';
        return back()->with('success', 'Action completed successfully!');
        // return redirect('/')->with('success', 'User created successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaloriesList  $caloriesList
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        
        if (!is_null($id) && ctype_digit($id)) {
            $calorie_with_details = CaloriesList::where('id', $id)->
            with('servingsize')->with('macro')->with('subgroup')->
            with('calCaloriesField')->first();
            // return $calorie_with_details;
            return view('pages.calories.show', compact('calorie_with_details'));
        } else {
            return redirect()->route('calories-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaloriesList  $caloriesList
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {

        $subgroups = SubGroup::get();
        $macros = Macro::get();
        $servingsizes = ServingSize::get();

        if (!is_null($id) && ctype_digit($id)) {
            $calorie = CaloriesList::where('id', $id)->with('calCaloriesField')->first();
            // return $calorie;
            if (isset($calorie)) {
                return view('pages.calories.edit', compact('subgroups', 'macros', 'servingsizes', 'calorie'));
            } else {
                return redirect()->route('calories-list')->with('warning', 'Make sure to use correct record');
            }
        } else {
            return redirect()->route('calories-list')->with('warning', 'Make sure to use correct record');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaloriesList  $caloriesList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;

        // Define validation rules for the input fields
        $rules = [
            'calorieList_id' => 'required|integer',
            'subgroup' => 'required|integer',
            'macro' => 'required|integer',
            'food_name' => 'required|min:3|max:100|unique:calories_lists,name,'.$request->calorieList_id,
            'servingsize' => 'required|integer',
            'countas.*' => 'required|string',
            'quantity.*' => 'required|string|regex:/^\d+(\.\d{1,2})?$/',
        ];

        // Validate the request data using the defined rules
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, create a new user instance
        $calorie = CaloriesList::where('id', $request->calorieList_id)->first();
        if (isset($calorie)) {
            $calorie->subgroup_id = $request->input('subgroup');
            $calorie->macro_id = $request->input('macro');
            $calorie->name = $request->input('food_name');
            $calorie->serving = $request->input('servingsize');
            $calorie->status = 1;
            $calorie->created_by = 1;
            $calorie->update();

            // Second step
            $countasArr = $request->input('countas');
            $quantityArr = $request->input('quantity');

            if (!is_null($countasArr) && !is_null($quantityArr)) {
                if (count($countasArr) == count($quantityArr) && count($quantityArr) != 0) {

                    CaloriesField::where('calorie_id', $request->calorieList_id)
                        ->delete();

                    foreach ($countasArr as $key => $value) {
                        // echo "The value of element $key is $value.<br>";

                        // echo "The arrays have equal length.";
                        $calorieField = new CaloriesField;
                        $calorieField->macro_id = $countasArr[$key];
                        $calorieField->m_qty = $quantityArr[$key];
                        $calorieField->calorie_id = $request->calorieList_id;

                        $calorieField->c_m_qty = 0;
                        $calorieField->c_macro_id = 0;
                        $calorieField->g_qty = 0;
                        $calorieField->group_id = 0;
                        $calorieField->save();
                    }
                } else {
                    if (count($countasArr) < count($quantityArr)) {
                        // echo "countasArr is less in length than quantityArr.";
                        return back()->with('warning', 'Countas not added, please select in equal length');
                    } else {
                        // echo "quantityArr is less in length than countasArr.";
                        return back()->with('warning', 'Countas not added, please select in equal length');
                    }
                }
            } else {
                return back()->with('warning', 'Countas not added, please select in equal length');
            }
        } else {
            //record not found
            return back()->with('warning', 'record not found!');
        }

        // Redirect the user to the home page or to a success message
        // return 'save-calorie';
        return redirect()->route('calories-list')->with('success', 'Data updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaloriesList  $caloriesList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaloriesList $caloriesList)
    {
        //
    }

    public function get_macro_by_Id(Request $request)
    {
        $data = array();
        $data['status'] = 404;
        if ((int)$request->subgroup_id) {
            $data['macros'] = Macro::where('subgroup_id', $request->subgroup_id)->get();
            // $data['submacros'] = SubMacro::where('subgroup_id',$request->subgroup_id)->get();
            $data['status'] = 200;
        }
        return response()->json($data, 200);
    }

    public function status(Request $request)
    {
        //1 for active
        //2 for disabled
        $Calories_List = CaloriesList::find($request->calorielist_id);
        // return $request;
        if (isset($Calories_List)) {
            $Calories_List_update = CaloriesList::where('id', $request->calorielist_id)->update(['status' => $request->calorielist_status]);
            if ($Calories_List_update) {
                return redirect()->route('calories-list')->with('success', 'Data updated successfully');
            }
        } else {
            return redirect()->route('calories-list')->with('warning', 'Make sure to use correct record');
        }
    }
    // 
    // 
}
