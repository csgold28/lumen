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

$router->get('/api', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    $key = str_random(32);
    return $key;
});
