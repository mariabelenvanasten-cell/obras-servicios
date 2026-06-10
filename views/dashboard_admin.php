<?php

session_start();

if(!isset($_SESSION['rol'])){

    header("Location: login.php");
    exit;
}

if($_SESSION['rol'] != "administrador"){

    header("Location: login.php");
    exit;
}
?>

session_start();

require_once "../config/db.php";
require_once "../models/Orden.php";

$model = new Orden($pdo);

$ordenes = $model->getAll();

$total = count($ordenes);

$finalizadas = 0;
$pendientes = 0;

foreach($ordenes as $o){

    if($o['estado'] == "Finalizado"){
        $finalizadas++;
    } else {
        $pendientes++;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

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
}

.sidebar{

    width:250px;

    background:#2b2b2b;

    height:100vh;

    padding:20px;
}

.sidebar h2{

    color:#f5c542;

    margin-bottom:30px;
}

.sidebar a{

    display:block;

    color:white;

    text-decoration:none;

    padding:12px;

    border-radius:10px;

    margin-bottom:10px;

    transition:0.3s;
}

.sidebar a:hover{

    background:#444;

    transform:translateX(5px);

    color:#f5c542;
}

.content{

    flex:1;

    padding:30px;
}

.top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;
}

.btn{

    background:#f5c542;

    color:#222;

    padding:12px 18px;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;
}

.stats{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:30px;
}

.stat{

    background:#2e2e2e;

    padding:25px;

    border-radius:15px;

    border-left:5px solid #f5c542;
}

.stat h3{

    color:#bbb;

    margin-bottom:10px;
}

.stat h1{

    font-size:38px;

    color:#f5c542;
}

.cards{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));

    gap:20px;
}

.card{

    background:#2e2e2e;

    padding:20px;

    border-radius:15px;

    transition:0.3s;

    border-left:5px solid #f5c542;
}

.card:hover{

    transform:translateY(-5px);

    box-shadow:0 0 15px rgba(0,0,0,0.5);
}

.status{

    margin-top:15px;

    display:inline-block;

    padding:8px 12px;

    border-radius:8px;
}

.pendiente{

    background:#664d03;
}

.finalizado{

    background:#0b7a28;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>SGOS</h2>

<a href="dashboard_admin.php">
🏠 Dashboard
</a>

<a href="crear.php">
📝 Nueva Orden
</a>

<a href="reportes.php">
📊 Reportes
</a>

<a href="materiales.php">
📦 Materiales
</a>

<a href="facturacion.php">
💲 Facturación
</a>

<a href="logout.php">
🚪 Salir
</a>

</div>

<div class="content">

<div class="top">

<h1>
Bienvenido Administrador
</h1>

<a class="btn" href="crear.php">
+ Nueva Orden
</a>

</div>

<div class="stats">

<div class="stat">

<h3>Órdenes Totales</h3>

<h1><?= $total ?></h1>

</div>

<div class="stat">

<h3>Finalizadas</h3>

<h1><?= $finalizadas ?></h1>

</div>

<div class="stat">

<h3>Pendientes</h3>

<h1><?= $pendientes ?></h1>

</div>

</div>

<div class="cards">

<?php foreach($ordenes as $o): ?>

<?php

$clase = "pendiente";

if($o['estado'] == "Finalizado"){
    $clase = "finalizado";
}

?>

<div class="card">

<h2>
🏢 <?= $o['empresa'] ?>
</h2>

<br>

<p>
<?= $o['descripcion'] ?>
</p>

<br>

<p>
📍 Área:
<?= $o['area'] ?>
</p>

<p>
🌎 Ciudad:
<?= $o['ciudad'] ?>
</p>

<div class="status <?= $clase ?>">

<?= $o['estado'] ?>

</div>

<br><br>

<a class="btn"
href="../controllers/OrdenController.php?id=<?= $o['id'] ?>&estado=Finalizado">

Finalizar

</a>

</div>

<?php endforeach; ?>

</div>

</div>

</body>
</html>