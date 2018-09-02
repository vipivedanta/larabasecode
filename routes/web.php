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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/google','Auth\LoginController@redirectToProvider');
Route::get('/googleCallback','Auth\LoginController@handleProviderCallback');

Route::get('/new-project','Projects\ProjectController@create');
Route::resource('/projects','Projects\ProjectController');
Route::get('project/{projectUUID}','Projects\ProjectController@show');
Route::get('team/{projectUUID}','Users\MemberController@show');
Route::post('invite-user','Users\MemberController@invite');