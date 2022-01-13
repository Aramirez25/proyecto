<?php session_start();
//1.Leer los datos del formulario

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$contrasenaR = $_POST['contrasenaR'];

//2.Verificar los datos del formulario
if($contrasena != $contrasenaR){
    header('Location: ../register/register.php?error=password_not_match&form=register');
    die();
}

/*Esto va a ser con la contraseña encriptada así que antes le tengo que hacer la encriptación para que 
se guarde en la base de datos*/

$contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);
/*3.Hacer la conexión con la base de datos y ver SI existe*/

    /*Conexión con objetos*/

    $conexion = new mysqli('localhost', 'root', '', 'pruebaapp');
    try{
        /*Acá preparo la consulta que se va a hacer en la base de datos*/
        $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, contrasena, email) VALUES (?, ?, ?)");
    }catch (mysqli_sql_exception $errorconexion){
        /* Si hay un error, entonces pasa lo siguiente y se muestra el error en el header con GET 
        se puede observar que se regresa al index y en el link te muestra el error de la siguiente manera
        despues del index.php sigue = ?error=db_fail&_______=>acá en esta linea va el form al que va, en este caso va
        a registro. 
        
        In our SQL, we insert a question mark (?) where we want to substitute in an integer, string, double or blob value.
        */
        echo $errorconexion->getMessage();
        header('Location: ../register/index.php?error=db_fail&form=register');
        die();
    }
/*
    s -> string
    d -> double
    i -> integer
    b -> blob 
    */
    

    $consulta->bind_param('sss', $usuario, $contrasena_encriptada, $email);
    //Acá las 'sss' hacen referencia a los tres campos que son usuario, email y contraseña.
    //El bind vincula los valores a los parámetros y la bd ejecuta la instrucción 
    $consulta->execute();
    if($consulta->errno === 1062) {
        header('Location: ../register/index.php?error=1062&form=register');
        die();
    }
    if(!$consulta){
        header('Location: ../register/index.php?error=error_consulta&form=register');
        die();
    }else{

    // 1. Redireccionar a index.php que en este caso es el login
            header('Location: ../login/index.php'); 
    }




?>