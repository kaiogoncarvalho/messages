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

/**
 * @var \Laravel\Lumen\Routing\Router $router
 */
$router->get(
    '/',
    function () use ($router) {
        return $router->app->version();
    }
);



$router->group(
    ['prefix' => 'v1/messages', 'middleware' => 'auth:user'],
    function () use ($router) {
        $router->get('/{id}', 'MessagesController@get');
        $router->get('/{id}/history', 'MessagesController@getHistory');
        $router->get('/', 'MessagesController@getAll');
        $router->post('/',  'MessagesController@create');
        $router->patch('/{id}', 'MessagesController@update');
        $router->delete('/{id}', 'MessagesController@delete');
    }
);

$router->group(
    ['prefix' => 'v1/users'],
    function () use ($router) {
        $router->post('/', 'UsersController@register');
        $router->post('/login', 'UsersController@login');
    
    
        $router->group(
            ['middleware' => 'auth:user'],
            function () use ($router) {
                $router->patch('/', 'UsersController@update');
                $router->get('/', 'UsersController@get');
            });
        
    }
);
