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
        if($check){
            $_SESSION['username'] = $username;
          
            switch ($row['roleId']) {
                case $row['roleId'] = 1:
                    header("location: ../nice-html/ltr/admin-dashboard.php");
                    break;
                case $row['roleId'] = 2:
                    header("location: ../nice-html/ltr/employee-dashboard.php");
                    break;
                case $row['roleId'] = 3:
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
