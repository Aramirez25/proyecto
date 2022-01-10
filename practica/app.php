<?php session_start();


if(!isset($_SESSION['logueado'])){
    header('Location: login/index.php');
}


if(isset($_SESSION['logueado']) && $_SESSION['logueado'] != 1){
    header('Location: login/index.php');
}
   // initialize errors variable
   $errors = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holi boli</title>
</head>
<body>
    <h1>Entrasteeeeee</h1>

    <p><a href="auth/logout.php">salir</a></p>
</body>
</html>