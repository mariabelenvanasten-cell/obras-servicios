<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";

$rol = $_SESSION['rol'];

$empresas = [];
$tecnicos = [];

// SOLO ADMIN puede ver todas las empresas y técnicos
if ($rol === 'administrador') {

    $empresas = $pdo->query("
        SELECT id, razon_social
        FROM empresas
        ORDER BY razon_social
    ")->fetchAll(PDO::FETCH_ASSOC);

    $tecnicos = $pdo->query("
        SELECT id, nombre
        FROM tecnicos
        ORDER BY nombre
    ")->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SGOS - Nueva Orden</title>

<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="layout">

    <div class="sidebar">

        <h2>SGOS</h2>

        <?php if ($rol === 'administrador'): ?>
            <a href="dashboard_admin.php">Dashboard</a>
        <?php else: ?>
            <a href="dashboard_cliente.php">Dashboard</a>
        <?php endif; ?>

        <a href="crear.php">Nueva Orden</a>
        <a href="logout.php">Cerrar Sesión</a>

    </div>

    <div class="content">

        <div class="card">

            <h1>Nueva Orden de Trabajo</h1>

            <br>

            <form action="../controllers/OrdenController.php" method="POST">

                <!-- DESCRIPCIÓN -->
                <label>Descripción</label>
                <textarea name="descripcion" required rows="5"></textarea>

                <!-- EMPRESA -->
                <?php if ($rol === 'administrador'): ?>

                    <label>Empresa</label>

                    <select name="empresa_id" required>

                        <option value="">Seleccionar empresa</option>

                        <?php foreach ($empresas as $empresa): ?>
                            <option
                                value="<?= $empresa['id'] ?>"
                                data-nombre="<?= htmlspecialchars($empresa['razon_social']) ?>">
                                <?= htmlspecialchars($empresa['razon_social']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                    <input type="hidden" name="empresa" id="empresa_nombre">

                <?php else: ?>

                    <!-- CLIENTE: empresa fija -->
                    <input type="hidden" name="empresa_id" value="<?= $_SESSION['empresa_id'] ?>">

                    <input type="hidden" name="empresa" value="">

                    <p class="card">
                        Empresa:
                        <strong><?= htmlspecialchars($_SESSION['empresa_nombre'] ?? 'Mi empresa') ?></strong>
                    </p>

                <?php endif; ?>

                <!-- CLIENTE -->
                <label>Cliente</label>
                <input type="text" name="cliente" required>

                <!-- TÉCNICO SOLO ADMIN -->
                <?php if ($rol === 'administrador'): ?>

                    <label>Técnico</label>

                    <select name="tecnico_id">

                        <option value="">Sin asignar</option>

                        <?php foreach ($tecnicos as $tecnico): ?>
                            <option
                                value="<?= $tecnico['id'] ?>"
                                data-nombre="<?= htmlspecialchars($tecnico['nombre']) ?>">
                                <?= htmlspecialchars($tecnico['nombre']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                    <input type="hidden" name="tecnico" id="tecnico_nombre">

                <?php else: ?>

                    <input type="hidden" name="tecnico_id" value="">
                    <input type="hidden" name="tecnico" value="">

                <?php endif; ?>

                <!-- ÁREA -->
                <label>Área</label>
                <input type="text" name="area" required>

                <!-- CIUDAD -->
                <label>Ciudad</label>
                <input type="text" name="ciudad" required>

                <!-- BOTÓN -->
                <button type="submit" class="btn btn-guardar">
                    Crear Orden
                </button>

            </form>

        </div>

    </div>

</div>

<script>

const empresaSelect = document.querySelector('[name="empresa_id"]');

if (empresaSelect) {
    empresaSelect.addEventListener('change', function () {
        document.getElementById('empresa_nombre').value =
            this.options[this.selectedIndex].dataset.nombre || '';
    });
}

const tecnicoSelect = document.querySelector('[name="tecnico_id"]');

if (tecnicoSelect) {
    tecnicoSelect.addEventListener('change', function () {
        document.getElementById('tecnico_nombre').value =
            this.options[this.selectedIndex].dataset.nombre || '';
    });
}

</script>

</body>
</html>