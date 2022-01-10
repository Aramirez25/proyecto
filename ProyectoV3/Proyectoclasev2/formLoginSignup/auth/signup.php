<?php session_start();

// 1. Leemos los datos del formulario
$user = $_POST['user'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$pwd1 = $_POST['password1'];

// 2. Verificamos los datos del formulario

// TO DO: ver si están vacíos
if($pwd != $pwd1){
    header('Location: ../loginregister/index.php?error=password_not_match&form=signup');
    die();
}

// 3. Hacer la conexión a la base de datos y ver si existe
    // 1. Conexion

    $conexion = new mysqli('localhost', 'root', '', 'to_do');

    try{
        $consulta = $conexion->prepare("INSERT INTO usuarios (name, email, password) VALUES (?, ?, ?)");
    }catch (mysqli_sql_exception $elErrorQueTuvimos){
        echo $elErrorQueTuvimos->getMessage();
        header('Location: ../loginregister/index.php?error=db_fail&form=signup');
        die();
    }

    /*
    s -> string
    d -> double
    i -> integer
    b -> blob 
    */
    

    $consulta->bind_param('sss', $user, $email, $pwd);
    $consulta->execute();
    if($consulta->errno === 1062) {
        header('Location: ../loginregister/index.php?error=1062&form=signup');
        die();
    }
    if(!$consulta){
        header('Location: ../loginregister/index.php?error=error_consulta&form=signup');
        die();
    }else{

    // 1. Redireccionar a index.php
            header('Location: ../loginregister/index.php'); 
    }
    

