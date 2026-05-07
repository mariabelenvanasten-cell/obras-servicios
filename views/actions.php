<?php

require_once __DIR__ . '/../models/Orden.php';

if(isset($_GET['delete'])){

    Orden::delete($_GET['delete']);

    header("Location: dashboard.php");
    exit;
}

if(isset($_GET['id']) && isset($_GET['estado'])){

    Orden::updateEstado($_GET['id'], $_GET['estado']);

    header("Location: dashboard.php");
    exit;
}

?>