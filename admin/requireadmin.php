<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../onepiece.php");
        die();
    }else if($_SESSION["email"]!= 'admin@gmail.com'){
        header("Location: ../onepiece.php");
        die();
        }
?>