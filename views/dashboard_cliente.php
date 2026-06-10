<?php

session_start();

if(!isset($_SESSION['rol'])){

    header("Location: login.php");
    exit;
}

if($_SESSION['rol'] != "cliente"){

    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Panel Cliente</title>

<style>

body{

    background:#1f1f1f;

    color:white;

    font-family:Arial;

    padding:30px;
}

.container{

    background:#2e2e2e;

    padding:30px;

    border-radius:20px;

    border-left:6px solid #f5c542;
}

h1{

    color:#f5c542;

    margin-bottom:20px;
}

.card{

    background:#3a3a3a;

    padding:20px;

    border-radius:15px;

    margin-top:20px;
}

.btn{

    display:inline-block;

    margin-top:20px;

    padding:12px 18px;

    background:#f5c542;

    color:#222;

    text-decoration:none;

    border-radius:10px;

    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h1>👤 Panel Cliente</h1>

<p>
Bienvenido cliente del sistema.
</p>

<div class="card">

<h3>Estado de su orden</h3>

<p>
Su solicitud está en proceso.
</p>

</div>

<a class="btn" href="logout.php">
Cerrar sesión
</a>

</div>

</body>
</html>