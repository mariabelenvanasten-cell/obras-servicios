<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['rol'] != "tecnico") {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);

$usuario = strtolower(trim($_SESSION['usuario']));

$mapa = [
    'carlos' => 1,
    'gaston' => 2,
    'rodrigo' => 3,
    'juan_tecnico' => 4
];

$tecnico_id = $mapa[$usuario] ?? 0;

$ordenes = $model->getByTecnico($tecnico_id);

$total = count($ordenes);

$pendientes = 0;
$proceso = 0;
$terminadas = 0;

foreach($ordenes as $o){

    if($o['estado'] == 'Pendiente'){
        $pendientes++;
    }

    if($o['estado'] == 'En proceso'){
        $proceso++;
    }

    if($o['estado'] == 'Terminada'){
        $terminadas++;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SGOS - Panel Técnico</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="layout">

    <div class="sidebar">

        <h2>SGOS</h2>

        <a href="dashboard_tecnico.php">Mis Órdenes</a>
        <a href="logout.php">Cerrar Sesión</a>

    </div>

    <div class="content">

        <h1>Panel Técnico</h1>

<p style="margin-bottom:25px;font-size:18px;">
Bienvenido Técnico:
<strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
</p>

        <div class="stats">

            <div class="stat">
                <h3>Total Asignadas</h3>
                <h1><?= $total ?></h1>
            </div>

            <div class="stat">
                <h3>Pendientes</h3>
                <h1><?= $pendientes ?></h1>
            </div>

            <div class="stat">
                <h3>En Proceso</h3>
                <h1><?= $proceso ?></h1>
            </div>

            <div class="stat">
                <h3>Terminadas</h3>
                <h1><?= $terminadas ?></h1>
            </div>

        </div>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Área</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>

            </thead>

            <tbody>

            <?php foreach($ordenes as $o): ?>

            <?php

            $clase = "pendiente";

            if($o['estado'] == "En proceso"){
                $clase = "proceso";
            }

            if($o['estado'] == "Terminada"){
                $clase = "finalizado";
            }

            ?>

            <tr>

                <td><?= $o['id'] ?></td>

                <td>
                    <?= htmlspecialchars($o['empresa']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($o['area']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($o['ciudad']) ?>
                </td>

                <td>
                    <span class="estado <?= $clase ?>">
                        <?= htmlspecialchars($o['estado']) ?>
                    </span>
                </td>

                <td>

                    <a
                    class="btn btn-warning"
                    href="editar.php?id=<?= $o['id'] ?>">
                    Actualizar
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