<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Materiales</title>

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

    padding:20px;

    border-radius:15px;

    border-left:5px solid #f5c542;

    transition:0.3s;
}

.card:hover{

    transform:translateY(-5px);
}

.stock{

    margin-top:15px;

    background:#0b7a28;

    display:inline-block;

    padding:8px 12px;

    border-radius:8px;
}

</style>

</head>

<body>

<h1>📦 Materiales</h1>

<div class="grid">

<div class="card">

<h2>Cables</h2>

<div class="stock">
Stock Disponible
</div>

</div>

<div class="card">

<h2>Interruptores</h2>

<div class="stock">
Stock Disponible
</div>

</div>

<div class="card">

<h2>Fusibles</h2>

<div class="stock">
Stock Disponible
</div>

</div>

</div>

</body>
</html>