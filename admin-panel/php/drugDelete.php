<?php include "../includes/db.php";
// var_dump($_POST['id']);
// die;

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM `drugs` WHERE `id` = '$id' ";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            
            die("Query failed");
        }
        else {
            echo "deleted";

}
    }

?>







