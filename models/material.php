<?php

class Material {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAll(){

        $sql = "SELECT * FROM materiales ORDER BY id DESC";

        return $this->pdo->query($sql)
                         ->fetchAll(PDO::FETCH_ASSOC);
    }
}