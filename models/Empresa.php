<?php

class Empresa {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function create($data){

        $sql = "INSERT INTO empresas
        (
            razon_social,
            cuit,
            direccion,
            telefono,
            email,
            estado
        )
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['razon_social'],
            $data['cuit'],
            $data['direccion'],
            $data['telefono'],
            $data['email'],
            $data['estado']
        ]);
    }

    public function getAll(){

        $sql = "SELECT * FROM empresas ORDER BY id DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){

        $sql = "SELECT * FROM empresas WHERE id=?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data){

        $sql = "UPDATE empresas SET
                razon_social=?,
                cuit=?,
                direccion=?,
                telefono=?,
                email=?,
                estado=?
                WHERE id=?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['razon_social'],
            $data['cuit'],
            $data['direccion'],
            $data['telefono'],
            $data['email'],
            $data['estado'],
            $data['id']
        ]);
    }

    public function delete($id){

        $sql = "DELETE FROM empresas WHERE id=?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}