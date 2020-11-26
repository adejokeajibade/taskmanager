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

// Redprint Auth Route
// You can implement your own Auth endpoint and method
Route::post(
    'permissible/auth/token',
    '\Shahnewaz\Permissible\Http\Controllers\API\AuthController@postAuthenticate'
)->name('permissible.auth.token');

// API Routes
// Access them like: /api/v1/route
Route::namespace('Backend\API')->prefix('v1/backend')->group(function () {
    //ROUTES

    // Task Route
    Route::get('tasks', 'TasksController@index')->name('api.task.index');
    Route::get('/tasks/{task}', 'TasksController@form')->name('api.task.form');
    Route::post('/tasks/save', 'TasksController@post')->name('api.task.save');
    Route::post('/tasks/{task}/delete', 'TasksController@delete')->name('api.task.delete');
    Route::post('/tasks/{task}/restore', 'TasksController@restore')->name('api.task.restore');
    Route::post('/tasks/{task}/force-delete', 'TasksController@forceDelete')->name('api.task.force-delete');
	
	// UsersList Route
    Route::get('usersLists', 'UsersListsController@index')->name('api.usersList.index');
    Route::get('/usersLists/{usersList}', 'UsersListsController@form')->name('api.usersList.form');
    Route::post('/usersLists/save', 'UsersListsController@post')->name('api.usersList.save');
    Route::post('/usersLists/{usersList}/delete', 'UsersListsController@delete')->name('api.usersList.delete');
    Route::post('/usersLists/{usersList}/restore', 'UsersListsController@restore')->name('api.usersList.restore');
    Route::post('/usersLists/{usersList}/force-delete', 'UsersListsController@forceDelete')->name('api.usersList.force-delete');

});

    

