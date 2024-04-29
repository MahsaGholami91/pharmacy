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

function emptyInputDrugs($drugName, $drugDose, $drugCount, $drugExp, $drugCat) {
    $result=true;
    if(empty($drugName) || empty($drugDose) || empty($drugCount) || empty($drugExp) || empty($drugCat)){
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

function addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat) {
    $sql = "SELECT * FROM `drugs` WHERE `name` = ? AND `dose` = ? AND `expireDate` = ? AND `drugCat` = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages-add-drug.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "siss", $drugName, $drugDose, $drugExp, $drugCat);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rowCount = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    if ($rowCount > 0) {
        $sql = "UPDATE `drugs` SET `drugCount` = `drugCount` + ? WHERE `name` = ? AND `dose` = ? AND `expireDate` = ? AND `drugCat` = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../pages-add-drug.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "isiss", $drugCount, $drugName, $drugDose, $drugExp, $drugCat);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true; 
    } else {
        $sql = "INSERT INTO drugs (`name`, `dose`, `expireDate`, `drugCat`, `drugCount`, `description`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../pages-add-drug.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sisiis", $drugName, $drugDose, $drugExp, $drugCat, $drugCount, $drugDesc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true; 
    }
}

function addText($conn, $beforeAna, $afterAna,$userId) {
    $sql = "INSERT INTO `text` (`text`, `analyzed`, `userId`) VALUES (? , ? ,?);";
    $stmt = mysqli_stmt_init($conn);
   
    if(!mysqli_stmt_prepare($stmt,$sql) ){
        return false;
    }
     mysqli_stmt_bind_param($stmt,"ssi",$beforeAna, $afterAna,$userId);

     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
    return true;
}

function getPermission($conn, $permission) {
    if (isset($_SESSION['roleId']) && !empty($_SESSION['roleId'])) {
        $query = "SELECT `permission` FROM `permission` JOIN `role_permission` on `permission`.`id`=`role_permission`.`permissionId` WHERE `role_permission`.`roleId`= '" . $_SESSION['roleId'] . "';";
        $status = false;
        $result = mysqli_query($conn, $query);

        $allPermissions = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $allPermissions[] = $row['permission'];
        }
        var_dump($_SESSION['roleId']);
        var_dump($permission);
        var_dump($allPermissions);
        die;

        if (!in_array($permission, $allPermissions)) {
            header("location: ../nice-html/ltr/error-404.php");
            exit;
        }
    } else {

        header("location: ../nice-html/ltr/login.php");
        exit;
    }
}



// function getPermission($conn, $permission) {
//     $query = "SELECT `permission` FROM `permission` JOIN `role_permission` on `permission`.`id`=`role_permission`.`permissionId` WHERE `role_permission`.`roleId`= '" . $_SESSION['roleId'] . "';";
//     $status = false;
//     $result = mysqli_query($conn, $query);

//     $allPermissions = array();

//     while ($row = mysqli_fetch_assoc($result)) {
//         $allPermissions[] = $row['permission'];
//     }
//     if (in_array($permission, $allPermissions)) {
//         $status = true;
//     }
//     if($status == false){
//         header("location: ../nice-html/ltr/error-404.php");
//         exit;
//     }
// }

?>