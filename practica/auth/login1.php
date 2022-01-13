<?php session_start();
/*1) Leer los datos del formulario*/
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

/*2) Verificar los datos 

    En este caso la lista TO_DO*/
/*3) Hacer la conexión a la base de datos y ver si existe en este caso estoy trabajando con una clase por eso el 
new mysqli que viene a ser el nombre de la clase*/

    /*CONEXION*/
$conexion = new mysqli ('localhost', 'root', '', 'pruebaapp') or die(mysqli_error());
$conexion->set_charset("utf8");
$query = "SELECT contrasena FROM usuarios WHERE `email` = '".$email."'";

$resultado = $conexion->query($query) or die($conexion->error);
$fila = $resultado->fetch_all(MYSQLI_ASSOC);
$pass_c = $fila[0]["contrasena"];

if(password_verify($contrasena, $pass_c)){
    $_SESSION['logueado'] = 1;
    header('Location: ../app.php');
   
}else{
    header('Location: ../login/index.php?error=credentials_fail');
            die();
}

?>