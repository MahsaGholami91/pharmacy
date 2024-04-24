<?php

    if (isset($_POST["submitBtn"])) {     
        $drugName   = $_POST['drugName'];
        $drugDose   = $_POST['drugDose'];
        $drugCount  = $_POST['drugCount'];
        $drugDesc   = $_POST['drugDesc'];
        $drugExp    = $_POST['drugExp'];
        $drugCat    = $_POST['drugCat'];

        require_once "../includes/db.php";
        require_once "../includes/functions.php";

        if(emptyInputDrugs($drugName, $drugDose, $drugCount, $drugExp, $drugCat) !== false){
            header("location: ../nice-html/ltr/pages-add-drug.php?error=emptyinput");
            exit();
        } 
        
        addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat);
        header("Location: ../nice-html/ltr/pages-add-drug.php");
        exit();    
    }
    else {
        echo "gavi";
        header("Location: ../nice-html/ltr/pages-add-drug.php");
        exit();
    }



