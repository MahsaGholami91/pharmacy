<?php
include "../includes/db.php";
include "../includes/functions.php";
if (isset($_POST['submitBtn'])) {
    // var_dump($_POST);

    // die;
    
    $updatedUserId      = $_POST['userId'];
    $updatedFullname    = $_POST['fullName'];
    $updatedUserName    = $_POST['userName'];
    $updatedUserPass    = $_POST['password'];
    $updatedUserRepass    = $_POST['repeatPassword'];
    $updatedUserRole    = $_POST['role'];
    $hashedPwd = password_hash($updatedUserPass, PASSWORD_DEFAULT);
    
    if(emptyInputSignin($updatedFullname, $updatedUserName, $updatedUserPass, $updatedUserRepass) !== false){
        header("location: ../nice-html/ltr/pages-profile.php?error=emptyinput");
        exit();
    }
    if(invalidUid($updatedUserName) !== false){
        header("location: ../nice-html/ltr/pages-profile.php?error=invalidUid");
        exit();
    }
    if(passwordMatch($updatedUserPass, $updatedUserRepass) !== false){
        header("location: ../nice-html/ltr/pages-profile.php?error=passworddoesntmatch");
        exit();
    }
    if(uidExists($conn, $updatedUserName ) !== false){
        header("location: ../nice-html/ltr/pages-profile.php?error=usernametaken");
        exit();
    }
    $sql = "UPDATE `users` SET `fullname` = ?, `username` = ?, `password` = ?, `roleId` = ? WHERE id = $updatedUserId";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $updatedFullname, $updatedUserName, $hashedPwd, $updatedUserRole);

        mysqli_stmt_execute($stmt);

        echo "Successful Updated";

    } else {
        echo "Updated was wrong";    
}
}
?>