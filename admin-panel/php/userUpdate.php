<?php
    // session_start();

include "../includes/db.php";
include "../includes/functions.php";
if (isset($_POST['submitBtn'])) {
    

    
    $updatedUserId      = $_POST['userId'];
    $updatedFullname    = $_POST['fullName'];
    $updatedUserName    = $_POST['userName'];
    $updatedUserPass    = $_POST['password'];
    $updatedUserRepass    = $_POST['repeatPassword'];
    $updatedUserRole    = $_POST['role'];
    $hashedPwd = password_hash($updatedUserPass, PASSWORD_DEFAULT);
    
    if(emptyInputSignin($updatedFullname, $updatedUserName, $updatedUserPass, $updatedUserRepass ,$updatedUserRole) !== false){
        $_SESSION['error-msg'] = "Fill in the fields with stars";

        header("location: ../nice-html/ltr/pages-profile.php");
        exit();
    }
    if(invalidUid($updatedUserName) !== false){
        $_SESSION['error-msg'] = "username dosent valid";

        header("location: ../nice-html/ltr/pages-profile.php");
        exit();
    }
    if(passwordMatch($updatedUserPass, $updatedUserRepass) !== false){
        $_SESSION['error-msg'] = "password and repeat password dosent same!";

        header("location: ../nice-html/ltr/pages-profile.php");
        exit();
    }
    if(uidExists($conn, $updatedUserName ) !== false){
        $_SESSION['error-msg'] = "username exist!";

        header("location: ../nice-html/ltr/pages-profile.php");
        exit();
    }
    $sql = "UPDATE `users` SET `fullname` = ?, `username` = ?, `password` = ?, `roleId` = ? WHERE id = $updatedUserId";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $updatedFullname, $updatedUserName, $hashedPwd, $updatedUserRole);

        mysqli_stmt_execute($stmt);

        $_SESSION['success-msg'] = "user information changed!";
        header("location: ../nice-html/ltr/pages-profile.php");
        exit();

    } else {
        $_SESSION['error-msg'] = "something was wrong!";
        header("location: ../nice-html/ltr/pages-add-user.php");
        exit();}
}
?>