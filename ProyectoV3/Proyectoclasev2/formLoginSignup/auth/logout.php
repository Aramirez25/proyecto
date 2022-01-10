<?php 
session_start();

session_destroy();

header("Location: ../loginregister/index.php");
?>