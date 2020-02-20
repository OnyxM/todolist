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

Route::post('login', "AuthController@login")->name('login');
Route::post('register', "AuthController@register")->name('register');

Route::get('me', "AuthController@me")->name('me');

Route::get('my-todos', "TodoController@all")->name('todos.all');
Route::get('my-todos/{id}', "TodoController@todo_details")->name('todos.todo_details');
Route::get('complete-todo/{id}', "TodoController@complete_todo")->name('todos.complete_todo');
Route::get('cancel-todo/{id}', "TodoController@cancel_todo")->name('todos.cancel_todo');
Route::post('new-todo', "TodoController@new")->name('new-todo');