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

Route::middleware('auth:api')->get('/user', function (Request $request) {
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
