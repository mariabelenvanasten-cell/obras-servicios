<?php
require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);
$ordenes = $model->getAll();
?>

<h1>Dashboard</h1>

<a href="crear.php">Nueva Orden</a>

<ul>
<?php foreach ($ordenes as $o): ?>
    <li>
        <?= $o['titulo'] ?> - <?= $o['descripcion'] ?> - <?= $o['estado'] ?>

        <a href="../controllers/OrdenController.php?delete=<?= $o['id'] ?>">Eliminar</a>
        <a href="../controllers/OrdenController.php?id=<?= $o['id'] ?>&estado=ok">OK</a>
    </li>
<?php endforeach; ?>
</ul>