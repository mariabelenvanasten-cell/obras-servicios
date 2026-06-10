<?php

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/Orden.php";

$model = new Orden($pdo);

header("Content-Type: application/json");

$action = $_POST['action'] ?? '';

if ($action == "delete") {

    $model->delete($_POST['id']);

    echo json_encode([
        "status" => "ok",
        "message" => "Orden eliminada"
    ]);
    exit;
}

if ($action == "estado") {

    $model->updateEstado($_POST['id'], $_POST['estado']);

    echo json_encode([
        "status" => "ok",
        "message" => "Estado actualizado"
    ]);
    exit;
}

echo json_encode([
    "status" => "error",
    "message" => "Acción inválida"
]);