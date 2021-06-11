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
$route->post('/admin/login', ['controller' => 'AdminAuthController', 'method' => 'login']);
$route->get('/admin/register', ['controller' => 'AdminAuthController', 'method' => 'indexRegister']);
$route->post('/admin/register', ['controller' => 'AdminAuthController', 'method' => 'register']);

$route->get('/admin/resetpassword', ['controller' => 'AdminLostPassword', 'method' => 'indexResetPassword']);
$route->post('/admin/resetpassword', ['controller' => 'AdminLostPassword', 'method' => 'resetPassword']);

$route->get('/admin/lostpassword', ['controller' => 'AdminLostPassword', 'method' => 'indexLostPassword']);
$route->post('/admin/lostpassword', ['controller' => 'AdminLostPassword', 'method' => 'lostPassword']);

$route->get('/admin/articles', ['controller' => 'AdminArticleController', 'method' => 'indexArticle']);

$route->post('/admin/articles/add', ['controller' => 'AdminArticleController', 'method' => 'create']);
$route->get('/admin/articles/add', ['controller' => 'AdminArticleController', 'method' => 'add']);
$route->get('/admin/articles/delete', ['controller' => 'AdminArticleController', 'method' => 'delete']);
$route->get('/admin/articles/edit', ['controller' => 'AdminArticleController', 'method' => 'edit']);
$route->post('/admin/articles/edit', ['controller' => 'AdminArticleController', 'method' => 'update']);

$route->get('/admin/pages', ['controller' => 'AdminPageController', 'method' => 'indexlistPage']);
$route->get('/admin/page/add', ['controller' => 'AdminPageController', 'method' => 'indexAddPage']);
$route->post('/admin/page/add', ['controller' => 'AdminPageController', 'method' => 'addPage']);
$route->get('/admin/page/edit', ['controller' => 'AdminPageController', 'method' => 'indexEditPage']);
$route->post('/admin/page/edit', ['controller' => 'AdminPageController', 'method' => 'editPage']);
$route->get('/admin/page/delete', ['controller' => 'AdminPageController', 'method' => 'deletePage']);

$route->get('/admin/users', ['controller' => 'AdminUserController', 'method' => 'indexUserManager']);
$route->get('/admin/users/add', ['controller' => 'AdminUserController', 'method' => 'indexAddUser']);
$route->post('/admin/users/add', ['controller' => 'AdminUserController', 'method' => 'addUser']);
$route->get('/admin/users/edit', ['controller' => 'AdminUserController', 'method' => 'indexEditUser']);
$route->post('/admin/users/edit', ['controller' => 'AdminUserController', 'method' => 'editUser']);
$route->get('/admin/users/delete', ['controller' => 'AdminUserController', 'method' => 'deleteUser']);

$route->get('/admin/param', ['controller' => 'AdminParamController', 'method' => 'index']);

$route->get('/admin/medias', ['controller' => 'AdminMediaController', 'method' => 'index']);

return $route->getRoutes();