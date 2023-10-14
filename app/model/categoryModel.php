<?php

class categoryModel{

    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_heladeria;charset=utf8', 'root', '');
    }


    function getCategoryAll(){
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    function getCategory($id){
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
        $query->execute(array($id));
        
        $categoria = $query->fetch(PDO::FETCH_OBJ);

        return $categoria;
    }
    
    function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id]);
        
    }
    
    function insertCategory($nombre_categoria){
        $query = $this->db->prepare('INSERT INTO categorias(nombre_categoria) VALUES(?)');
        
        $query->execute(array($nombre_categoria));
    
        return $this->db->lastInsertId();
    }

    function updateCategory($nombre_categoria,$id_categoria){
        $query = $this->db->prepare('UPDATE categorias SET nombre_categoria = ? WHERE id_categoria = ?');
        $query->execute(array($nombre_categoria, $id_categoria));
    }
        
    








}
?>