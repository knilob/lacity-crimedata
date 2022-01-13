<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\CrimeController;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('save_addresses', ['uses' => 'CrimeController@ImportAddresses']);

$router->group(['prefix' => 'crimes'], function () use ($router) {
    $router->get('total_by_area/{area}', ['uses' => 'CrimeController@totalByArea']);

    $router->get('total_by_type/{type}', ['uses' => 'CrimeController@totalByType']);

    $router->get('location_by_type/{type}', ['uses' => 'CrimeController@locationByType']);
});
