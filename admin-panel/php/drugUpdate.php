<?php
// session_start();

include "../includes/db.php";
require_once "../includes/functions.php";

if (isset($_POST['submitBtn'])) {
    $_SESSION['error-msg'] = "";
    $_SESSION['success-msg']= "";
    $updatedDrugId      = $_POST['drugId'];
    $updatedDrugName    = $_POST['drugName'];
    $updatedDrugDose    = $_POST['drugDose'];
    $updatedDrugDesc    = $_POST['drugDesc'];
    $updatedDrugExp     = $_POST['drugExp'];
    $updatedDrugCat     = $_POST['drugCat'];
    $updatedDrugCount   = $_POST['drugCount'];
    

    if(emptyInputDrugs($updatedDrugName, $updatedDrugDose, $updatedDrugCount, $updatedDrugExp, $updatedDrugCat) !== false){
        $_SESSION['error-msg'] = "Fill in the fields with stars";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
        exit();
    } 

    if(checkIntDose($updatedDrugDose) !== false){
        $_SESSION['error-msg'] = "Dos must be number";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
        exit();
    } 
    if(checkIntCount($updatedDrugCount) !== false){
        $_SESSION['error-msg'] = "Count must be number";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
        exit();
    } 

    $sql = "UPDATE `drugs` SET `name` = ?, `dose` = ?, `drugCount` = ?, `description` = ?, `expireDate` = ?, `drugCat` = ? WHERE id = $updatedDrugId";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "siissi", $updatedDrugName, $updatedDrugDose, $updatedDrugCount, $updatedDrugDesc, $updatedDrugExp, $updatedDrugCat);

        mysqli_stmt_execute($stmt);
        $_SESSION['success-msg'] = "*Your update was successful.";
        header("location: ../nice-html/ltr/pages-drug-list.php");

    } else {
        $_SESSION['error-msg'] = "*something was wrong in your update!";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
    }
}
?>