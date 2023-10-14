<?php
require_once './app/controller/helaController.php';
require_once './app/controller/authController.php';
require_once './app/controller/categoryController.php';
require_once './app/controller/productController.php';
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// el router va a leer la action desde el paramtro "action"
$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: noticia/1 --> ['noticia', 1]
$params = explode('/', $action);
switch ($params[0]) { // en la primer posicion tengo la accion real
    case 'home':
        $controller = new helaController();
        $controller->show(); // muestra todas las noticias
        break;
    case 'addPedido':
        $controller = new helaController();
        $controller->addPedidos();
        break;
    case 'addCategory':
        $controller = new categoryController();
        $controller->addCategory();
        break;
    case 'addProduct':
        $controller = new productController();
        $controller->addProduct();
        break;
    case 'filtro':
        $controller = new helaController();
        $controller->filtroPedidos();
        break;
    case 'deleteProduct':
        $controller = new productController();
        $controller->removeProduct($params[1]);
        break;
    case 'deletePedido':
        $controller = new helaController();
        $controller->removePedido($params[1]);
        break;
    case 'deleteCategory':
        $controller = new categoryController();
        $controller->removeCategory($params[1]);
        break;
    case 'editProduct':
        $controller = new productController();
        $controller->editProduct();
        break;
    case 'editCategory':
        $controller = new categoryController();
        $controller->editCategory();
        break;
    case 'editPedido':
        $controller = new helaController();
        $controller->editPedido();
        break;
    case 'detailProduct':
        $controller = new productController();
        $controller->showProduct($params[1]);
        break;
    case 'detailCategory':
        $controller = new categoryController();
        $controller->showCategory($params[1]);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
    echo ('404 Page not found');
    break;

}




?>