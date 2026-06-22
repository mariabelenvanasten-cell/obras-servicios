<?php

session_start();

require_once "../../config/db.php";
require_once "../../models/Empresa.php";

$model = new Empresa($pdo);
$empresas = $model->getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Empresas</title>

<style>

body{
    background:#1f1f1f;
    color:white;
    font-family:Arial;
    padding:30px;
}

h1{
    color:#f5c542;
    margin-bottom:20px;
}

.btn{
    background:#f5c542;
    color:#222;
    padding:10px 15px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

.table{
    margin-top:20px;
    background:#2e2e2e;
    border-radius:15px;
    overflow:hidden;
}

.row{
    display:grid;
    grid-template-columns:2fr 1fr 2fr 1fr 2fr 1fr 1fr;
    padding:15px;
    border-bottom:1px solid #444;
}

.head{
    background:#f5c542;
    color:#222;
    font-weight:bold;
}

a{
    color:#f5c542;
    text-decoration:none;
}

</style>

</head>

<body>

<h1>🏢 Empresas</h1>

<a class="btn" href="crear.php">Nueva Empresa</a>

<div class="table">

<div class="row head">
<div>Razón Social</div>
<div>CUIT</div>
<div>Dirección</div>
<div>Teléfono</div>
<div>Email</div>
<div>Estado</div>
<div>Acciones</div>
</div>

<?php foreach($empresas as $empresa): ?>

<div class="row">

<div><?= htmlspecialchars($empresa['razon_social']) ?></div>
<div><?= htmlspecialchars($empresa['cuit']) ?></div>
<div><?= htmlspecialchars($empresa['direccion']) ?></div>
<div><?= htmlspecialchars($empresa['telefono']) ?></div>
<div><?= htmlspecialchars($empresa['email']) ?></div>
<div><?= htmlspecialchars($empresa['estado']) ?></div>

<div>
<a href="editar.php?id=<?= $empresa['id'] ?>">Editar</a>
 |
<a href="../../controllers/EmpresaController.php?delete=<?= $empresa['id'] ?>"
onclick="return confirm('¿Eliminar empresa?')">
Eliminar
</a>
</div>

</div>

<?php endforeach; ?>

</div>

</body>
</html>