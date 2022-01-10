<?php session_start();
$errors = [
    "1062" => "Ese email ya existe",
    "1032" => "Contraseña no encaja",
    "password_not_match" => "La verificacion de contraseña ha fallado",
    "credentials_fail" => "Credenciales incorrectas",
    "db_fail" => "Error en la base de datos",
    "error_consulta" => "Error en la consulta"
];?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Login</title>
</head>
<body>
    <h1>Inicio de sesión</h1>
        <?php
            if(isset($_GET['error'])){
                echo '<div style="color:red;">'.$errors[$_GET['error']].'</div>';
            }
        ?>
    <form name="formularioL" action="../auth/login.php" method="post">
        <div>
            <input name="email" type="email" placeholder="Email" required>
        </div>
        <div>    
            <input name="contrasena" type="password" placeholder="Contraseña" required>
        </div>
            <input name="boton" type="submit">
        </div>
    </form>
</body>
</html>