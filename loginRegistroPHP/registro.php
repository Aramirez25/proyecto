<?php 
include('config.php');
session_start();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $connection -> prepare("SELECT * FROM users WHERE EMAIL=:email"); //REVISAR VALORES EN LA BASE DE DATOS
    $query ->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    
    if($query->rowCount() > 0){
        echo '<p class="error">Esta dirección de email ya se encuentra registrada!</p>';
    }

    if($query->rowCount() == 0){
        $query = $connection->prepare("INSERT INTO users(USERNAME, PASSWORD, EMAIL") VALUES (:user //REVISAR VALORES EN MI BASE DE DATOS
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();
   
    if($result){
        echo '<p class="success">Tu registro fue satisfactorio!</p>';
    } else {
        echo '<p class="error">Algo ha salido mal, por favor intentelo de nuevo</p>';
    }
    }
 }
?>