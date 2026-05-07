<?php

session_start();

require_once __DIR__ . '/../models/Orden.php';

if($_POST){

    Orden::create($_POST);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Nueva Orden</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow">

<div class="text-center">

<img src="../assets/logo.png" width="100">

<h3>Nueva Orden</h3>

</div>

<form method="POST">

<textarea name="descripcion" class="form-control mt-2" placeholder="Descripción"></textarea>

<input name="empresa" class="form-control mt-2" placeholder="Empresa">

<input name="area" class="form-control mt-2" placeholder="Área">

<input name="ciudad" class="form-control mt-2" placeholder="Ciudad">

<button class="btn btn-dark w-100 mt-3">Guardar</button>

</form>

</div>

</div>

</body>
</html>