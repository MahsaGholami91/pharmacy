<?php

require_once "../includes/db.php";
require_once "../includes/function2.php";
    if(!empty($_GET['logout']) && isset($_SESSION['username'])) {
        $_SESSION = '';
        session_destroy();
        header("location: ../../login-page/login.php");
        exit;
    } 


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
        }
        else {
            $_SESSION['error-msg'] = "*Wrong username or password!";
            header("location: ../../login-page/login.php");
            exit();
        }
    } else {
        $_SESSION['error-msg'] = "*something was wrong, user not found!";
        header("location: ../../login-page/login.php");
        exit();
    }
}

    if(isset($_SESSION['roleId'])){
        if($_SESSION['roleId'] ==1 ){
            headerLayout();
            menuItem();
            if(isset($_GET['menu'])){
    
                if( $_GET['menu'] == "pages-add-Text.php"){
                    addTextForm(); 
                }elseif($_GET['menu'] == "pages-add-user.php"){
                    addUserForm(); 
                }elseif($_GET['menu'] == "pages-add-drug.php"){
                    addDrugForm(); 
                }elseif($_GET['menu'] == "pages-drug-list.php"){
                    drugListForm(); 
                }elseif($_GET['menu'] == "pages-update-drug.php"){
                    updateDrugForm(); 
                }else{
                    dashboard();
    
                }
            }else {
                dashboard();
    
            }
            footerLayout();
    
        }elseif($_SESSION['roleId']==2){
            headerLayout();
            menuItem();
            if(isset($_GET['menu'])){
    
               if($_GET['menu'] == "pages-add-drug.php"){
                    addDrugForm(); 
                }elseif($_GET['menu'] == "pages-drug-list.php"){
                    drugListForm(); 
                }elseif($_GET['menu'] == "pages-update-drug.php"){
                    updateDrugForm(); 
                }else{
                    dashboard();
    
                }
            }else {
                dashboard();
    
            }
            footerLayout();
    
    
            
        }elseif($_SESSION['roleId']==3){
            
            headerLayout();
            menuItem();
            if(isset($_GET['menu'])){
    
                if( $_GET['menu'] == "pages-add-Text.php"){
                    addTextForm(); 
                }else{
                    dashboard();
    
                }
            }else {
                dashboard();
    
            }
            footerLayout();
    
    }

    }
?>