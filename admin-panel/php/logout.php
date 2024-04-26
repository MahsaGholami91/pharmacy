<?php
echo "dddd";

session_start();

if(isset($_SESSION['username'])) {
    $_SESSION = array();
    session_destroy();
    header("location: ../../login-page/login.php");
    exit;
} else {
    header("location: ../../login-page/login.php");
    exit;
}
?>
