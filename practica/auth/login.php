<?php session_start();
/*1) Leer los datos del formulario*/
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

/*2) Verificar los datos 

    En este caso la lista TO_DO*/
/*3) Hacer la conexión a la base de datos y ver si existe en este caso estoy trabajando con una clase por eso el 
new mysqli que viene a ser el nombre de la clase*/

    /*CONEXION*/
$conexion = new mysqli ('localhost', 'root', '', 'pruebaapp');

    /*PREPARAR*/
try{
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE `email` = ? AND `contrasena` = ?");
}catch(mysqli_sql_exception $BDerror){
    echo $BDerror->getMessage();
    header('../login/index.php?error=db_fail');
}
 /*mysqli_sql_exception la primera linea indica el nombre de la clase que antes cree, el sql_exception proporciona
    diversa información acerca de los errores producidos durante un acceso a la base de datos.
    El getMessage obtiene el mensaje de error o de excepcion que queremos. Tenemos los errores en index.php del login
    y dependiendo del tipo de error pues se obtiene un mensaje u otro

    Estos son para la línea que viene abajo. Siempre hay que tenerlos presentes porque depende de lo que tengas en la 
    base de datos. En este caso solo tengo strings pero si tuviese numeros pues iría i, y así. 

    s -> string
    d -> double
    i -> integer
    b -> blob 
    */


    $consulta->bind_param('ss', $email, $contrasena);
    /*Acá las 'ss' hacen referencia a los dos campos que son email y contraseña.
    El bind vincula los valores a los parámetros y la bd ejecuta la instrucción */
    if(!$consulta){
        header('Location: ../login/index.php?error=error_consulta');
        die();
    }else{

    /*EJECUTAR*/
        $consulta->execute();
        $usuario = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        /*Fetch all es que me busque todos los resultados luego de ser obtenidos y me los pase a un array asociativo */

    /* 3. Si se encuentra:*/
        if(count($usuario) == 1){
            /* 1. Iniciar sesion*/
            $_SESSION['logueado'] = 1;
            /* 2. Redireccionar a la app php que esté haciendo en este caso se llama app.php*/
            header('Location: ../app.php');
        } else {
            header('Location: ../login/index.php?error=credentials_fail');
            die();
        }
    }


?>
