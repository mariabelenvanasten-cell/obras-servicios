<?php

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/Empresa.php";

$model = new Empresa($pdo);

/* CREAR EMPRESA */

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['editar'])) {

    $model->create($_POST);

    header("Location: ../views/empresas/index.php");
    exit;
}

/* EDITAR EMPRESA */

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {

    $model->update($_POST);

    header("Location: ../views/empresas/index.php");
    exit;
}

/* ELIMINAR EMPRESA */

if (isset($_GET['delete'])) {

    $model->delete($_GET['delete']);

    header("Location: ../views/empresas/index.php");
    exit;
}