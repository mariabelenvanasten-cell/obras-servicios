<?php

session_start();

require_once "../config/db.php";
require_once "../models/Usuario.php";

$model = new Usuario($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"]);
    $clave = trim($_POST["clave"]);

    $user = $model->login($usuario, $clave);

    if ($user) {

        $_SESSION["id"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["rol"] = $user["rol"];

        switch ($user["rol"]) {

            case "administrador":
                header("Location: ../views/dashboard_admin.php");
                exit;

            case "tecnico":
                header("Location: ../views/dashboard_tecnico.php");
                exit;

            case "cliente":
                header("Location: ../views/dashboard_cliente.php");
                exit;

            default:
                session_destroy();
                header("Location: ../views/login.php");
                exit;
        }

    } else {

        $_SESSION["error"] = "Usuario o contraseña incorrectos";

        header("Location: ../views/login.php");
        exit;
    }
}
?>