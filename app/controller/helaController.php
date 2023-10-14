<?php

require_once './app/view/helaView.php';
require_once './app/model/helaModel.php';
require_once './app/model/categoryModel.php';
require_once './app/model/productModel.php';


class helaController{
    
    private $view;
    private $model;
    private $modelCategory;
    private $modelProduct;

    function __construct(){
        AuthHelper::verify();
        $this->view = new helaView(); 
        $this->model = new helaModel();
        $this->modelCategory = new categoryModel();
        $this->modelProduct = new productModel();

    }

    function filtroPedidos(){
        $categoria = $_POST['filtro'];
        $pedidos = $this->model->getPedidosXfiltro($categoria);
        $this->view->showFiltro($pedidos);
    }

    function show(){
        $productos = $this->modelProduct->getProductAll();
        $pedidos = $this->model->getPedidos();
        $categorias = $this->modelCategory->getCategoryAll();
        $this->view->showHome($pedidos, $categorias, $productos);
    }
    function calcularPrecio(){
        $categoria = $_POST['categoria'];
        $producto = $_POST['producto'];
        if($categoria == 'servido'){
            if($producto == 'helado'){
                return 3700;
            }
            elseif($producto == 'helado'){
                return 2000;
            }
        }
        elseif($categoria == 'tortas'){
            return 5000;
        }
        elseif($producto == 'cucurucho'){
            return 400;
        }
        elseif($categoria == 'bombones'){
            return 3200;
        }
    }

    function addPedidos(){
        $producto = $_POST['producto'];
        $categoria = $_POST['categoria'];

        if( empty($producto) || empty($categoria)){
            $this->view->showError("Completé todos los campos");
        }
        $id = $this->model->insertPedidos($producto,$categoria);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar el pedido");
        }
    }

    function removePedido($id) {

        $this->model->deletePedido($id);
        header('Location: ' . BASE_URL);     
    }

    function editPedido(){
        $id_pedido = $_POST['id_pedido']; 
        $producto = $_POST['producto'];
        $id_producto = $_POST['id_producto']; 
        $categoria = $_POST['categoria'];

        
        if (empty($id_pedido) || empty($producto) || empty($id_producto) || empty($categoria)) {
            $this->view->showError("Hay campos obligatorios sin completar");
        } else {
            $this->model->updatePedido($id_pedido, $producto, $id_producto , $categoria);
        } 
        header('Location: ' . BASE_URL);
    }    

}

?>