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


$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');

    // Matches "/api/login
    $router->post('login', 'AuthController@login');

    // Matches "/api/member/profile
    $router->get('member/{id}', 'MemberController@show');
    $router->post('member/profile/{id}', 'MemberController@createprofile');
    $router->get('member/profile/{id}', 'MemberController@showprofile');

    $router->post('req_deposit/{id}', 'DepositTiketController@deposittiket');
    $router->get('topup/{id}', 'DepositTiketController@showTopUp');

    //create kategori
    $router->post('create_kategori', 'ProdukController@createKategori');
});
