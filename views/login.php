<?php
session_start();

if($_POST){

    if($_POST['email'] == 'admin@test.com' && $_POST['password'] == '1234'){

        $_SESSION['user'] = 'admin';
        $_SESSION['role'] = 'admin';

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow text-center">

<img src="../assets/logo.png" width="120">

<h3 class="mt-2">Login Sistema</h3>

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="POST">

<input type="email" name="email" class="form-control mt-2" placeholder="Email">

<input type="password" name="password" class="form-control mt-2" placeholder="Password">

<button class="btn btn-dark w-100 mt-3">Ingresar</button>

</form>

</div>

</div>

</body>
</html>