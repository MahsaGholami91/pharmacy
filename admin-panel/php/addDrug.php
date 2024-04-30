<?php
    ob_start();
    session_start();
    if (isset($_POST["submitBtn"])) {    
         
        // $drugName   = htmlspecialchars(stripslashes(trim($_POST['drugName'])));
        // $drugDose   = htmlspecialchars(stripslashes(trim($_POST['drugDose'])));
        // $drugCount  = htmlspecialchars(stripslashes(trim($_POST['drugCount'])));
        // $drugDesc   = htmlspecialchars(stripslashes(trim($_POST['drugDesc'])));
        // $drugExp    = htmlspecialchars(stripslashes(trim($_POST['drugExp'])));
        // $drugCat    = htmlspecialchars(stripslashes(trim($_POST['drugCat'])));

        $drugName   = $_POST['drugName'];
        $drugDose   = $_POST['drugDose'];
        $drugCount  = $_POST['drugCount'];
        $drugDesc   = $_POST['drugDesc'];
        $drugExp    = $_POST['drugExp'];
        $drugCat    = $_POST['drugCat'];

        require_once "../includes/db.php";
        require_once "../includes/functions.php";
    
        if(emptyInputDrugs($drugName, $drugDose, $drugCount, $drugExp, $drugCat) !== false){
            $_SESSION['error-msg'] = "Fill in the fields with stars";
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        } 
        if(checkInt($drugDose) !== false){
            $_SESSION['error-msg'] = "Dose must be number";
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        } 

        if(addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat)){
            $_SESSION['success-msg'] = "Drug added";
            header("Location: ../nice-html/ltr/pages-add-drug.php");
            exit();   
        }else {
            $_SESSION['error-msg'] = "something was wrong!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
    }
    else {
        echo "gavi";
        // header("Location: ../signIn.php");
        exit();
    }





