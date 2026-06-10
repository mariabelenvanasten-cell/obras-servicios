<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reportes</title>

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

.grid{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

    gap:20px;
}

.card{

    background:#2e2e2e;

    padding:25px;

    border-radius:15px;

    border-left:5px solid #f5c542;

    transition:0.3s;
}

.card:hover{

    transform:translateY(-5px);
}

.num{

    font-size:40px;

    margin-top:15px;

    color:#f5c542;
}

</style>

</head>

<body>

<h1>📊 Reportes Operativos</h1>

<div class="grid">

<div class="card">

Órdenes Totales

<div class="num">
25
</div>

</div>

<div class="card">

Finalizadas

<div class="num">
18
</div>

</div>

<div class="card">

Pendientes

<div class="num">
7
</div>

</div>

<div class="card">

Empresas

<div class="num">
5
</div>

</div>

</div>

</body>
</html>