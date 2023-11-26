<?php

class categoryView{

    function __construct(){
        
    }
    
    function showCategory($categoria){
        require './templates/categoria.phtml';
    }
    function showCategorys($categorias){
        require './templates/categorias.phtml';
    }
    function showCategorysAdmin($categorias){
        require './templates/categoriasAdmin.phtml';
    }
    function editCategory($id_categoria, $categoria){
        require './templates/editCategoria.phtml';

    }
    function showError($error){
        echo "<h1>ERROR</h1>";
        echo $error;
    }
    
}

?>