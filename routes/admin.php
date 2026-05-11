<?php

/*
|--------------------------------------------------------------------------
| Rotas do admin
|--------------------------------------------------------------------------
*/
use CoffeeCode\Router\Router;

$router = new Router(APP_URL, "@");
$router->namespace("app\Controllers");

$router->get("/dashboard", "Admin\DashboardController@index");


$router->get("/perfil", "Admin\RoleController@index");
$