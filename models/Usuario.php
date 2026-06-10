<?php

class Usuario {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($usuario, $clave) {

        $sql = "SELECT * FROM usuarios
                WHERE usuario = ?
                AND clave = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            $usuario,
            $clave
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>