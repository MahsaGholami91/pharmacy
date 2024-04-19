<?php
    // Check if submit button pressed
    if (isset($_POST["submitBtn"])) {
 
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $role = $_POST['role'];

        require_once "../includes/db.php";
        require_once "../includes/functions.php";

        // check some validation after press submit btn
        if(emptyInputSignin($fullName, $userName, $password, $repeatPassword) !== false){
            header("location: ../pages-add-user.php?error=emptyinput");
            exit();
        }
        if(invalidUid($username) !== false){
            header("location: ../pages-add-user.php?error=invalidUid");
            exit();
        }
        if(passwordMatch($password, $repeatPassword) !== false){
            header("location: ../pages-add-user.php?error=passworddontmatch");
            exit();
        }
        if(uidExists($conn, $username ) !== false){
            header("location: ../pages-add-user.php?error=usernametaken");
            exit();
        }
    
// var_dump('1');
        createUser($conn,$fullName, $userName, $password, $role);
    }
    else {
        echo "gavi";
        // header("Location: ../signIn.php");
        exit();
    }



