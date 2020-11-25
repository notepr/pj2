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

// laravel-router

Route::get('/', function () {
    return view('login');
})->name('login');


Route::group(['middleware' => ['CheckKey', 'PreventBackButton']], function () {
	Route::get('/home', function () {
	    return view('app');
	});

	Route::get('/logout', function() {
		setcookie("key", "", time() - 3600);
		setcookie("level", "", time() - 3600);
		return redirect()->route('login');
	});

	Route::get('{any}/logout', function() {
		setcookie("key", "", time() - 3600);
		setcookie("level", "", time() - 3600);
		return redirect()->route('login');
	})->where('any', '.*');

	// vue-router
	Route::get('{any}', function () {
    return view('app');
	})->where('any', '.*');
});

