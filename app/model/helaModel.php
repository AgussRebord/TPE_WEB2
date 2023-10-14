<?php

class helaModel {

    private $db;

    function __construct(){
        //1.  abro conexión
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_heladeria;charset=utf8', 'root', '');
    }

    function getPedidos(){
        //2.  ejecuto consulta SQL
        $query = $this->db->prepare('SELECT pedidos.*, categorias.nombre_categoria 
                                    FROM pedidos JOIN categorias ON pedidos.categoria = categorias.id_categoria');
        $query->execute();

        //3. Obtener datos de la consulta

        return $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo con todos los pedidos

    }
    function getPedidosxFiltro($categoria){
        //2.  ejecuto consulta SQL
        $query = $this->db->prepare('SELECT * FROM pedidos WHERE categoria = ?');
        $query->execute([$categoria]);

        //3. Obtener datos de la consulta

        return $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo con todos los pedidos

    }

    function BuscarIdProducto($producto){


    }
    function insertPedidos($producto,$categoria){
        $query = $this->db->prepare('SELECT id_productos FROM producto WHERE nombre_producto = ?');
        $query->execute([$producto]);

        $id_producto = $query->fetch(PDO::FETCH_OBJ);
            

        $query = $this->db->prepare('INSERT INTO pedidos(id_producto, producto, categoria) VALUES(?,?,?)');
        
        $query->execute(array($id_producto->id_productos,$producto,$categoria));
    
        return $this->db->lastInsertId();

    }
    
    function deletePedido($id){
        $query = $this->db->prepare('DELETE FROM pedidos WHERE id_producto = ?');
        $query->execute([$id]);
        
        
    }
    function updatePedido($id_pedido,$producto,$id_producto, $categoria){
            
        $query = $this->db->prepare('UPDATE pedidos SET id_producto = ?, producto = ?, categoria = ? WHERE id_pedido = ?');
        $query->execute(array($id_producto, $producto, $categoria, $id_pedido));
    }
    
}

















?>