<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\MacroController;
use App\Http\Controllers\SubMacroController;
use App\Http\Controllers\ServingSizeController;
use App\Http\Controllers\CountasController;
use App\Http\Controllers\CaloriesListController;
use App\Http\Controllers\CaloriesFieldController;
use App\Http\Controllers\SubGroupController;
use App\Http\Controllers\AssignCaloriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/group', function () {
    return view('pages.group.create');
});



Route::prefix('admin')->group(function () {
    //** Group */
    Route::prefix('group')->as('group-')->group(function () {
        Route::get('/list', [GroupController::class, 'index'])->name('list');
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::post('/store', [GroupController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [GroupController::class, 'edit'])->name('edit');
        Route::post('/update', [GroupController::class, 'update'])->name('update');
        //ajax
        Route::post('/status', [GroupController::class, 'status'])->name('status');
    });
    //** New Calories */
    Route::prefix('subgroup')->as('subgroup-')->group(function () {
            Route::get('/list', [SubGroupController::class, 'index'])->name('list');
            Route::get('/create', [SubGroupController::class, 'create'])->name('create');
            Route::post('/store', [SubGroupController::class, 'store'])->name('store');
            Route::get('/edit/{id?}', [SubGroupController::class, 'edit'])->name('edit');
            Route::post('/update', [SubGroupController::class, 'update'])->name('update');
            //ajax
        Route::post('/status', [SubGroupController::class, 'status'])->name('status');
            Route::post('/get-macro', [SubGroupController::class, 'get_macro_by_Id'])->name('get-macro');
    });
    //** Macro */
    Route::prefix('macro')->as('macro-')->group(function () {
        Route::get('/list', [MacroController::class, 'index'])->name('list');
        Route::get('/create', [MacroController::class, 'create'])->name('create');
        Route::post('/store', [MacroController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [MacroController::class, 'edit'])->name('edit');
        Route::post('/update', [MacroController::class, 'update'])->name('update');
        //ajax
        Route::post('/status', [MacroController::class, 'status'])->name('status');
    });
    //** Sub-Macro */
    Route::prefix('sub-macro')->as('sub-macro-')->group(function () {
        Route::get('/list', [SubMacroController::class, 'index'])->name('list');
        Route::get('/create', [SubMacroController::class, 'create'])->name('create');
        Route::post('/store', [SubMacroController::class,'store'])->name('store');
        Route::get('/edit/{id?}', [SubMacroController::class, 'edit'])->name('edit');
        Route::post('/update', [SubMacroController::class, 'update'])->name('update');
        //ajax
        Route::post('/status', [SubMacroController::class, 'status'])->name('status');

    });
    //** Serving size */
    Route::prefix('serving-size')->as('serving-size-')->group(function () {
        Route::get('/list', [ServingSizeController::class, 'index'])->name('list');
        Route::get('/create', [ServingSizeController::class, 'create'])->name('create');
        Route::post('/store', [ServingSizeController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [ServingSizeController::class, 'edit'])->name('edit');
        Route::post('/update', [ServingSizeController::class, 'update'])->name('update');
        //ajax
        Route::post('/status', [ServingSizeController::class, 'status'])->name('status');
    });
    //** Count as */
    Route::prefix('count-as')->as('count-as-')->group(function () {
        Route::get('/list', [CountasController::class, 'index'])->name('list');
        Route::get('/create', [CountasController::class, 'create'])->name('create');
        Route::post('/store', [CountasController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [CountasController::class, 'edit'])->name('edit');
        Route::post('/update', [CountasController::class, 'update'])->name('update');
        //ajax
        Route::post('/status', [CountasController::class, 'status'])->name('status');
    });
    //** Calories */
    Route::prefix('calories')->as('calories-')->group(function () {
        Route::get('/list', [CaloriesListController::class, 'index'])->name('list');
        Route::get('/show/{id?}', [CaloriesListController::class, 'show'])->name('show');
        Route::get('/create', [CaloriesListController::class, 'create'])->name('create');
        Route::post('/store', [CaloriesListController::class, 'store'])->name('store');
        Route::get('/edit/{id?}', [CaloriesListController::class, 'edit'])->name('edit');
        Route::post('/update', [CaloriesListController::class, 'update'])->name('update');
        //ajax
        Route::post('/status', [CaloriesListController::class, 'status'])->name('status');
        Route::post('/get-macro', [CaloriesListController::class, 'get_macro_by_Id'])->name('get-macro');
    });
    //** Calories Field */
    // Route::prefix('caloriesfield')->as('caloriesfield-')->group(function () {
        // Route::get('/list', [CaloriesFieldController::class, 'index'])->name('list');
        // Route::get('/create', [CaloriesFieldController::class, 'create'])->name('create');
        // Route::post('/store', [CaloriesFieldController::class, 'store'])->name('store');
        // Route::get('/edit/{id?}', [CaloriesFieldController::class, 'edit'])->name('edit');
        // Route::post('/update', [CaloriesFieldController::class, 'update'])->name('update');
        // //ajax
        // Route::post('/get-macro', [CaloriesFieldController::class, 'get_macro_by_Id'])->name('get-macro');
    // });
    //** Assign Calorie */
    Route::prefix('assign')->as('assign-')->group(function () {
        Route::get('/list', [AssignCaloriesController::class, 'index'])->name('list');
        // Route::get('/create', [AssignCaloriesController::class, 'create'])->name('create');
        // Route::post('/store', [AssignCaloriesController::class, 'store'])->name('store');
        // Route::get('/edit/{id?}', [AssignCaloriesController::class, 'edit'])->name('edit');
        // Route::post('/update', [AssignCaloriesController::class, 'update'])->name('update');
        //ajax
        // Route::post('/get-macro', [AssignCaloriesController::class, 'get_macro_by_Id'])->name('get-macro');
    });
});