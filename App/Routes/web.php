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
$route->get('/admin', ['controller' => 'AdminDashBoardController', 'method' => 'index']);

$route->get('/admin/login', ['controller' => 'RegistrationAuthController', 'method' => 'indexLogin']);
$route->post('/admin/login', ['controller' => 'RegistrationAuthController', 'method' => 'login']);
$route->get('/admin/register', ['controller' => 'RegistrationAuthController', 'method' => 'indexRegister']);
$route->post('/admin/register', ['controller' => 'RegistrationAuthController', 'method' => 'register']);
$route->get('/admin/logout', ['controller' => 'RegistrationAuthController', 'method' => 'logout']);
$route->get('/admin/verify', ['controller' => 'RegistrationAuthController', 'method' => 'verifyRegister']);

$route->get('/admin/resetpassword', ['controller' => 'RegistrationLostPassword', 'method' => 'indexResetPassword']);
$route->post('/admin/resetpassword', ['controller' => 'RegistrationLostPassword', 'method' => 'resetPassword']);

$route->get('/admin/lostpassword', ['controller' => 'RegistrationLostPassword', 'method' => 'indexLostPassword']);
$route->post('/admin/lostpassword', ['controller' => 'RegistrationLostPassword', 'method' => 'lostPassword']);

$route->get('/admin/articles', ['controller' => 'AdminArticleController', 'method' => 'indexListArticle']);
$route->get('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'indexAddArticle']);
$route->post('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'addArticle']);
$route->get('/admin/article/edit', ['controller' => 'AdminArticleController', 'method' => 'indexEditArticle']);
$route->post('/admin/article/edit', ['controller' => 'AdminArticleController', 'method' => 'editArticle']);
$route->get('/admin/article/delete', ['controller' => 'AdminArticleController', 'method' => 'deleteArticle']);
$route->get('/admin/article/comments', ['controller' => 'AdminArticleController', 'method' => 'indexCommentsArticle']);
$route->get('/admin/article/comments/publish', ['controller' => 'AdminArticleController', 'method' => 'publishCommentsArticle']);
$route->get('/admin/article/comments/nopublish', ['controller' => 'AdminArticleController', 'method' => 'nopublishCommentsArticle']);
$route->get('/admin/article/comments/delete', ['controller' => 'AdminArticleController', 'method' => 'deleteCommentArticle']);

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

$route->get('/admin/user/profil', ['controller' => 'AdminUserController', 'method' => 'indexUserProfile']);
$route->post('/admin/user/profil', ['controller' => 'AdminUserController', 'method' => 'updateUserProfile']);
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
$route->get('/admin/comment/add', ['controller' => 'AdminCommentController', 'method' => 'indexAddComment']);
$route->post('/admin/comment/add', ['controller' => 'AdminCommentController', 'method' => 'addComment']);
$route->get('/admin/comment/delete', ['controller' => 'AdminCommentController', 'method' => 'deleteComment']);

$route->get('/admin/themes', ['controller' => 'AdminThemeController', 'method' => 'indexTheme']);
$route->get('/admin/menus', ['controller' => 'AdminMenuController', 'method' => 'menu']);
$route->post('/admin/menus', ['controller' => 'AdminMenuController', 'method' => 'select']);
$route->get('/admin/menu/add', ['controller' => 'AdminMenuController', 'method' => 'add']);
$route->post('/admin/menu/add', ['controller' => 'AdminMenuController', 'method' => 'store']);
$route->get('/admin/menu/edit', ['controller' => 'AdminMenuController', 'method' => 'edit']);
$route->post('/admin/menu/edit', ['controller' => 'AdminMenuController', 'method' => 'update']);
$route->get('/admin/menu/delete', ['controller' => 'AdminMenuController', 'method' => 'delete']);
$route->get('/admin/menu/position', ['controller' => 'AdminMenuController', 'method' => 'position']);
$route->post('/admin/menu/position', ['controller' => 'AdminMenuController', 'method' => 'postPosition']);

$route->get('/admin/personnalisation', ['controller' => 'AdminCustomizationController', 'method' => 'indexCustomization']);

$route->get('/admin/plannings', ['controller' => 'AdminPlanningController', 'method' => 'indexPlanning']);

$route->get('/admin/newsletters', ['controller' => 'AdminNewsletterController', 'method' => 'indexNewsletter']);

return $route->getRoutes();