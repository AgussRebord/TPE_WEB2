<?php

require_once './app/view/pedidosView.php';
require_once './app/model/pedidosModel.php';
require_once './app/model/categoryModel.php';
require_once './app/model/productModel.php';


class PedidosController{
    
    private $view;
    private $model;
    private $modelCategory;
    private $modelProduct;

    function __construct(){
        
        $this->view = new PedidosView(); 
        $this->model = new PedidosModel();
        $this->modelCategory = new categoryModel();
        $this->modelProduct = new productModel();

    }

    function filtroPedidos(){
        $categoria = $_POST['filtro'];
        $pedidos = $this->model->getPedidosXfiltro($categoria);
        $this->view->showFiltro($pedidos);
    }

    function show(){
        AuthHelper::init();

        $productos = $this->modelProduct->getProductAll();
        $pedidos = $this->model->getPedidos();
        $categorias = $this->modelCategory->getCategoryAll();
        if(AuthHelper::checkLogin()){
            $this->view->showHomeAdmin($pedidos, $categorias, $productos);
        }else{
            $this->view->showHome($pedidos, $categorias);
        }
    }    
    function addPedidos(){
        

        $id_producto = $_POST['producto'];
        $categoria = $_POST['categoria'];
        $producto = $this->modelProduct->getProduct($id_producto);
        if( empty($id_producto) || empty($categoria)){
            $this->view->showError("Completé todos los campos");
        }
        $id = $this->model->insertPedidos( $id_producto, $producto->nombre_producto, $categoria);
        if ($id) {
            header('Location: ' . BASE_URL . 'home');
        } else {
            $this->view->showError("Error al insertar el pedido");
        }
    }

    function removePedido($id) {
        AuthHelper::verify();


        $this->model->deletePedido($id);
        header('Location: ' . BASE_URL . 'home');
    }

    function editPedido($idPedido){

        AuthHelper::verify();
        $pedido= $this->model->getPedidoById($idPedido);
        $categorias = $this->modelCategory->getCategoryAll();
        $productos= $this->modelProduct->getProductAll();
        $this->view->editPedido($pedido, $categorias,$productos);   
    }    

    function updatePedido($id_pedido){
        AuthHelper::verify();
        $idProducto = $_POST['producto'];
        $idCategoria = $_POST['categoria'];
        $producto = $this->modelProduct->getProduct($idProducto);

        $this->model->updatePedido($idProducto, $producto->nombre_producto, $idCategoria, $id_pedido);
        header('Location: ' . BASE_URL);
    }
}

?>  