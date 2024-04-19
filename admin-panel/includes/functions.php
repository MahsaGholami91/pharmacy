<?php

function emptyInputSignin($fullName, $userName, $password, $passwordRepeat) {
    $result=true;
    if(empty($fullName) || empty($userName) || empty($password) || empty($passwordRepeat)){
        $result = true;
    }
    else {
        $result =false;
    }
    return $result;
}

function invalidUid($userName) {
    $result=true;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){
        $result = true;
    }
    else {
        $result =false;
    }
    return $result;
}

function passwordMatch($password, $passwordRepeat) {
    $result =true;
    if($password !== $passwordRepeat){
        $result = true;
    }
    else {
        $result =false;
    }
    return $result;
}

function uidExists($conn, $userName) {
    $sql = "SELECT * FROM users WHERE username = ? ;";
    $stmt = mysqli_stmt_init($conn);
   
    if(!mysqli_stmt_prepare($stmt,$sql) ){
        header("location: ../pages-add-user.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$userName);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result =false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $fullName, $userName, $password, $role) {

    $sql = "INSERT INTO `users` (`fullname`, `username`, `password`, `roleId`) VALUES (? , ? ,? ,?);";
    $stmt = mysqli_stmt_init($conn);
   
    if(!mysqli_stmt_prepare($stmt,$sql) ){
    header("location: ../nice-html/ltr/pages-add-user.php?error=stmtfailed");
    exit();
    }
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
     mysqli_stmt_bind_param($stmt,"sssi",$fullName, $userName, $hashedPwd, $role);

     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     header("location: ../nice-html/ltr/pages-add-user.php?error=none");
    exit();

}

?>