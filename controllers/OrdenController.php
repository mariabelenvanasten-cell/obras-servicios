<?php

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/Orden.php";

$model = new Orden($pdo);

/* CREAR ORDEN */
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $model->create($_POST);

    header("Location: ../views/dashboard_operativo.php");
    exit;
}

/* CAMBIAR ESTADO */
if(isset($_GET['estado'])){

    $model->updateEstado($_GET['id'], $_GET['estado']);

    header("Location: ../views/dashboard_operativo.php");
    exit;
}

/* ELIMINAR */
if(isset($_GET['delete'])){

    $model->delete($_GET['delete']);

    header("Location: ../views/dashboard_operativo.php");
    exit;
}