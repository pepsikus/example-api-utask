<?php

use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function (Request $request) {
    if ($request->expectsJson()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    } else {
        // get LoginController
    }
});

/*
Route::resources([
    'users' => 'UserController',
    'tasks' => 'TaskController'
]);
*/
