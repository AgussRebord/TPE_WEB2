<?php
    require_once './app/model/productModel.php';
    require_once './app/model/categoryModel.php';
    require_once './app/view/helaView.php';
class productController{ 
    
    private $view;
    private $model;
    private $modelCategory;
    function __construct(){
        $this->view = new helaView(); 
        $this->model = new productModel();
        $this->modelCategory = new categoryModel();
    }

    function showProduct($id){
        $producto = $this->model->getProduct($id);
        $categoria = $this->modelCategory->getCategory($id);
        $this->view->showProduct($producto, $categoria);

    }
    
    function removeProduct($id){
        $this->model->deleteProduct($id);
        header('Location: ' . BASE_URL);
    }
    
    function addProduct(){
        $nombre_producto = $_POST['nombre_producto'];

        if( empty($nombre_producto)){
            $this->view->showError("Completé todos los campos");
        }
        $id = $this->model->insertProduct($nombre_producto);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar el pedido");
        } 
    }

    function editProduct(){

        $nombre_producto = $_POST['nombre_producto'];
        $producto_id = $_POST['producto_id'];

        
        if (empty($nombre_producto) || empty($producto_id)) {
            $this->view->showError("Hay campos obligatorios sin completar");
        } else {
            $id = $this->model->updateProduct($nombre_producto, $producto_id);
        } 
        header('Location: ' . BASE_URL);

         
    }



}
?>