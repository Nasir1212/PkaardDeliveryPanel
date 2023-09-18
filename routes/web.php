<?php

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

Route::get("/redelivery/{id}","App\Http\Controllers\HomeController@redelivery");
Route::get("/card_register/{regi_no}","App\Http\Controllers\HomeController@card_register");
Route::get("/show_return_card","App\Http\Controllers\HomeController@show_return_card");
Route::get("/all_picked_card","App\Http\Controllers\HomeController@all_picked_card");
Route::get("/all_picked_card_by_search/{card_no}","App\Http\Controllers\HomeController@all_picked_card_by_search");
Route::get("/show_all_packing_card","App\Http\Controllers\HomeController@show_all_packing_card");
Route::get("/get_card_delivery","App\Http\Controllers\HomeController@get_card_delivery");
Route::get("/show_all_packing_card_by_search/{card_no}","App\Http\Controllers\HomeController@show_all_packing_card_by_search");
Route::get("/unpacking_card/{id}","App\Http\Controllers\HomeController@unpacking_card");
Route::post("/handle_packing","App\Http\Controllers\HomeController@handle_packing");
Route::post("/paid_input","App\Http\Controllers\HomeController@paid_input");



// View Router 

Route::get('/', function () {
    return view('Home.home');
});

Route::get('/delivery_status', function () {
    return view('DeliveryStatus.delivery_status');
});

Route::get('/card_return', function () {
    return view('CardReturn.card_return');
});


Route::get('/signup', function () {
    return view('signup');
});


Route::get('/login', function () {
    return view('login');
});


// View Router 

