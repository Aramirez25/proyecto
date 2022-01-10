<?php session_start();

// 1. Leemos los datos del formulario
$email = $_POST['email'];
$pwd = $_POST['password'];

// 2. Verificamos los datos del formulario

// TO DO: ver si están vacíos

// 3. Hacer la conexión a la base de datos y ver si existe
    // 1. Conexion

    $conexion = new mysqli('localhost', 'root', '', 'to_do');

    try{
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE `email` = ? AND `password` = ?");
    }catch (mysqli_sql_exception $elErrorQueTuvimos){
        echo $elErrorQueTuvimos->getMessage();
        header('Location: ../loginregister/index.php?error=db_fail');
        die();
    }

    /*
    s -> string
    d -> double
    i -> integer
    b -> blob 
    */
    

    $consulta->bind_param('ss', $email, $pwd);

    if(!$consulta){
        header('Location: ../loginregister/index.php?error=error_consulta');
        die();
    }else{

    // 2. Select where user and password
        $consulta->execute();
        $usuario = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);

    // 3. Si se encuentra:
        if(count($usuario) == 1){
            // 1. Iniciar sesion
            $_SESSION['logueado'] = 1;
            // 2. Redireccionar a todo.php
            header('Location: ../todo.php');
        } else {
            header('Location: ../loginregister/index.php?error=credentials_fail');
            die();
        }
    }
    

?>