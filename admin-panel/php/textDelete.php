<?php include "../includes/db.php";


    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM `text` WHERE `id` = '$id' ";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            
            die("Query failed");
        }
        else {
            echo "deleted";

}
    }

?>







