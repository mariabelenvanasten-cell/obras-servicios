<?php

class Usuario {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function login($usuario, $clave){

    $sql = "SELECT *
            FROM usuarios
            WHERE (usuario = ? OR email = ?)
            AND clave = ?";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        $usuario,
        $usuario,
        $clave
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function getByRol($rol){

        $sql = "SELECT *
                FROM usuarios
                WHERE rol = ?
                ORDER BY usuario";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$rol]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}