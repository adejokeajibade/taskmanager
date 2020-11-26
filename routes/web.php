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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::namespace('Frontend')->prefix('pages')->group(function () {
    

    // UsersList Frontend Route
    Route::get('/users', 'UsersListsController@index')->name('usersList.frontend.index');
	Route::get('/users/new', 'UsersListsController@edit')->name('users.new');
	Route::get('/users/{usersList}', 'UsersListsController@edit')->name('users.edit');
	Route::post('/users/save', 'UsersListsController@save')->name('users.save');
	Route::post('/users/{usersList}/delete', 'UsersListsController@delete')->name('users.delete');
	

    // Task Frontend Route
    Route::get('/taskslist', 'TasksController@index')->name('task.frontend.index');
	Route::get('/taskslist/new', 'TasksController@edit')->name('tasklist.new');
	Route::get('/taskslist/{task}', 'TasksController@edit')->name('tasklist.edit');
    Route::post('/taskslist/save', 'TasksController@save')->name('tasklist.save');
    Route::post('/taskslist/{task}/delete', 'TasksController@delete')->name('tasklist.delete');

});

Route::namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/login', 'AuthController@getLogin')->name('backend.login.form');
    Route::post('/login', 'AuthController@postLogin')->name('backend.login.post');
    Route::get('/logout', 'AuthController@logout')->name('backend.logout');
	
});

Route::middleware(['role:admin', 'auth'])->namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard');

    // UsersList Route
    Route::get('usersLists', 'UsersListsController@index')->name('usersList.index');
    Route::get('/usersLists/new', 'UsersListsController@form')->name('usersList.new');
    Route::get('/usersLists/{usersList}', 'UsersListsController@form')->name('usersList.form');
    Route::post('/usersLists/save', 'UsersListsController@post')->name('usersList.save');
    Route::post('/usersLists/{usersList}/delete', 'UsersListsController@delete')->name('usersList.delete');
    Route::post('/usersLists/{usersList}/restore', 'UsersListsController@restore')->name('usersList.restore');
    Route::post('/usersLists/{usersList}/force-delete', 'UsersListsController@forceDelete')->name('usersList.force-delete');


    // Task Route
    Route::get('tasks', 'TasksController@index')->name('task.index');
    Route::get('/tasks/new', 'TasksController@form')->name('task.new');
    Route::get('/tasks/{task}', 'TasksController@form')->name('task.form');
    Route::post('/tasks/save', 'TasksController@post')->name('task.save');
    Route::post('/tasks/{task}/delete', 'TasksController@delete')->name('task.delete');
    Route::post('/tasks/{task}/restore', 'TasksController@restore')->name('task.restore');
    Route::post('/tasks/{task}/force-delete', 'TasksController@forceDelete')->name('task.force-delete');

    Route::get('/profile', 'AuthController@getProfile')->name('backend.profile');
    Route::post('/profile/save', 'AuthController@postProfile')->name('backend.profile.post');
  //ROUTES
});
// DO NOT EDIT THIS LINE
