<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../views/login.php");
    exit;
}

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {

    $id = $_POST['id'];
    $actual = $model->getById($id);

    if (!$actual) {
        die("Orden no encontrada");
    }

    $rol = $_SESSION['rol'];

    // =========================
    // TECNICO
    // =========================
    if ($rol === 'tecnico') {

        $data = [
            'id' => $id,
            'materiales' => $_POST['materiales'] ?? '',
            'estado' => in_array(
                $_POST['estado'] ?? '',
                ['Pendiente', 'En proceso', 'Terminada']
            ) ? $_POST['estado'] : $actual['estado']
        ];
    }

    // =========================
    // ADMIN
    // =========================
    elseif ($rol === 'administrador') {

        $data = [
            'id' => $id,
            'descripcion' => $_POST['descripcion'] ?? '',
            'empresa' => $_POST['empresa'] ?? '',
            'empresa_id' => $_POST['empresa_id'] ?? '',
            'cliente' => $_POST['cliente'] ?? '',
            'tecnico_id' => $_POST['tecnico_id'] ?? null,
            'area' => $_POST['area'] ?? '',
            'ciudad' => $_POST['ciudad'] ?? '',
            'materiales' => $_POST['materiales'] ?? '',
            'costo' => $_POST['costo'] ?? 0,
            'estado' => $_POST['estado'] ?? $actual['estado']
        ];
    }

    // =========================
    // CLIENTE
    // =========================
    else {

        $data = [
            'id' => $id,
            'estado' => $actual['estado']
        ];

        if (!empty(trim($_POST['comentario_cliente'] ?? ''))) {
            $model->addAvance(
                $id,
                "CLIENTE",
                trim($_POST['comentario_cliente'])
            );
        }
    }

    // =========================
    // UPDATE (SIN ERRORES)
    // =========================
    $model->update($data);

    // =========================
    // AVANCES
    // =========================
    if (
        in_array($rol, ['administrador', 'tecnico']) &&
        !empty(trim($_POST['avance'] ?? ''))
    ) {
        $model->addAvance(
            $id,
            $_SESSION['usuario'] ?? $rol,
            trim($_POST['avance'])
        );
    }

    // =========================
    // REDIRECCIÓN SEGURA
    // =========================

    $map = [
        'administrador' => 'dashboard_admin.php',
        'tecnico' => 'dashboard_tecnico.php',
        'cliente' => 'dashboard_cliente.php'
    ];

    header("Location: ../views/" . ($map[$rol] ?? 'login.php'));
    exit;
}