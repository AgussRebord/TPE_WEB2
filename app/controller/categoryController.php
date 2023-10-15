<?php
require_once './app/model/categoryModel.php';
require_once './app/view/helaView.php';
class categoryController{
    private $view;
    private $model;
    function __construct(){
        AuthHelper::verify();
        $this->view = new helaView();
        $this->model = new categoryModel();
    }


    function showCategory($id){
        $categoria = $this->model->getCategory($id);
        
        $this->view->showCategory($categoria);

    }
    
    function removeCategory($id){
        $this->model->deleteCategory($id);
        header('Location: ' . BASE_URL . 'homeAdmin');
    }
    
    function addCategory(){
        $nombre_categoria = $_POST['nombre_categoria'];

        if( empty($nombre_categoria)){
            $this->view->showError("Completé todos los campos");
        }
        $id = $this->model->insertCategory($nombre_categoria);
        if ($id) {
            header('Location: ' . BASE_URL . 'homeAdmin');
        } else {
            $this->view->showError("Error al insertar el pedido");
        } 
    }
    
    function editCategory(){
        $nombre_categoria = $_POST['nombre_categoria'];
        $categoria_id = $_POST['categoria_id'];

        
        if (empty($nombre_categoria) || empty($categoria_id)) {
            $this->view->showError("Hay campos obligatorios sin completar");
        } else {
            $id = $this->model->updateCategory($nombre_categoria, $categoria_id);
        } 
        header('Location: ' . BASE_URL . 'homeAdmin');
    }

}
?>