<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['rol'] != "administrador") {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);
$ordenes = $model->getAll();

$total = count($ordenes);

$cerradas = 0;
$pendientes = 0;

foreach ($ordenes as $o) {

    if (
        $o['estado'] == "Terminada" ||
        $o['estado'] == "Facturada" ||
        $o['estado'] == "Pagada" ||
        $o['estado'] == "Cerrada"
    ) {
        $cerradas++;
    }

    if ($o['estado'] == "Pendiente") {
        $pendientes++;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SGOS - Panel Administrador</title>

<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>SGOS</h2>

        <a href="dashboard_admin.php">Dashboard</a>
        <a href="crear.php">Nueva Orden</a>
        <a href="reportes.php">Reportes</a>
        <a href="logout.php">Cerrar Sesión</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- BIENVENIDA -->
        <h2>Bienvenido Administrador: <?= $_SESSION['usuario'] ?></h2>

        <h1>Panel de Administración</h1>

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
                <h3>Finalizadas</h3>
                <h1><?= $cerradas ?></h1>
            </div>

        </div>

        <p style="margin-bottom:20px;">
            <a href="crear.php" class="btn">
                Nueva Orden
            </a>
        </p>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Cliente</th>
                    <th>Técnico</th>
                    <th>Estado</th>
                    <th>Área</th>
                    <th>Ciudad</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($ordenes as $o): ?>

                <?php
                $estado = $o['estado'];
                $clase = "pendiente";

                if ($estado == "Asignada" || $estado == "En proceso") {
                    $clase = "proceso";
                }

                if (
                    $estado == "Terminada" ||
                    $estado == "Facturada" ||
                    $estado == "Pagada" ||
                    $estado == "Cerrada"
                ) {
                    $clase = "finalizado";
                }
                ?>

                <tr>
                    <td><?= $o['id'] ?></td>
                    <td><?= htmlspecialchars($o['empresa'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($o['cliente'] ?? '-') ?></td>
                    <td>
                        <?= !empty($o['tecnico'])
                            ? htmlspecialchars($o['tecnico'])
                            : 'Sin asignar'; ?>
                    </td>

                    <td>
                        <span class="estado <?= $clase ?>">
                            <?= htmlspecialchars($estado) ?>
                        </span>
                    </td>

                    <td><?= htmlspecialchars($o['area'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($o['ciudad'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($o['fecha'] ?? '-') ?></td>

                    <td>
                        <a class="btn btn-warning" href="editar.php?id=<?= $o['id'] ?>">
                            Editar
                        </a>

                        <a class="btn btn-danger"
                           href="../controllers/OrdenController.php?delete=<?= $o['id'] ?>"
                           onclick="return confirm('¿Eliminar esta orden?')">
                            Eliminar
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>

    </div>

</div>

</body>
</html>