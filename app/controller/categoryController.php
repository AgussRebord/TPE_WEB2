<?php
require_once './app/model/categoryModel.php';
require_once './app/view/categoryView.php';
class categoryController{
    private $view;
    private $model;
    function __construct(){
        AuthHelper::init();
        $this->view = new categoryView();
        $this->model = new categoryModel();
    }


    function showCategoryAll(){

        $categorias = $this->model->getCategoryAll();
        if(AuthHelper::checkLogin()){
            $this->view->showCategorysAdmin($categorias);
        }else{
            $this->view->showCategorys($categorias);
        }

    }
    function showCategory($id){

        $categoria = $this->model->getCategory($id);
        
        $this->view->showCategory($categoria);

    }
    
    function removeCategory($id){
        AuthHelper::verify();

        $this->model->deleteCategory($id);
        header('Location: ' . BASE_URL . 'showCategory');
    }
    
    function addCategory(){
        AuthHelper::verify();

        $nombre_categoria = $_POST['nombre_categoria'];

        if( empty($nombre_categoria)){
            $this->view->showError("Completé todos los campos");
        }
        $id = $this->model->insertCategory($nombre_categoria);
        if ($id) {
            header('Location: ' . BASE_URL . 'showCategory');
        } else {
            $this->view->showError("Error al insertar el pedido");
        } 
    }
    
    function editCategory($id_categoria){
        AuthHelper::verify();
        $categoria = $this->model->getCategory($id_categoria);
 
        $this->view->editCategory($id_categoria, $categoria);

    }
        
    function updateCategory($id_categoria){
        AuthHelper::verify();
        $nombre_categoria = $_POST['nombre_categoria'];

        $this->model->updateCategory($nombre_categoria,$id_categoria);
        header('Location: ' . BASE_URL .'showCategory');
    }


}
?>