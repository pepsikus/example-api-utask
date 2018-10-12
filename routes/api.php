<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'API\Auth\RegisterController@register');
Route::post('login', 'API\Auth\LoginController@login');
Route::post('logout', 'API\Auth\LoginController@logout');

Route::get('login', function (Request $request) {
    return response()->json(['error' => 'Unauthenticated'], 401);
});

Route::get('unauthenticated', function (Request $request) {
    return response()->json(['error' => 'Unauthenticated'], 401);
})->name('api.unauthenticated');

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::apiResources([
        'users' => 'API\UserController',
        'tasks' => 'API\TaskController',
    ]);

    // Get all user tasks
    Route::get('users/{user}/tasks', [
            'uses' => '\App\Http\Controllers\API\UserController@tasks',
            'as' => 'users.tasks',
        ]);

    // Verify user email
    Route::put('users/{user}/verify_email', [
            'uses' => '\App\Http\Controllers\API\UserController@verifyEmail',
            'as' => 'users.verify_email',
        ]);

    // Completing the task
    Route::put('tasks/{task}/complete', [
            'uses' => '\App\Http\Controllers\API\TaskController@complete',
            'as' => 'tasks.complete',
        ]);
});
