<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Nueva Empresa</title>

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

<h1>🏢 Nueva Empresa</h1>

<form action="../../controllers/EmpresaController.php" method="POST">

<input
type="text"
name="razon_social"
placeholder="Razón Social"
required>

<input
type="text"
name="cuit"
placeholder="CUIT">

<input
type="text"
name="direccion"
placeholder="Dirección">

<input
type="text"
name="telefono"
placeholder="Teléfono">

<input
type="email"
name="email"
placeholder="Email">

<select name="estado">
    <option value="activa">Activa</option>
    <option value="inactiva">Inactiva</option>
</select>

<button type="submit">
Guardar Empresa
</button>

</form>

</body>
</html>