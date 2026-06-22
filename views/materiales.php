<?php

session_start();

require_once "../config/db.php";
require_once "../models/Material.php";

$model = new Material($pdo);
$materiales = $model->getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Materiales</title>

<style>

body{
    background:#1f1f1f;
    color:white;
    font-family:Arial;
    padding:30px;
}

h1{
    color:#f5c542;
    margin-bottom:30px;
}

.table{
    background:#2e2e2e;
    border-radius:15px;
    overflow:hidden;
}

.row{
    display:grid;
    grid-template-columns:2fr 1fr 1fr 2fr;
    padding:18px;
    border-bottom:1px solid #444;
}

.head{
    background:#f5c542;
    color:#222;
    font-weight:bold;
}

</style>

</head>

<body>

<h1>📦 Gestión de Materiales</h1>

<div class="table">

<div class="row head">
<div>Material</div>
<div>Cantidad</div>
<div>Stock</div>
<div>Proveedor</div>
</div>

<?php foreach($materiales as $m): ?>

<div class="row">

<div><?= htmlspecialchars($m['nombre']) ?></div>
<div><?= htmlspecialchars($m['cantidad']) ?></div>
<div><?= htmlspecialchars($m['stock']) ?></div>
<div><?= htmlspecialchars($m['proveedor']) ?></div>

</div>

<?php endforeach; ?>

</div>

</body>
</html>