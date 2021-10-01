<?php

use App\Http\Controllers\Tasks;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Tasks::class, 'index']);

Route::group(['prefix'=>'tasks'], function (){
    Route::post("/", [Tasks::class,'store']);
    Route::put("/{id}", [Tasks::class,'movetask']);
    Route::delete("/{id}", [Tasks::class,'destroy']);

});
