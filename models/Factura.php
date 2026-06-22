<?php

class Factura {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function create($data){

        $sql = "INSERT INTO facturas
        (id_orden, servicio, costo, fecha)
        VALUES (?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['id_orden'],
            $data['servicio'],
            $data['costo'],
            $data['fecha']
        ]);
    }

    public function getAll(){

        $sql = "SELECT f.*, o.empresa
                FROM facturas f
                INNER JOIN ordenes o
                ON f.id_orden = o.id";

        return $this->pdo->query($sql)
                         ->fetchAll(PDO::FETCH_ASSOC);
    }
}