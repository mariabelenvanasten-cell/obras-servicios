<?php

session_start();

require_once "../config/db.php";
require_once "../models/Usuario.php";

$model = new Usuario($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $clave = trim($_POST["clave"] ?? "");

    if (empty($usuario) || empty($clave)) {

        $_SESSION["error_login"] =
            "Complete usuario y contraseña";

        header("Location: ../views/login.php");
        exit;
    }

    $user = $model->login($usuario, $clave);

    if ($user) {

        $_SESSION["id_usuario"] = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["rol"] = $user["rol"];
        $_SESSION["empresa_id"] = $user["empresa_id"] ?? 0;
        $_SESSION["nombre"] = $user["nombre"] ?? $user["usuario"];

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

                $_SESSION["error_login"] =
                    "Rol de usuario inválido";

                header("Location: ../views/login.php");
                exit;
        }

    } else {

        $_SESSION["error_login"] =
            "Usuario o contraseña incorrectos";

        header("Location: ../views/login.php");
        exit;
    }
}
?>