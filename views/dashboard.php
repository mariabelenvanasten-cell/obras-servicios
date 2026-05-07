<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../models/Orden.php';

$ordenes = Orden::all();
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="text-center mb-3">

<img src="../assets/logo.png" width="100">

<h2>📊 Obras & Servicios</h2>

<p>
Usuario: <?= $_SESSION['user'] ?> |
Rol: <?= $_SESSION['role'] ?>
</p>

</div>

<?php if($_SESSION['role'] == 'admin'): ?>
<a href="crear.php" class="btn btn-dark mb-3">➕ Nueva Orden</a>
<?php endif; ?>

<table class="table table-bordered bg-white">

<tr>
<th>ID</th>
<th>Descripción</th>
<th>Empresa</th>
<th>Área</th>
<th>Ciudad</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php foreach($ordenes as $o): ?>

<tr>

<td><?= $o['id'] ?></td>
<td><?= $o['descripcion'] ?></td>
<td><?= $o['empresa'] ?></td>
<td><?= $o['area'] ?></td>
<td><?= $o['ciudad'] ?></td>

<td><?= $o['estado'] ?></td>

<td>

<a href="actions.php?delete=<?= $o['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>

<a href="actions.php?id=<?= $o['id'] ?>&estado=en proceso" class="btn btn-primary btn-sm">Proceso</a>

<a href="actions.php?id=<?= $o['id'] ?>&estado=finalizado" class="btn btn-success btn-sm">Finalizar</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

</body>
</html>