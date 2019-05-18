<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->get('/login', function (Request $request) {
//     $token = app('auth')->attempt($request->only('email', 'password'));

//     return response()->json(compact('token'));
// });


Route::post('register', 'AuthController@register');

Route::post('login', 'AuthController@authenticate');

$router->group(['prefix' => 'todo/', 'middleware' => 'jwt.auth'], function () use ($router) {
    $router->get('/', 'todoController@index'); //get all the routes    
    $router->post('/', 'todoController@store'); //store single route
    $router->get('/{id}/', 'todoController@show'); //get single route
    $router->put('/{id}/', 'todoController@update'); //update single route
    $router->delete('/{id}/', 'todoController@destroy'); //delete single route
});
