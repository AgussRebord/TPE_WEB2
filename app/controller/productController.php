<?php
    require_once './app/model/productModel.php';
    require_once './app/model/categoryModel.php';
    require_once './app/view/productView.php';
class productController{ 
    
    private $view;
    private $model;
    private $modelCategory;
    function __construct(){
        $this->view = new productView(); 
        $this->model = new productModel();
        $this->modelCategory = new categoryModel();
    }

    function showProductAll(){
        AuthHelper::init();

        $productos = $this->model->getProductAll();
        if(AuthHelper::checkLogin()){
            $this->view->showProductsAdmin($productos);
        }else{
            $this->view->showProducts($productos);
        }
    }
    function showProduct($id){
        AuthHelper::init();

        $producto = $this->model->getProduct($id);
        $categoria = $this->modelCategory->getCategory($id);
        $this->view->showProduct($producto, $categoria);

    }
    
    function removeProduct($id){
        AuthHelper::verify();

        $this->model->deleteProduct($id);
        header('Location: ' . BASE_URL . 'showProduct');
    }
    
    function addProduct(){
        AuthHelper::verify();

        $nombre_producto = $_POST['nombre_producto'];

        if( empty($nombre_producto)){
            $this->view->showError("Completé todos los campos");
        }
        $id = $this->model->insertProduct($nombre_producto);
        if ($id) {
            header('Location: ' . BASE_URL . 'showProduct');
        } else {
            $this->view->showError("Error al insertar el pedido");
        } 
    }

    function editProduct($id_producto){
        AuthHelper::verify();
        $producto = $this->model->getProduct($id_producto);
 
        $this->view->editProduct($id_producto, $producto);

    }
        
    function updateProduct($id_producto){
        AuthHelper::verify();
        $nombre_producto = $_POST['nombre_producto'];

        $this->model->updateProduct($nombre_producto,$id_producto);
        header('Location: ' . BASE_URL .'showProduct');
    }



}
?>