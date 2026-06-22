<?php

class Orden {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    /* =====================
        CREAR
    ===================== */
    public function create($data){

        $sql = "INSERT INTO ordenes
        (
            descripcion,
            empresa,
            empresa_id,
            cliente,
            tecnico_id,
            area,
            ciudad,
            estado
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pendiente')";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['descripcion'] ?? null,
            $data['empresa'] ?? null,
            $data['empresa_id'] ?? null,
            $data['cliente'] ?? null,
            $data['tecnico_id'] ?? null,
            $data['area'] ?? null,
            $data['ciudad'] ?? null
        ]);
    }

    /* =====================
        GETS
    ===================== */

    // 🔥 FIX IMPORTANTE (ESTO TE FALTABA)
    public function getAll(){
        return $this->pdo
            ->query("SELECT * FROM ordenes ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmpresa($empresa_id){
        $stmt = $this->pdo->prepare("
            SELECT * FROM ordenes
            WHERE empresa_id = ?
            ORDER BY id DESC
        ");

        $stmt->execute([$empresa_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCliente($cliente){
        $stmt = $this->pdo->prepare("
            SELECT * FROM ordenes
            WHERE cliente = ?
            ORDER BY id DESC
        ");

        $stmt->execute([$cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTecnico($tecnico_id){
        $stmt = $this->pdo->prepare("
            SELECT * FROM ordenes
            WHERE tecnico_id = ?
            ORDER BY id DESC
        ");

        $stmt->execute([$tecnico_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
        $stmt = $this->pdo->prepare("
            SELECT * FROM ordenes WHERE id = ?
        ");

        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =====================
        UPDATE
    ===================== */

    public function update($data){

        $actual = $this->getById($data['id']);

        if(!$actual){
            return false;
        }

        $sql = "UPDATE ordenes SET
            descripcion=?,
            empresa=?,
            empresa_id=?,
            cliente=?,
            tecnico_id=?,
            materiales=?,
            costo=?,
            estado=?,
            area=?,
            ciudad=?
        WHERE id=?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['descripcion'] ?? $actual['descripcion'],
            $data['empresa'] ?? $actual['empresa'],
            $data['empresa_id'] ?? $actual['empresa_id'],
            $data['cliente'] ?? $actual['cliente'],
            $data['tecnico_id'] ?? $actual['tecnico_id'],
            $data['materiales'] ?? $actual['materiales'],
            $data['costo'] ?? $actual['costo'],
            $data['estado'] ?? $actual['estado'],
            $data['area'] ?? $actual['area'],
            $data['ciudad'] ?? $actual['ciudad'],
            $data['id']
        ]);
    }

    /* =====================
        DELETE
    ===================== */

    public function delete($id){
        $stmt = $this->pdo->prepare("
            DELETE FROM ordenes WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /* =====================
        AVANCES
    ===================== */

    public function addAvance($orden_id, $usuario, $comentario){
        $stmt = $this->pdo->prepare("
            INSERT INTO avance_historial
            (orden_id, usuario, comentario)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([
            $orden_id,
            $usuario,
            $comentario
        ]);
    }

    public function getAvances($orden_id){
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM avance_historial
            WHERE orden_id = ?
            ORDER BY fecha DESC
        ");

        $stmt->execute([$orden_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}