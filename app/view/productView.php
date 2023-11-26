<?php

class productView{

    function __construct(){
        
    }


    
    function showProduct($productos, $categorias){
        require './templates/producto.phtml';
    }
    function showProducts($productos){
        require './templates/productos.phtml';
    }
    function showProductsAdmin($productos){
        require './templates/productosAdmin.phtml';
    }
    function editProduct($id_producto,$producto){
        require './templates/editProducto.phtml';
    }
    function showError($error){
        echo "<h1>ERROR</h1>";
        echo $error;
    }
    
}

?>