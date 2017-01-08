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

///user api endpoint
$app->get('/users','UserController@index');
$app->post('/users/login','UserController@login');
$app->post('/users/register','UserController@store');
$app->get('/users/{user}','UserController@show');
$app->put('/users/{user}','UserController@update');
$app->delete('/users/{user}','UserController@destroy');

//items api endpoint
$app->get('/items','ItemController@index');
$app->get('/admin/items','ItemController@adminitems');
$app->get('/items/{item}','ItemController@show');
$app->get('/votes','ItemController@votes');
$app->post('/items','ItemController@store');
$app->post('/items/vote','ItemController@vote');
$app->post('/items/approve','ItemController@approve');
$app->post('/items/disapprove','ItemController@disapprove');
$app->put('/items/{item}','ItemController@update');
$app->delete('/items/{item}','ItemController@destroy');

$app->get('/', function () {
    return view('index');
});
$app->get('/topusers', function () {
    return view('top');
});
$app->get('/admin', function () {
    return view('admin');
});
