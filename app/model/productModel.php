<?php
require_once 'config.php'; 

class productModel{


    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);

    }

    function getProductAll(){
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }
    
    function getProduct($id){
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);

        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto;
    }
    
    function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        
    }
    
    function insertProduct($nombre_producto){
        $query = $this->db->prepare('INSERT INTO productos(nombre_producto) VALUES(?)');
        
        $query->execute([$nombre_producto]);
    
        return $this->db->lastInsertId();
    }
    function updateProduct($nombre_producto,$id_producto){
        $query = $this->db->prepare('UPDATE productos SET nombre_producto = ? WHERE id_producto = ?');
        $query->execute([$nombre_producto, $id_producto]);
    }








}
?>