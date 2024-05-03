<?php
    // ob_start();
    // session_start();
    if (isset($_POST["submitBtn"])) {
 
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $role = $_POST['role'];

        require_once "../includes/db.php";
        require_once "../includes/functions.php";

        if(emptyInputSignin($fullName, $userName, $password, $repeatPassword ,$role) !== false){

            $_SESSION['error-msg'] = "Fill in the fields with stars";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        if(invalidUid($username) !== false){
            $_SESSION['error-msg'] = "username dosent valid";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        if(passwordMatch($password, $repeatPassword) !== false){
            $_SESSION['error-msg'] = "password and repeat password dosent same!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        if(uidExists($conn, $username ) !== false){
            $_SESSION['error-msg'] = "username exist!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
   
        if(createUser($conn,$fullName, $userName, $password, $role)){
            $_SESSION['success-msg'] = "user added!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();

        }else {
            $_SESSION['error-msg'] = "something was wrong!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        
    }
    else {
        $_SESSION['error-msg'] = "something was wrong!";
        header("location: ../nice-html/ltr/pages-add-user.php");
        exit();
    }



