<?php
include "../includes/db.php";

if (isset($_POST['submitBtn'])) {
    // var_dump($_POST);
    
    $updatedDrugId      = $_POST['drugId'];
    $updatedDrugName    = $_POST['drugName'];
    $updatedDrugDose    = $_POST['drugDose'];
    $updatedDrugDesc    = $_POST['drugDesc'];
    $updatedDrugExp     = $_POST['drugExp'];
    $updatedDrugCat     = $_POST['drugCat'];
    $updatedDrugCount   = $_POST['drugCount'];
    
    $sql = "UPDATE `drugs` SET `name` = ?, `dose` = ?, `drugCount` = ?, `description` = ?, `expireDate` = ?, `drugCat` = ? WHERE id = $updatedDrugId";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "siissi", $updatedDrugName, $updatedDrugDose, $updatedDrugCount, $updatedDrugDesc, $updatedDrugExp, $updatedDrugCat);

        mysqli_stmt_execute($stmt);

        echo "success";

    } else {
echo "bad";    }
}
?>