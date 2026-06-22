<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['rol'] != "cliente") {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);

$empresa_id = $_SESSION['empresa_id'];

$stmt = $pdo->prepare("
    SELECT razon_social
    FROM empresas
    WHERE id = ?
");

$stmt->execute([$empresa_id]);

$empresa = $stmt->fetch(PDO::FETCH_ASSOC);

$nombreEmpresa = $empresa['razon_social'] ?? 'Empresa no asignada';

$ordenes = $model->getByEmpresa($empresa_id);

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SGOS - Cliente</title>

<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>SGOS</h2>

        <a href="dashboard_cliente.php">Mis Órdenes</a>
        <a href="crear.php">Nueva Solicitud</a>
        <a href="logout.php">Cerrar Sesión</a>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <h2>Bienvenido Cliente: <?= htmlspecialchars($_SESSION['usuario']) ?></h2>

        <h1>Panel Cliente</h1>

        <p class="card">
            Empresa: <strong><?= htmlspecialchars($nombreEmpresa) ?></strong>
        </p>

        <?php if (empty($ordenes)): ?>
            <div class="card">
                No existen órdenes registradas.
            </div>
        <?php endif; ?>

        <?php foreach ($ordenes as $o): ?>

            <?php
            $clase = "pendiente";

            if ($o['estado'] == "Asignada" || $o['estado'] == "En proceso") {
                $clase = "proceso";
            }

            if (
                $o['estado'] == "Terminada" ||
                $o['estado'] == "Facturada" ||
                $o['estado'] == "Pagada" ||
                $o['estado'] == "Cerrada"
            ) {
                $clase = "finalizado";
            }
            ?>

            <div class="card">

                <h3><?= htmlspecialchars($o['empresa'] ?? '-') ?></h3>

                <p><strong>Descripción:</strong> <?= htmlspecialchars($o['descripcion'] ?? '-') ?></p>
                <p><strong>Técnico:</strong> <?= htmlspecialchars($o['tecnico_id'] ?? 'Sin asignar') ?></p>
                <p><strong>Área:</strong> <?= htmlspecialchars($o['area'] ?? '-') ?></p>
                <p><strong>Ciudad:</strong> <?= htmlspecialchars($o['ciudad'] ?? '-') ?></p>
                <p><strong>Materiales:</strong> <?= htmlspecialchars($o['materiales'] ?? '-') ?></p>

                <!-- COSTO (CONTROLADO) -->
                <p><strong>Costo:</strong> <?= htmlspecialchars($o['costo'] ?? '-') ?></p>

                <p><strong>Fecha:</strong> <?= htmlspecialchars($o['fecha'] ?? '-') ?></p>

                <div class="card">
                    <strong>Avance</strong><br><br>
                    <?= !empty($o['avance'])
                        ? nl2br(htmlspecialchars($o['avance']))
                        : 'Sin avances registrados'; ?>
                </div>

                <!-- 🔥 FORMULARIO DE COMENTARIO CLIENTE -->
                <div class="card">

                    <strong>Comentario para el Técnico / Administrador</strong>

                    <form action="../controllers/OrdenController.php" method="POST">

                        <input type="hidden" name="editar" value="1">
                        <input type="hidden" name="id" value="<?= $o['id'] ?>">

                        <textarea
                            name="comentario_cliente"
                            placeholder="Escribí tu comentario..."
                            required
                        ></textarea>

                        <button type="submit" class="btn btn-guardar">
                            Enviar Comentario
                        </button>

                    </form>

                </div>

                <span class="estado <?= $clase ?>">
                    <?= htmlspecialchars($o['estado']) ?>
                </span>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>