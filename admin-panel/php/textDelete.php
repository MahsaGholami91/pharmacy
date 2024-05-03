<?php include "../includes/db.php";

// session_start();

    if(isset($_POST['id'])){
        $_SESSION['error-msg'] = "";
        $_SESSION['success-msg']= "";
        $id = $_POST['id'];
        $sql = "DELETE FROM `text` WHERE `id` = '$id' ";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            
            $_SESSION['error-msg'] = "*something was wrong!";
            header("location: ../nice-html/ltr/pages-add-text.php");
        }
        else {
            $_SESSION['success-msg'] = "*Text number " . $id . " deleted!";
            header("location: ../nice-html/ltr/pages-add-text.php");

}
    }









