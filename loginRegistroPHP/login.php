<?php
include('config.php');
session_start();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");//REVISAR LOS NOMBRES EN LA BASE DE DATOS
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo '<p class="error">Esa combinación de nombre de usuario es incorrecta!</p>';
    } else{
        if (password_verify($password, $result['PASSWORD'])){
            $_SESSION['user_id'] = $result ['ID'];
            echo '<P class="success>Felicidades, estás logeado!</p>';
        }else{
            echo '<p class="error">El nombre de usuario y su combinación es incorrecta!</p>';
        }
    }
}

?>