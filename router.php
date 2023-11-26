<?php
require_once './app/controller/PedidosController.php';
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
    //pedidos
    case 'home':
        $controller = new PedidosController();
        $controller->show(); // muestra todas las noticias
        break;
    case 'addPedido':
        $controller = new PedidosController();
        $controller->addPedidos();
        break;
    case 'deletePedido':
        $controller = new PedidosController();
        $controller->removePedido($params[1]);
        break;
    case 'editPedido':
        $controller = new PedidosController();
        $controller->editPedido($params[1]);
        break;
    case 'actualizarPedido':
        $controller = new PedidosController();
        $controller->updatePedido($params[1]);
        break;      
    
    //productos
    case 'showProduct':
        $controller = new productController();
        $controller->showProductAll();
        break;
    case 'addProduct':
        $controller = new productController();
        $controller->addProduct();
        break;
    case 'deleteProduct':
        $controller = new productController();
        $controller->removeProduct($params[1]);
        break;
    case 'detailProduct':
        $controller = new productController();
        $controller->showProduct($params[1]);
        break;
    case 'editProduct':
        $controller = new productController();
        $controller->editProduct($params[1]);
        break;
    case 'actualizarProduct':
        $controller = new productController();
        $controller->updateProduct($params[1]);
        break; 

    //categoria
    case 'showCategory':
        $controller = new categoryController();
        $controller->showCategoryAll();
        break;
   
    case 'addCategory':
        $controller = new categoryController();
        $controller->addCategory();
        break;
    case 'deleteCategory':
        $controller = new categoryController();
        $controller->removeCategory($params[1]);
        break;
    case 'detailCategory':
        $controller = new categoryController();
        $controller->showCategory($params[1]);
        break;
    case 'editCategory':
        $controller = new categoryController();
        $controller->editCategory($params[1]);
        break;
    case 'actualizarCategory':
        $controller = new categoryController();
        $controller->updateCategory($params[1]);
        break; 
        
    //otros   
    case 'filtro':
        $controller = new PedidosController();
        $controller->filtroPedidos();
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