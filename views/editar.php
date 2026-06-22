<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);

$rol = $_SESSION['rol'];

$esAdmin = ($rol === 'administrador');
$esTecnico = ($rol === 'tecnico');
$esCliente = ($rol === 'cliente');

if (!isset($_GET['id'])) {

    $map = [
        'administrador' => 'dashboard_admin.php',
        'tecnico' => 'dashboard_tecnico.php',
        'cliente' => 'dashboard_cliente.php'
    ];

    header("Location: " . ($map[$rol] ?? 'login.php'));
    exit;
}

$orden = $model->getById($_GET['id']);

if (!$orden) {
    die("Orden no encontrada");
}

$avances = $model->getAvances($orden['id']);

$empresas = $pdo->query("
    SELECT id, razon_social
    FROM empresas
    ORDER BY razon_social
")->fetchAll(PDO::FETCH_ASSOC);

$tecnicos = $pdo->query("
    SELECT id, nombre
    FROM tecnicos
    ORDER BY nombre
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Orden</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="layout">

    <div class="sidebar">

        <h2>SGOS</h2>

        <a href="<?= $esAdmin ? 'dashboard_admin.php' : ($esTecnico ? 'dashboard_tecnico.php' : 'dashboard_cliente.php') ?>">
            Dashboard
        </a>

        <a href="logout.php">Cerrar Sesión</a>

    </div>

    <div class="content">

        <h2>Bienvenido <?= ucfirst($rol) ?>: <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
        <h1>Editar Orden #<?= $orden['id'] ?></h1>

        <form action="../controllers/OrdenController.php" method="POST">

            <input type="hidden" name="editar" value="1">
            <input type="hidden" name="id" value="<?= $orden['id'] ?>">

            <!-- DATOS -->
            <div class="card">

                <?php if ($esAdmin): ?>

                    <label>Descripción</label>
                    <textarea name="descripcion"><?= htmlspecialchars($orden['descripcion']) ?></textarea>

                    <label>Empresa</label>
                    <select name="empresa_id">
                        <?php foreach ($empresas as $empresa): ?>
                            <option value="<?= $empresa['id'] ?>"
                                <?= ($empresa['id'] == $orden['empresa_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($empresa['razon_social']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Cliente</label>
                    <input type="text" name="cliente" value="<?= htmlspecialchars($orden['cliente']) ?>">

                    <label>Área</label>
                    <input type="text" name="area" value="<?= htmlspecialchars($orden['area']) ?>">

                    <label>Ciudad</label>
                    <input type="text" name="ciudad" value="<?= htmlspecialchars($orden['ciudad']) ?>">

                    <label>Técnico</label>
                    <select name="tecnico_id">
                        <option value="">Sin asignar</option>
                        <?php foreach ($tecnicos as $tecnico): ?>
                            <option value="<?= $tecnico['id'] ?>"
                                <?= ($tecnico['id'] == $orden['tecnico_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tecnico['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                <?php else: ?>

                    <div class="card">
                        <strong>Empresa:</strong> <?= htmlspecialchars($orden['empresa']) ?><br>
                        <strong>Cliente:</strong> <?= htmlspecialchars($orden['cliente']) ?><br>
                        <strong>Área:</strong> <?= htmlspecialchars($orden['area']) ?><br>
                        <strong>Ciudad:</strong> <?= htmlspecialchars($orden['ciudad']) ?>
                    </div>

                <?php endif; ?>

            </div>

            <!-- AVANCES -->
            <div class="card">

                <?php if ($esAdmin || $esTecnico): ?>

                    <h2>Agregar Avance</h2>
                    <textarea name="avance"></textarea>

                <?php else: ?>

                    <h2>Comentario</h2>
                    <textarea name="comentario_cliente"></textarea>

                <?php endif; ?>

            </div>

            <!-- MATERIALES -->
            <div class="card">

                <?php if ($esAdmin || $esTecnico): ?>

                    <label>Materiales</label>
                    <textarea name="materiales"><?= htmlspecialchars($orden['materiales']) ?></textarea>

                <?php else: ?>

                    <label>Materiales</label>
                    <textarea readonly><?= htmlspecialchars($orden['materiales']) ?></textarea>

                <?php endif; ?>

                <!-- COSTO (FIX FINAL) -->
                <?php if ($esAdmin): ?>

                    <label>Costo</label>
                    <input type="number" step="0.01" name="costo"
                        value="<?= htmlspecialchars($orden['costo']) ?>">

                <?php else: ?>

                    <input type="hidden" name="costo"
                        value="<?= htmlspecialchars($orden['costo']) ?>">

                <?php endif; ?>

                <!-- ESTADO -->
                <label>Estado</label>

                <?php if ($esAdmin || $esTecnico): ?>

                    <select name="estado">
                        <option value="Pendiente" <?= $orden['estado']=='Pendiente'?'selected':'' ?>>Pendiente</option>
                        <option value="En proceso" <?= $orden['estado']=='En proceso'?'selected':'' ?>>En proceso</option>
                        <option value="Terminada" <?= $orden['estado']=='Terminada'?'selected':'' ?>>Terminada</option>
                    </select>

                <?php else: ?>

                    <input type="text" value="<?= htmlspecialchars($orden['estado']) ?>" readonly>

                <?php endif; ?>

            </div>

            <div style="margin-top:20px; display:flex; justify-content:flex-end;">
    <button type="submit" class="btn-guardar">
        Guardar Cambios
    </button>
</div>

        </form>

        <!-- HISTORIAL -->
        <div class="card">

            <h2>Historial de Avances</h2>

            <?php foreach ($avances as $a): ?>
                <div style="border-bottom:1px solid #ccc; padding:10px;">
                    <strong><?= htmlspecialchars($a['usuario']) ?></strong>
                    <small><?= $a['fecha'] ?></small>
                    <p><?= nl2br(htmlspecialchars($a['comentario'])) ?></p>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

</div>

</body>
</html>