<?php
session_start();

$password = "123123123";

if(isset($_POST["salir"])){
    unset($_SESSION["login"]);
    session_destroy();
}

if(isset($_POST["password"])){
    if($_POST["password"] == $password)
    {
        $_SESSION["login"] = true;
    }
}

if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
?>

    <h1>Bienvenido!</h1>
    <form action="login.php" method="POST">
        <input type="submit" value="Salir" name="salir">
    </form>

<?php } else { ?>

    <form action="login.php" method="POST">
    <input type="text" name="password" placeholder="Contraseña">
    <input type="submit" value="Enviar">
    </form>

<?php } ?>