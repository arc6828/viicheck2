<?php

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
use App\Dealer;

// Route::get('/', function () {
//     $dealers = Dealer::limit(3)->get();
    
//     return view('home',compact('dealers'));
// });
// Route::get('/welcome', function () {
    
//     return view('welcome');
// });

Route::get('/', function () {
    
    return view('home_page');
});

Route::get('/home', function () {
    
    return view('home_page');
});

Route::get('/terms_of_service', function () {
    
    return view('terms_of_service');
});

Route::get('/privacy_policy', function () {
    
    return view('privacy_policy');
});

Route::resource('cars', 'CarsController');
Route::resource('profiles', 'ProfilesController');
Route::resource('services', 'ServicesController');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/b', function () {
    return view('b');
});

Route::get('/c', function () {
    return view('c');
});

Route::get('/d', function () {
    return view('d');
});

Route::get('near_location', function () {
    return view('dealers/near_location');
});


Route::get('/map', function () {
    return view('map');
});

Route::resource('dealers', 'DealersController');
Route::resource('districts', 'DistrictsController');

Route::get('/district', function () {
    return view("district/index");
});
Route::resource('mylog', 'MylogController');


// Redirect_To_ViicheckController
Route::get('/modal', 'Redirect_To_ViicheckController@modal');
Route::get('/login', 'Redirect_To_ViicheckController@login');