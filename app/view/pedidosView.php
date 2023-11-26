<?php

class PedidosView{

    function __construct(){
        
    }


    function showHome($pedidos, $categorias){ 
        require './templates/pedidos.phtml';
    }
    function showHomeAdmin($pedidos, $categorias, $productos){ 
        require './templates/pedidosAdmin.phtml';
    }
    function editPedido($pedido, $categorias, $productos){ 
        require './templates/editPedido.phtml';
    }
    function showError($error){
        echo "<h1>ERROR</h1>";
        echo $error;
    }
    function showFiltro($pedidos){
        require './templates/filtro.phtml';
    }
}

?>