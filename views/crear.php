<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Nueva Orden</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{

    background:#1f1f1f;

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    height:100vh;
}

.container{

    width:650px;

    background:#2e2e2e;

    padding:40px;

    border-radius:20px;

    border-top:6px solid #f5c542;
}

h1{

    text-align:center;

    color:#f5c542;

    margin-bottom:30px;
}

textarea,
input{

    width:100%;

    padding:14px;

    margin-bottom:18px;

    border:none;

    border-radius:10px;

    background:#444;

    color:white;

    font-size:15px;
}

textarea{

    resize:none;

    height:130px;
}

button{

    width:100%;

    padding:14px;

    border:none;

    border-radius:10px;

    background:#f5c542;

    color:#222;

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

button:hover{

    background:#ffd95e;

    transform:translateY(-2px);
}

</style>

</head>

<body>

<div class="container">

<h1>📝 Nueva Orden</h1>

<form action="../controllers/OrdenController.php" method="POST">

<textarea
name="descripcion"
placeholder="Descripción del trabajo"></textarea>

<input
type="text"
name="empresa"
placeholder="Empresa">

<input
type="text"
name="area"
placeholder="Área">

<input
type="text"
name="ciudad"
placeholder="Ciudad">

<button type="submit">
Crear Orden
</button>

</form>

</div>

</body>
</html>