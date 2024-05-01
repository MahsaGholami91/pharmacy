<?php

session_start();
require_once "../includes/db.php";

if(isset($_POST["submit"])) {
    $_SESSION['error-msg'] = "";
    $username = $_POST["userName"];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $check = password_verify($password , $row['password']);
        if($check){
            
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            $_SESSION['roleId'] = $row['roleId'];
            header("location: ../nice-html/ltr/dashboard.php");
            exit; 
        }
        else {

            $_SESSION['error-msg'] = "*Wrong username or password!";
            // echo $_SESSION['error-msg'];
            // die;
            header("location: ../../login-page/login.php");
            // exit();
        }
    } else {
            $_SESSION['error-msg'] = "*something was wrong, user not found!";
            header("location: ../../login-page/login.php");
            // exit();
    }
}
?>