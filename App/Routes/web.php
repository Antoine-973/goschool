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

$route->get('/admin/articles', ['controller' => 'AdminArticleController', 'method' => 'indexListArticle']);
$route->get('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'indexAddArticle']);
$route->post('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'addArticle']);
$route->get('/admin/article/edit', ['controller' => 'AdminArticleController', 'method' => 'indexEditArticle']);
$route->post('/admin/article/edit', ['controller' => 'AdminArticleController', 'method' => 'editArticle']);
$route->get('/admin/article/delete', ['controller' => 'AdminArticleController', 'method' => 'deleteArticle']);

$route->get('/admin/categories', ['controller' => 'AdminCategoryController', 'method' => 'indexListCategory']);
$route->get('/admin/categorie/add', ['controller' => 'AdminCategoryController', 'method' => 'indexAddCategory']);
$route->post('/admin/categorie/add', ['controller' => 'AdminCategoryController', 'method' => 'addCategory']);
$route->get('/admin/categorie/edit', ['controller' => 'AdminCategoryController', 'method' => 'indexEditCategory']);
$route->post('/admin/categorie/edit', ['controller' => 'AdminCategoryController', 'method' => 'editCategory']);
$route->get('/admin/categorie/delete', ['controller' => 'AdminCategoryController', 'method' => 'deleteCategory']);

$route->get('/admin/pages', ['controller' => 'AdminPageController', 'method' => 'indexListPage']);
$route->get('/admin/page/add', ['controller' => 'AdminPageController', 'method' => 'indexAddPage']);
$route->post('/admin/page/add', ['controller' => 'AdminPageController', 'method' => 'addPage']);
$route->get('/admin/page/edit', ['controller' => 'AdminPageController', 'method' => 'indexEditPage']);
$route->post('/admin/page/edit', ['controller' => 'AdminPageController', 'method' => 'editPage']);
$route->get('/admin/page/delete', ['controller' => 'AdminPageController', 'method' => 'deletePage']);

$route->get('/admin/users', ['controller' => 'AdminUserController', 'method' => 'indexListUser']);
$route->get('/admin/user/add', ['controller' => 'AdminUserController', 'method' => 'indexAddUser']);
$route->post('/admin/user/add', ['controller' => 'AdminUserController', 'method' => 'addUser']);
$route->get('/admin/user/edit', ['controller' => 'AdminUserController', 'method' => 'indexEditUser']);
$route->post('/admin/user/edit', ['controller' => 'AdminUserController', 'method' => 'editUser']);
$route->get('/admin/user/delete', ['controller' => 'AdminUserController', 'method' => 'deleteUser']);

$route->get('/admin/param', ['controller' => 'AdminParamController', 'method' => 'index']);

$route->get('/admin/medias', ['controller' => 'AdminMediaController', 'method' => 'index']);
$route->get('/admin/media/add', ['controller' => 'AdminMediaController', 'method' => 'indexAddMedia']);
$route->post('/admin/media/add', ['controller' => 'AdminMediaController', 'method' => 'addMedia']);
$route->get('/admin/media/delete', ['controller' => 'AdminMediaController', 'method' => 'deleteMedia']);

$route->get('/admin/comments', ['controller' => 'AdminCommentController', 'method' => 'indexListComment']);
$route->get('/admin/comment/edit', ['controller' => 'AdminCommentController', 'method' => 'indexEditComment']);
$route->post('/admin/comment/edit', ['controller' => 'AdminCommentController', 'method' => 'editComment']);
$route->get('/admin/comment/delete', ['controller' => 'AdminCommentController', 'method' => 'deleteComment']);

return $route->getRoutes();