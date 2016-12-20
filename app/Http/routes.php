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

$app->get('/', ['middleware' => 'auth', function () use ($app) {
    return $app->version();
}]);

$app->group(['prefix' => 'v1'], function($app) {
    rest('/boycott', 'BoycottController');
    rest('/boycott/{boycottId}/users', 'BoycottUserController');
    rest('/boycott/{boycottId}/posts', 'BoycottPostController');
    $app->post('/user/login', 'UserController@login');
    $app->delete('/user/login', 'UserController@logout');
    $app->get('/user/current', 'UserController@getCurrentUser');
    rest('/user', 'UserController');
    rest('/media', 'MediaController');
    rest('/concern', 'ConcernController');
});


function rest($path, $controller)
{
	global $app;

	$app->get($path, $controller.'@index');
	$app->get($path.'/{id}', $controller.'@show');
	$app->post($path, $controller.'@store');
	$app->put($path.'/{id}', $controller.'@update');
	$app->delete($path.'/{id}', $controller.'@destroy');
}
