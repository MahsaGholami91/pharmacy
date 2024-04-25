<?php
session_start();
require_once "../includes/db.php";

if(isset($_POST["submit"])) {

    $username = $_POST["userName"];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `userName` = '$username'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $check = password_verify($password , $row['password']);
        $userid = $row['id'];
        $userRoleid = $row['roleId'];
        if($check){
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userid;
            $_SESSION['roleId'] = $userRoleid;
          

            switch ($userRoleid) {
                case $userRoleid = 1:
                    header("location: ../nice-html/ltr/admin-dashboard.php");
                    break;
                case $userRoleid = 2:
                    header("location: ../nice-html/ltr/employee-dashboard.php");
                    break;
                case $userRoleid = 3:
                    header("location: ../nice-html/ltr/analizer-dashboard.php");
                    break;
                default:
                    // Handle unexpected role
                    echo "Unknown role!";
                    break;
            }
            exit; // Exit to prevent further execution
        }
        else {
            echo 'Wrong username or password';
        }
    } else {
        echo 'User not found';
    }
}
?>
