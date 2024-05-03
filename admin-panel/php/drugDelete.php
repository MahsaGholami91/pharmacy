<?php include "../includes/db.php";
// session_start();


    if(isset($_POST['id'])){
        $_SESSION['error-msg'] = "";
        $_SESSION['success-msg']= "";
        $id = $_POST['id'];
        $sql = "DELETE FROM `drugs` WHERE `id` = '$id' ";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            
            $_SESSION['error-msg'] = "*something was wrong!";
            header("location: ../nice-html/ltr/pages-drug-list.php");
        }
        else {
            $_SESSION['success-msg'] = "*Drug number " . $id . " deleted!";
            header("location: ../nice-html/ltr/pages-drug-list.php");

}
    }

?>







