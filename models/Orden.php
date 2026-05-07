<?php

require_once __DIR__ . '/../config/db.php';

class Orden {

    public static function all() {

        $db = DB::connect();

        return $db->query("SELECT * FROM ordenes ORDER BY id DESC")
                  ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {

        $db = DB::connect();

        $stmt = $db->prepare("
            INSERT INTO ordenes (descripcion, empresa, area, ciudad)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['descripcion'],
            $data['empresa'],
            $data['area'],
            $data['ciudad']
        ]);
    }

    public static function delete($id) {

        $db = DB::connect();

        $stmt = $db->prepare("DELETE FROM ordenes WHERE id=?");

        return $stmt->execute([$id]);
    }

    public static function updateEstado($id, $estado) {

        $db = DB::connect();

        $stmt = $db->prepare("UPDATE ordenes SET estado=? WHERE id=?");

        return $stmt->execute([$estado, $id]);
    }
}
?>