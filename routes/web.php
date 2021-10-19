<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
use App\Http\Controllers\Controller;

$router->get('/', function () use ($router) {
    $message = "<p>Application: ".$router->app->version()."</p> 
    <p> Routes Api:</p> 
    <ol>
        <li> /public/hello </li>
        <li> /public/test </li>
        <li> /public/paramxml </li>
    </ol>";
    return $message;
});

$router->get('/hello', 'Controller@hello_word');

$router->get('/test', 'Controller@testApi');

$router->get('paramxml', 'Controller@testxml');
