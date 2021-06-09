<?php

$route = new Core\Routing\Route();
$route->get('/install', ['controller' => 'InstallationController', 'method' => 'index']);
$route->post('/install', ['controller' => 'InstallationController', 'method' => 'handleInstallation']);


/**
 * ===== Site Routes ====
 */

$route->get('/', ['controller' => 'HomeController', 'method' => 'index']);

$route->get('/users/register', ['controller' => 'UserController', 'method' => 'register']);

/**
 * ===== Admin Routes ====
 */
$route->get('/admin', ['controller' => 'DashBoardController', 'method' => 'index']);

$route->get('/admin/login', ['controller' => 'AdminAuthController', 'method' => 'indexLogin']);

$route->get('/admin/register', ['controller' => 'AdminAuthController', 'method' => 'indexRegister']);

$route->post('/admin/register', ['controller' => 'AdminAuthController', 'method' => 'register']);

$route->post('/admin/login', ['controller' => 'AdminAuthController', 'method' => 'login']);

$route->get('/admin/resetpassword', ['controller' => 'AdminLostPassword', 'method' => 'indexResetPassword']);

$route->post('/admin/resetpassword', ['controller' => 'AdminLostPassword', 'method' => 'resetPassword']);

$route->get('/admin/lostpassword', ['controller' => 'AdminLostPassword', 'method' => 'indexLostPassword']);

$route->post('/admin/lostpassword', ['controller' => 'AdminLostPassword', 'method' => 'lostPassword']);

$route->get('/admin/article', ['controller' => 'AdminArticleController', 'method' => 'indexArticle']);

$route->post('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'create']);

$route->get('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'add']);
$route->get('/admin/article/delete/{id}', ['controller' => 'AdminArticleController', 'method' => 'delete']);
$route->post('/admin/article/delete', ['controller' => 'AdminArticleController', 'method' => 'delete']);

$route->get('/admin/article/edit', ['controller' => 'AdminArticleController', 'method' => 'edit']);
$route->post('/admin/article/update', ['controller' => 'AdminArticleController', 'method' => 'update']);

$route->get('/admin/users', ['controller' => 'AdminUserController', 'method' => 'indexUserManager']);
$route->get('/admin/users/add', ['controller' => 'AdminUserController', 'method' => 'indexAddUser']);
$route->post('/admin/users/add', ['controller' => 'AdminUserController', 'method' => 'addUser']);
//$route->get('/admin/users/update/{$id}', ['controller' => 'AdminUserController', 'method' => 'indexAddUser']);
//$route->post('/admin/users/delete/{$id}', ['controller' => 'AdminUserController', 'method' => 'addUser']);
//$route->get('/admin/users/add/{$id}', ['controller' => 'AdminUserController', 'method' => 'indexAddUser']);

return $route->getRoutes();