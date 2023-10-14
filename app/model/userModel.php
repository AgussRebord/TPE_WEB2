<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_heladeria;charset=utf8', 'root', '');
    }

    public function getByUserName($userName) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE userName = ?');
        $query->execute([$userName]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
