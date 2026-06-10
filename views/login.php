<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>SGOS</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    background:#1f1f1f;

    display:flex;

    justify-content:center;

    align-items:center;

    height:100vh;
}

.container{

    width:420px;

    background:#2e2e2e;

    padding:40px;

    border-radius:20px;

    border-top:6px solid #f5c542;

    color:white;

    animation: aparecer 0.8s ease;

    box-shadow:0 0 25px rgba(0,0,0,0.6);
}

.logo{

    text-align:center;

    margin-bottom:20px;
}

.logo img{

    width:120px;
}

h1{

    text-align:center;

    color:#f5c542;

    margin-bottom:30px;

    font-size:34px;
}

input{

    width:100%;

    padding:14px;

    margin-bottom:18px;

    border:none;

    border-radius:10px;

    background:#444;

    color:white;

    font-size:15px;

    transition:0.3s;
}

input:focus{

    outline:none;

    background:#555;

    transform:scale(1.02);
}

button{

    width:100%;

    padding:14px;

    border:none;

    border-radius:10px;

    background:#f5c542;

    color:#222;

    font-weight:bold;

    font-size:16px;

    cursor:pointer;

    transition:0.3s;

    box-shadow:0 0 10px rgba(245,197,66,0.4);
}

button:hover{

    transform:translateY(-2px);

    background:#ffd95e;
}

.info{

    margin-top:25px;

    text-align:center;

    color:#bbb;

    line-height:1.6;
}

@keyframes aparecer{

    from{
        opacity:0;
        transform:translateY(30px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>

</head>

<body>

<div class="container">

<div class="logo">

<img
src="../assets/img/logo.png">

</div>

<h1>Bienvenidos</h1>

<form action="../controllers/AuthController.php" method="POST">

<input
type="text"
name="usuario"
placeholder="Usuario"
required>

<input
type="password"
name="clave"
placeholder="Contraseña"
required>

<button type="submit">
Ingresar
</button>

</form>

<div class="info">

Sistema de Gestión Operativa
de Obras y Servicios

</div>

</div>

</body>
</html>