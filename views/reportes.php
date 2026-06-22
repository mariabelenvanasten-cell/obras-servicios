<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);
$ordenes = $model->getAll();

$total = count($ordenes);

$pendientes = 0;
$enProceso = 0;
$finalizadas = 0;

$empresas = [];

foreach($ordenes as $o){

    $estado = $o['estado'];

    if(
        $estado == "Terminada" ||
        $estado == "Facturada" ||
        $estado == "Pagada" ||
        $estado == "Cerrada"
    ){
        $finalizadas++;
    }
    elseif(
        $estado == "En proceso" ||
        $estado == "Asignada"
    ){
        $enProceso++;
    }
    else{
        $pendientes++;
    }

    if(!empty($o['empresa'])){
        $empresas[$o['empresa']] = true;
    }
}

$totalEmpresas = count($empresas);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SGOS - Reportes</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="layout">

    <div class="sidebar">

        <h2>SGOS</h2>

        <a href="dashboard_admin.php">Dashboard</a>
        <a href="crear.php">Nueva Orden</a>
        <a href="reportes.php">Reportes</a>
        <a href="logout.php">Cerrar Sesión</a>

    </div>

    <div class="content">

        <h1>Reportes Operativos</h1>

        <br>

        <div class="stats">

            <div class="stat">
                <h3>Órdenes Totales</h3>
                <h1><?= $total ?></h1>
            </div>

            <div class="stat">
                <h3>Pendientes</h3>
                <h1><?= $pendientes ?></h1>
            </div>

            <div class="stat">
                <h3>En Proceso</h3>
                <h1><?= $enProceso ?></h1>
            </div>

            <div class="stat">
                <h3>Finalizadas</h3>
                <h1><?= $finalizadas ?></h1>
            </div>

            <div class="stat">
                <h3>Empresas</h3>
                <h1><?= $totalEmpresas ?></h1>
            </div>

        </div>

    </div>

</div>

</body>
</html>