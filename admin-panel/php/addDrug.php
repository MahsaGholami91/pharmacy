<?php

    if (isset($_POST["submitBtn"])) {    
         
        $drugName   = htmlspecialchars(stripslashes(trim($_POST['drugName'])));
        $drugDose    = htmlspecialchars(stripslashes(trim($_POST['drugDose'])));
        $drugCount   = htmlspecialchars(stripslashes(trim($_POST['drugCount'])));
        $drugDesc    = htmlspecialchars(stripslashes(trim($_POST['drugDesc'])));
        $drugExp     = htmlspecialchars(stripslashes(trim($_POST['drugExp'])));
        $drugCat     = htmlspecialchars(stripslashes(trim($_POST['drugCat'])));

        // $drugDose   = test_input($_POST['drugDose']);
        // $drugCount  = test_input($_POST['drugCount']);
        // $drugDesc   = test_input($_POST['drugDesc']);
        // $drugExp    = test_input($_POST['drugExp']);
        // $drugCat    = test_input($_POST['drugCat']);

        require_once "../includes/db.php";
        require_once "../includes/functions.php";

        if(emptyInputDrugs($drugName, $drugDose, $drugCount, $drugExp, $drugCat) !== false){
            header("location: ../nice-html/ltr/pages-add-drug.php?error=emptyinput");
            exit();
        } 
        if(checkInt($drugDose) !== false){
            header("location: ../nice-html/ltr/pages-add-drug.php?error=checkInt");
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



