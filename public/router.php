<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\RootController;

$router = new AltoRouter();

// Routes
$router->map('GET', '/home', 'RootController#index', 'home');
$router->map('GET', '/', 'RootController#index', 'root');
$router->map('GET', '/user', 'UserController#index', 'user');
$router->map('GET', '/user/delete/[i:id]', 'UserController#delete', 'user_delete');


$router->map('POST', '/articles/createArticles', 'AdminController#createArticles', 'create');
$router->map('GET', '/article', 'ArticlesController#index', 'view_com');

$router->map('GET', '/login', 'LoginController#index', 'login');
$router->map('POST', '/log', 'LoginController#log', 'log');
$router->map('GET', '/logout', 'LoginController#logout', 'logout');

$router->map('POST', '/reg', 'LoginController#register', 'reg');
$router->map('GET', '/register', 'LoginController#indexRegister', 'register');

$router->map('GET', '/articles/view/[i:id]', 'ArticlesController#view', 'articles_view');
$router->map('POST', '/articles/modifyArticle/[i:id]', 'AdminController#modifyArticle', 'modifyArticle');
$router->map('GET', '/articles/modifyArticle/[i:id]', 'AdminController#viewModify', 'article_modify');

$router->map('GET', '/deleteArticle', 'AdminController#pageDeleteArticle', 'deleteArticle');
$router->map('GET', '/articles/delete/[i:id]', 'AdminController#deleteArticle', 'article_delete');

$router->map('GET', '/articles/view/', 'ArticlesPcController#view', 'view');
$router->map('GET', '/articles', 'ArticlesPcController#index', 'viewArticlePc');




//$router->map('GET', '/removeCart/[i:id]', 'CartController#removeToCart', 'removeToCart');
//$router->map('GET', '/cart/addToCart/[i:id]', 'CartController#addToCart', 'addToCart');








// Fonction

$match = $router->match();

if ($match) {
    list($controller, $action) = explode('#', $match['target']);
    $controllerFile = dirname(__FILE__) . "/../Controller/$controller.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerClass = "App\\Controller\\$controller";
        $controllerInstance = new $controllerClass();
        call_user_func_array(array($controllerInstance, $action), $match['params']);
    } else {
        $rootController = new RootController();
        $rootController->displayError(404);
    }
} else {
    $rootController = new RootController();
    $rootController->displayError(404);
}
