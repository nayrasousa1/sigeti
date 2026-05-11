<?php

/*
|--------------------------------------------------------------------------
| Rotas do admin
|--------------------------------------------------------------------------
*/
use CoffeeCode\Router\Router;

$router->group(null);
$router->group("/admin");

$router->get("/dashboard", "admin\DashboardController@index");

$router->get("/perfis", "admin\RoleController@index");
$router->get("/perfis/cadastrar", "admin\RoleController@create");
$router->post("/perfis/cadastrar", "admin\RoleController@store");

$router->get("/perfis/editar/{id}", "admin\RoleController@edit");
$router->put("/perfis/editar/{id}", "admin\RoleController@update");
$router->delete("/perfis/excluir/{id}", "admin\RoleController@destroy");

$router->get("/perfis/{id}/permissoes", "admin\RolePermissionController@edit");
$router->post("/perfis/{id}/permissoes", "admin\RolePermissionController@update");

$router->get("usuarios", "admin\UserController@index");
$router->get("usuarios/cadastrar", "admin\UserController@create");
$router->post("/usuarios/cadastrar", "admin\UserController@store");
$router->get("/usuarios/editar/{id}", "admin\UserController@edit");
$router->put("/usuarios/editar/{id}", "admin\UserController@update");
$router->delete("/usuarios/excluir/{id}", "admin\UserController@destroy");

$router->get("/departamentos", "admin\DepartmentController@index");
$router->get("/departamentos/cadastrar", "admin\DepartmentController@create");
$router->post("/departamentos/cadastrar", "admin\DepartmentController@store");
$router->get("/departamentos/editar/{id}", "admin\DepartmentController@edit");
$router->put("/departamentos/editar/{id}", "admin\DepartmentController@update");
$router->delete("/departamentos/excluir/{id}", "admin\DepartmentController@destroy");
