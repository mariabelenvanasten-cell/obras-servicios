<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/Orden.php";

class OrdenController {

    private $model;

    public function __construct($pdo) {
        $this->model = new Orden($pdo);
    }

    public function listar() {
        return $this->model->getAll();
    }

    public function crear($titulo, $descripcion) {
        if (empty($titulo) || empty($descripcion)) {
            return false;
        }
        return $this->model->create($titulo, $descripcion);
    }

    public function eliminar($id) {
        return $this->model->delete($id);
    }

    public function cambiarEstado($id, $estado) {
        return $this->model->updateEstado($id, $estado);
    }
}
?>