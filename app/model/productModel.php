<?php
class productModel{


    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_heladeria;charset=utf8', 'root', '');

    }

    function getProductAll(){
        $query = $this->db->prepare('SELECT * FROM producto');
        $query->execute();

        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }
    
    function getProduct($id){
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_productos = ?');
        $query->execute(array($id));

        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto;
    }
    
    function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM producto WHERE id_productos = ?');
        $query->execute([$id]);
        
    }
    
    function insertProduct($nombre_producto){
        $query = $this->db->prepare('INSERT INTO producto(nombre_producto) VALUES(?)');
        
        $query->execute(array($nombre_producto));
    
        return $this->db->lastInsertId();
    }
    function updateProduct($nombre_producto,$id_productos){
        $query = $this->db->prepare('UPDATE producto SET nombre_producto = ? WHERE id_productos = ?');
        $query->execute(array($nombre_producto, $id_productos));
    }








}
?>