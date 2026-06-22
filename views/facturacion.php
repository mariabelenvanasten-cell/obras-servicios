<?php

session_start();

require_once "../config/db.php";
require_once "../models/Factura.php";

$model = new Factura($pdo);

$facturas = $model->getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Facturación</title>

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
    grid-template-columns:2fr 2fr 1fr 1fr;
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

<h1>💲 Facturación</h1>

<div class="table">

<div class="row head">
<div>Empresa</div>
<div>Servicio</div>
<div>Costo</div>
<div>Fecha</div>
</div>

<?php foreach($facturas as $f): ?>

<div class="row">

<div><?= htmlspecialchars($f['empresa']) ?></div>

<div><?= htmlspecialchars($f['servicio']) ?></div>

<div>$<?= number_format($f['costo'],2,',','.') ?></div>

<div><?= htmlspecialchars($f['fecha']) ?></div>

</div>

<?php endforeach; ?>

</div>

</body>
</html>