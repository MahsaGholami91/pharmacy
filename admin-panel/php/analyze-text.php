<?php

    if (isset($_POST["submitBtn"])) {     
        $beforeAna   = $_POST['text'];
        $afterAna   = $_POST['textAnalyzed'];
        $username = $_SESSION['username'];
        require_once "../includes/db.php";
        require_once "../includes/functions.php";


        
        addText($conn, $beforeAna, $afterAna,$username);
        header("Location: ../nice-html/ltr/pages-add-text.php");
        exit();    
    }
    else {
        echo "gavi";
        header("Location: ../nice-html/ltr/pages-add-text.php");
        exit();
    }



