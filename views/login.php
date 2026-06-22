<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SGOS - Acceso al Sistema</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.login-box{
    width:400px;
    background:#ffffff;
    padding:40px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

.logo{
    text-align:center;
    margin-bottom:20px;
}

.logo img{
    max-width:120px;
}

h1{
    text-align:center;
    margin:0;
    color:#1f2937;
    font-size:28px;
}

.subtitulo{
    text-align:center;
    color:#6b7280;
    margin-bottom:25px;
    font-size:14px;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #d1d5db;
    border-radius:8px;
    box-sizing:border-box;
    font-size:14px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#1f2937;
    color:white;
    font-size:15px;
    cursor:pointer;
}

button:hover{
    background:#111827;
}

.error{
    background:#fee2e2;
    color:#991b1b;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
    text-align:center;
}

</style>

</head>

<body>

<div class="login-box">

    <div class="logo">
        <img src="../assets/img/logo.png" alt="SGOS">
    </div>

    <h1>SGOS</h1>

   <div class="subtitulo">
    Acceso al Sistema de Gestión Operativa de Obras y Servicios
</div>

    <?php if(isset($_SESSION['error_login'])): ?>

        <div class="error">
            <?= $_SESSION['error_login']; ?>
        </div>

        <?php unset($_SESSION['error_login']); ?>

    <?php endif; ?>

    <form
    action="../controllers/AuthController.php"
    method="POST">

    <input
        type="text"
        name="usuario"
        placeholder="Correo electrónico o usuario"
        required>

    <input
        type="password"
        name="clave"
        placeholder="Contraseña"
        required>

    <button type="submit">
        Ingresar al Sistema
    </button>

</form>

</div>

</body>
</html>