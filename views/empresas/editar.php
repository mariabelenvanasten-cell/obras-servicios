<?php

session_start();

require_once "../../config/db.php";
require_once "../../models/Empresa.php";

$model = new Empresa($pdo);

$empresa = $model->getById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Editar Empresa</title>

<style>

body{
    background:#1f1f1f;
    color:white;
    font-family:Arial;
    padding:30px;
}

h1{
    color:#f5c542;
}

form{
    max-width:600px;
}

input,
select{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:none;
    border-radius:8px;
}

button{
    background:#f5c542;
    color:#222;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}

</style>

</head>

<body>

<h1>✏️ Editar Empresa</h1>

<form action="../../controllers/EmpresaController.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $empresa['id'] ?>">

<input
type="hidden"
name="editar"
value="1">

<input
type="text"
name="razon_social"
value="<?= htmlspecialchars($empresa['razon_social']) ?>"
required>

<input
type="text"
name="cuit"
value="<?= htmlspecialchars($empresa['cuit']) ?>">

<input
type="text"
name="direccion"
value="<?= htmlspecialchars($empresa['direccion']) ?>">

<input
type="text"
name="telefono"
value="<?= htmlspecialchars($empresa['telefono']) ?>">

<input
type="email"
name="email"
value="<?= htmlspecialchars($empresa['email']) ?>">

<select name="estado">
    <option value="activa" <?= $empresa['estado']=='activa'?'selected':'' ?>>
        Activa
    </option>

    <option value="inactiva" <?= $empresa['estado']=='inactiva'?'selected':'' ?>>
        Inactiva
    </option>
</select>

<button type="submit">
Actualizar Empresa
</button>

</form>

</body>
</html>