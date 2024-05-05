<?php
ob_start();

session_start();

function headerLayout(){
    

    if(empty($_SESSION['username'])){
        header("location: ../login-page/login.php");
    }
    echo '<!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template">
        <meta name="description" content="Nice Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
        <meta name="robots" content="noindex,nofollow">
        <title>Nice Admin Lite Template by WrapPixel</title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin-lite/" />
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
        <link href="../dist/css/style.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
    
        <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
            data-boxed-layout="full">

            <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header" data-logobg="skin5">
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                    <i class="ti-menu ti-close"></i>
                </a>
                
                <div class="navbar-brand">
                <a href="admin-dashboard.php" class="logo">
                <b class="logo-icon">  </b>
                
                <span class="logo-text"> </span>
                </a>
                </div>
                </div>
                
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                <ul class="navbar-nav float-start me-auto">
                <li class="nav-item search-box">
                <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                <div class="d-flex align-items-center">
                <i class="mdi mdi-magnify font-20 me-1"></i>
                <div class="ms-1 d-none d-sm-block">
                <span>Search</span>
                </div>
                </div>
                </a>
                <form class="app-search position-absolute">
                <input type="text" class="form-control" placeholder="Search &amp; enter">
                <a class="srh-btn">
                <i class="ti-close"></i>
                </a>
                </form>
                </li>
                </ul>
                
                <ul class="navbar-nav float-end">
                
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                </a>
                <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="pages-profile.php"><i class="ti-user me-1 ms-1"></i> My Profile</a>
                <a class="dropdown-item" href="?logout=logout"><i class="ti-user me-1 ms-1"></i>
                Log Out</a>
                </ul>
                </li>
                    
                </ul>
            </div>
        </nav>
    </header>';    

    // var_dump("salam man injam");
    // die;
}

function footerLayout(){
    echo '<footer class="footer text-center"> </footer>
            
        </div>
    
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../dist/js/waves.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>';
    echo '<script>'."
        function openDeleteModal(id) {
            document.getElementById('deleteItemId').value = id;
            $('#deleteModal').modal('show');
        }
            $('#cancelButton').click(function() {
            $('#deleteModal').modal('hide');
        });" . '</script>
    </body>

    </html>';
}

function menuItem(){
    $conn=dbConnect();
    echo '<aside class="left-sidebar" data-sidebarbg="skin5">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?menu=" aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>';
                        $query = "SELECT * FROM `menu_item` JOIN `role_permission` on `menu_item`.`permissionId`=`role_permission`.`permissionId` WHERE `role_permission`.`roleId`= '". $_SESSION['roleId'] ."';";
                        $result = mysqli_query($conn, $query);
                        foreach($result as $row){
                    

                echo    '<li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?menu='. $row['url'].'" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>';
                        echo '<span class="hide-menu">' .  $row['name'] .' </span>
                        </a>
                    </li>';
                   
                     } 
                echo '   
                    
                </ul>
            </nav>
        </div>
    </aside>';
    // var_dump($_GET['page']);
}

function dashboard(){

    $conn=dbConnect();


    $query = "SELECT * FROM `role` WHERE `id`= '". $_SESSION['roleId'] ."';  ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $roleName = $row['name'];

    echo'<div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <p>You are in<span class="fw-bold"> Dashboard </span>as ' . $roleName .'!</p>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row"></div>
        </div>';
}

function addTextForm() {
    $conn=dbConnect();
    if (isset($_POST["submitBtn"])) {
        $beforeAna   = $_POST['text'];
        $afterAna   = $_POST['textAnalyzed'];
        $username = $_SESSION['username'];
        addText($conn, $beforeAna, $afterAna,$username);
        header("Location: ../nice-html/ltr/pages-add-text.php");
        exit();
    }
    
    getPermission($conn,'analyze_text');
    $success = "";
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text = $_POST["text"];
        $counts = countWordsAndSpaces($text);
        $str = "";
        foreach ($counts["words"] as $word => $count) {
            $str .= "$word: $count".", ";
        }
        $str .=  "Spaces: " . $counts["spaces"] ;
        $result = addText($conn, $text, $str,$_SESSION['id']);
        if($result){
            $success = "your text saved";

            $downloadLink = createResultFile($text, $counts);
            
            
        }        
    }
    
    echo'<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Confirm Delete</h5>
    
                    </div>
                    <div class="modal-body">
                    Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                    <form id="deleteForm" action="../../php/textDelete.php" method="POST">
                    <input type="hidden" name="id" id="deleteItemId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button id="cancelButton" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="page-wrapper">
                    <div class="page-breadcrumb">
                    <div class="row">
                    <div class="col-5 align-self-center">
                    <h4 class="page-title">Add Text</h4>
                    </div>
                    <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Text</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">

        <div class="row">
        
        <div class="col-lg-12 col-xlg-12">

                    <div class="card">
                        <div class="card-body">

                            <form class="form-horizontal form-material mx-2"  method="post" >
                                <div class="form-group">
                                    <label for="text">Enter your text:</label>
                                    <textarea id="text" class="form-control" name="text" rows="4" cols="50"></textarea><br>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success text-white" type="submit" value="Count Words" >
                                    </div>
                                    </div>
                                    </form>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-xlg-12">';
                // var_dump("dddllll");
                    if(!empty($_SESSION['error-msg'])){
                        echo '<div class="text-danger">' .  $_SESSION['error-msg'] . '</div>';
                        $_SESSION['error-msg'] = "";
                    }else if (!empty($_SESSION['success-msg'])) { 
                        echo '<div class="text-success">' . $_SESSION['success-msg'] . '</div>';
                        $_SESSION['success-msg'] = ""; 
                    }
                    echo '<div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Text List</h4>
                        </div>
                        <div class="table-responsive">';
                            $recordsPerPage = 5;

                            $page = isset($_GET['page']) ? $_GET['page'] : 1;

                            $offset = ($page - 1) * $recordsPerPage;

                            $sql = "SELECT * FROM `text` LIMIT $offset, $recordsPerPage";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                echo '<table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="border-top-0">Id</th>
                                    <th class="border-top-0">Text</th>
                                    <th class="border-top-0">Analyzed</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                                </thead>
                                <tbody>';

                                foreach($result as $row ){
                                    
                                    echo '<tr>
                                        <td style="vertical-align: middle;">' . $row['id'] . '</td>
                                        <td style="vertical-align: middle;">' . $row['text'] .'</td>
                                        <td style="vertical-align: middle;">' . $row['analyzed'] . '</td>
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-danger text-white" onclick="openDeleteModal(' . $row['id'] .')">Delete</button>';
                                            
                                            $downloadLink = createResultFile($row['text'], countWordsAndSpaces($row['text']));
                                            if ($downloadLink) {
                                                echo '<div class="download-link">
                                                    <a href="' . $downloadLink . '" download>Download Result File</a>
                                                </div>';
                                            }

                                        echo '</td>
                                    </tr>';
                                }
                                echo '</tbody> 
                                </table>';
                                
                            }

                        echo '</div>

                        <div class="pagination">';
                            
                            $totalCountQuery = "SELECT COUNT(*) AS total FROM `text`";
                            $totalCountResult = mysqli_query($conn, $totalCountQuery);
                            $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                            $totalCount = $totalCountRow['total'];

                            $totalPages = ceil($totalCount / $recordsPerPage);

                            if ($page > 1) {
                                echo '<a href="?menu=pages-add-Text.php&page=' . ($page - 1) . '" class="page-link">&laquo; Previous</a>';
                            }

                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<a href="?menu=pages-add-Text.php&page=' . $i . '" class="page-link">' . $i . '</a>';
                            }

                            if ($page < $totalPages) {
                                echo '<a href="menu=pages-add-Text.php&?page=' . ($page + 1) . '" class="page-link">Next &raquo;</a>';
                            }
                            
                        echo '</div>
                    </div>
                </div>
            </div>
        </div>';

    echo '</div>';
}

function countWordsAndSpaces($text) {
    $text = strtolower($text);
    $words = preg_split('/(\s+)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
    $wordCounts = array();

    $spaceCount = 0;
    foreach ($words as $word) {
        if (!empty($word)) {
            if ($word === " ") {
                $spaceCount++;
            }
            else {
                if (array_key_exists($word, $wordCounts)) {
                    $wordCounts[$word]++;
                } else {
                    $wordCounts[$word] = 1;
                }
            }
        }
    }
    return array("words" => $wordCounts, "spaces" => $spaceCount);
}

function createResultFile($text, $counts) {
    $fileContent = '';
    foreach ($counts["words"] as $word => $count) {
        $fileContent .= "$word: $count\n";
    }
    $fileContent .=  "Spaces: " . $counts["spaces"];
    $filename = md5($text) . "_result.txt"; 

    $uploadDirectory = "/pharmacy/admin-panel/uploads/";
    $finalPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory . $filename;
    $file = fopen($finalPath, "w");

    if ($file) {
        fwrite($file, $fileContent);
        fclose($file);
        return $finalPath;

    } else {
        return false;
    }
}

function addDrugForm() {
    $conn=dbConnect();
   
    getPermission($conn,'add_drug');

    if (isset($_POST["submitBtn"])) {
        $drugName   = $_POST['drugName'];
        $drugDose   = $_POST['drugDose'];
        $drugCount  = $_POST['drugCount'];
        $drugDesc   = $_POST['drugDesc'];
        $drugExp    = $_POST['drugExp'];
        $drugCat    = $_POST['drugCat'];

        if(emptyInputDrugs($drugName, $drugDose, $drugCount, $drugExp, $drugCat) !== false){
            $_SESSION['error-msg'] = "Fill in the fields with stars";
            // header("location: ../nice-html/ltr/pages-add-drug.php");
            // exit();
        }
        if(checkIntDose($drugDose) !== false){
            $_SESSION['error-msg'] = "Dose must be a number";
            // header("location: ../nice-html/ltr/pages-add-drug.php");
            // exit();
        }
        if(checkIntCount($drugCount) !== false){
            $_SESSION['error-msg'] = "Count must be a number";
            // header("location: ../nice-html/ltr/pages-add-drug.php");
            // exit();
        }

        if(addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat)){
            $_SESSION['success-msg'] = "Drug added";
            // header("Location: ../nice-html/ltr/pages-add-drug.php");
            // exit();
        } else {
            $_SESSION['error-msg'] = "Something went wrong!";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();
        }
    }

    echo '<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Add Drug</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Drug</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12">';
                    if(!empty($_SESSION['error-msg'])){
                    echo'<div class="text-danger">' . $_SESSION['error-msg'].'</div>';
                        $_SESSION['error-msg'] = "";
                    } else if (!empty($_SESSION['success-msg'])) { 
                    echo '<div class="text-success">'. $_SESSION['success-msg'].'</div>';
                        $_SESSION['success-msg'] = "";
                    } 
                    echo '<div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2"  action="" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Name*</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugName" placeholder="Drug Name..." class="form-control form-control-line" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Dose*</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugDose" placeholder="Drug Dose..." class="form-control form-control-line" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Count*</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugCount" placeholder="Drug Count..." class="form-control form-control-line" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="drugDesc" class="form-control" rows="5"  value=""></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Expire Date*</label>
                                        <input name="drugExp" id="datepicker" width="276" value=""/>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">Select Drug Category</label>
                                        <div class="col-sm-12">';
                                            echo '<select name="drugCat" class="form-select shadow-none form-control-line">
                                                    <option value="" >Select Category</option>';
                                                    $categories = "SELECT * FROM `drug_category`";

                                                    $result = mysqli_query($conn,$categories);
                                                    while($row = mysqli_fetch_array($result)){
                                                        
                                                    echo '<option value="'. $row['id'].' ">' . $row['name']. '</option>';
                                                    } 
                                                echo '</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button name="submitBtn" class="btn btn-success text-white">Add Drug</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         
    ';
    echo '<script>'."
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap5'
        });"
   .' </script>';
  
}

function addUserForm() {
    $conn=dbConnect();
  
    getPermission($conn, 'add_user');
    if (isset($_POST["submitBtn"]) && !empty($_POST["submitBtn"])) {
//         var_dump($_POST["submitBtn"]);
// die("dddddd");
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $role = $_POST['role'];


        if(emptyInputSignin($fullName, $userName, $password, $repeatPassword ,$role) !== false){

            $_SESSION['error-msg'] = "Fill in the fields with stars";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();
        }elseif(invalidUid($userName) !== false){
            $_SESSION['error-msg'] = "username dosent valid";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();
        }elseif(passwordMatch($password, $repeatPassword) !== false){
            $_SESSION['error-msg'] = "password and repeat password dosent same!";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();
        }elseif(uidExists($conn, $userName ) !== false){
            $_SESSION['error-msg'] = "username exist!";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();
        }elseif(createUser($conn,$fullName, $userName, $password, $role)){
            $_SESSION['success-msg'] = "user added!";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();

        }else {
            $_SESSION['error-msg'] = "something was wrong!";
            // header("location: ../nice-html/ltr/pages-add-user.php");
            // exit();
        }

    }

   echo '<div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Add User</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12">';
                    if(!empty($_SESSION['error-msg'])){ 
                    echo '<div class="text-danger">' .$_SESSION['error-msg'].'</div>';
                        $_SESSION['error-msg'] = "";
                    }else if (!empty($_SESSION['success-msg'])) { 
                    echo '<div class="text-success">'. $_SESSION['success-msg'].'</div>';
                    $_SESSION['success-msg'] = ""; } 
                    echo '<div class="card">
                        <div class="card-body">
                            <form class="form-horizontal form-material mx-2" action="" method="post">
                                <div class="form-group">
                                    <label class="col-md-12">Full Name*</label>
                                    <div class="col-md-12">
                                        <input type="text" name="fullName" placeholder="Name and Lastname..." class="form-control form-control-line" value="';
                                        if(!empty($_POST['fullName'])){
                                            echo $_POST['fullName'];
                                        }
                                        echo '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">User Name*</label>
                                    <div class="col-md-12">
                                        <input type="text" name="userName" placeholder="Username..." class="form-control form-control-line" value="';
                                        if(!empty($_POST['userName'])){
                                            echo $_POST['userName'];
                                        }
                                        echo '">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Password*</label>
                                    <div class="col-md-12 d-flex">
                                        <input type="password" class="form-control form-control-line" name="password" id="myPass" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_show_hide();">
                                              <i class="me-2 mdi mdi-eye" id="show_eye_pass"></i>
                                              <i class="me-2 mdi mdi-eye-off d-none" id="hide_eye_pass"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Repeat Password*</label>
                                    <div class="col-md-12  d-flex">
                                        <input type="password" class="form-control form-control-line" name="repeatPassword" id="myrePass" >
                                        <span class="input-group-text" onclick="repassword_show_hide();">
                                            <i class="me-2 mdi mdi-eye" id="show_eye_repass"></i>
                                            <i class="me-2 mdi mdi-eye-off d-none" id="hide_eye_repass"></i>
                                          </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Select Role*</label>
                                    <div class="col-sm-12">';
                                     
                                    echo '<select name="role" >
                                        <option value="" >Select Role</option>';
                                            $roles = "SELECT * FROM `role`";
                                            $result = mysqli_query($conn,$roles);
                                            while($row = mysqli_fetch_array($result)){
                                    echo '<option value="'. $row['id'].'">'. $row['name'].'</option>';
                                             } 
                                    echo '</select>
                                     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button name="submitBtn" class="btn btn-success text-white" value="submit">Add User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  
    ';
    echo '<script>'.'
        function password_show_hide() {
            var x = document.getElementById("myPass");
            var show_eye_pass = document.getElementById("show_eye_pass");
            var hide_eye_pass = document.getElementById("hide_eye_pass");
            hide_eye_pass.classList.remove("d-none");
            if (x.type === "myPass") {
                x.type = "text";
                show_eye_pass.style.display = "none";
                hide_eye_pass.style.display = "block";
            } else {
                x.type = "myPass";
                show_eye_pass.style.display = "block";
                hide_eye_pass.style.display = "none";
            }
        }
        function repassword_show_hide() {
            var x = document.getElementById("myrePass");
            var show_eye_repass = document.getElementById("show_eye_repass");
            var hide_eye_repass = document.getElementById("hide_eye_repass");
            hide_eye_repass.classList.remove("d-none");
            if (x.type === "myrePass") {
                x.type = "text";
                show_eye_repass.style.display = "none";
                hide_eye_repass.style.display = "block";
            } else {
                x.type = "myrePass";
                show_eye_repass.style.display = "block";
                hide_eye_repass.style.display = "none";
            }
        }
   ' .'</script>
  ';
}

function drugListForm(){
  
    $conn=dbConnect();

    getPermission($conn,'drug_list');
   

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
    echo '<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirm Delete</h5>
        
        </div>
        <div class="modal-body">
            Are you sure you want to delete this item?
        </div>
        <div class="modal-footer">
            <form id="deleteForm" action="../../php/drugDelete.php" method="POST">
            <input type="hidden" name="id" id="deleteItemId">
            <button type="submit" class="btn btn-danger">Delete</button>
            <button id="cancelButton" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </form>
        </div>
        </div>
    </div>
    </div>


    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Drug List</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Drug List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            
            <div class="row">
                
                <div class="col-lg-12 col-xlg-12">';
                        if(!empty($_SESSION['error-msg'])){ 
                    echo '<div class="text-danger">'. $_SESSION['error-msg'].'</div>';
                         
                            $_SESSION['error-msg'] = "";
                        }else if (!empty($_SESSION['success-msg'])) { 
                        echo '<div class="text-success">'. $_SESSION['success-msg'].'</div>';
                          $_SESSION['success-msg'] = ""; } 
               echo   '<div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Drugs List</h4>
                        </div>
                        <div class="table-responsive">';
                                $recordsPerPage = 5;

                                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                                $offset = ($page - 1) * $recordsPerPage;

                                $sql = "SELECT * FROM drugs LIMIT $offset, $recordsPerPage";
                                $result = mysqli_query($conn, $sql);

                                if (!$result) {
                                    die("Query failed");
                                }

                           echo '
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Id</th>
                                        <th class="border-top-0">Name</th>
                                        <th class="border-top-0">Dose</th>
                                        <th class="border-top-0">Count</th>
                                        <th class="border-top-0">Expire Date</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    
                                        foreach($result as $row ){
                                echo '<tr>
                                            <td>'. $row['id'].'</td>
                                            <td>'. $row['name'].'</td>
                                            <td>'. $row['dose'].'</td>
                                            <td>'. $row['drugCount'].'</td>
                                            <td>'. $row['expireDate'].'</td>
                                            <td style="display: flex;gap: 10px;">
                                            <a href="?menu=pages-update-drug.php&id='.$row['id'].'">
                                                    <button type="submit" class="btn btn-success text-white">Update</button>
                                                    </a>
                                                <button type="button" class="btn btn-danger text-white" onclick="openDeleteModal('.$row['id'].')">Delete</button>
                                               
                                            </td>
                                            
                                        </tr>';
                                        }
                                     
                            echo' </tbody>
                              
                            </table>
                        </div>
                        <div class="pagination">';
                            $totalCountQuery = "SELECT COUNT(*) AS total FROM drugs";
                            $totalCountResult = mysqli_query($conn, $totalCountQuery);
                            $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                            $totalCount = $totalCountRow['total'];

                            $totalPages = ceil($totalCount / $recordsPerPage);

                            if ($page > 1) {
                                echo '<a href="?page=' . ($page - 1) . '" class="page-link">&laquo; Previous</a>';
                            }

                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<a href="?page=' . $i . '" class="page-link">' . $i . '</a>';
                            }

                            if ($page < $totalPages) {
                                echo '<a href="?page=' . ($page + 1) . '" class="page-link">Next &raquo;</a>';
                            }
                    echo '</div>
                    </div>
                </div>
            </div>
        </div>';
}

function updateUserForm(){

    $conn=dbConnect();
    if (isset($_POST['submitBtn'])) {
        
        $updatedUserId      = $_POST['userId'];
        $updatedFullname    = $_POST['fullName'];
        $updatedUserName    = $_POST['userName'];
        $updatedUserPass    = $_POST['password'];
        $updatedUserRepass    = $_POST['repeatPassword'];
        $updatedUserRole    = $_POST['role'];
        $hashedPwd = password_hash($updatedUserPass, PASSWORD_DEFAULT);
        
        if(emptyInputSignin($updatedFullname, $updatedUserName, $updatedUserPass, $updatedUserRepass ,$updatedUserRole) !== false){
            $_SESSION['error-msg'] = "Fill in the fields with stars";
    
            header("location: ../nice-html/ltr/pages-profile.php");
            exit();
        }
        if(invalidUid($updatedUserName) !== false){
            $_SESSION['error-msg'] = "username dosent valid";
    
            header("location: ../nice-html/ltr/pages-profile.php");
            exit();
        }
        if(passwordMatch($updatedUserPass, $updatedUserRepass) !== false){
            $_SESSION['error-msg'] = "password and repeat password dosent same!";
    
            header("location: ../nice-html/ltr/pages-profile.php");
            exit();
        }
        if(uidExists($conn, $updatedUserName ) !== false){
            $_SESSION['error-msg'] = "username exist!";
    
            header("location: ../nice-html/ltr/pages-profile.php");
            exit();
        }
        $sql = "UPDATE `users` SET `fullname` = ?, `username` = ?, `password` = ?, `roleId` = ? WHERE id = $updatedUserId";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $updatedFullname, $updatedUserName, $hashedPwd, $updatedUserRole);
    
            mysqli_stmt_execute($stmt);
    
            $_SESSION['success-msg'] = "user information changed!";
            header("location: ../nice-html/ltr/pages-profile.php");
            exit();
    
        } else {
            $_SESSION['error-msg'] = "something was wrong!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();}
    }
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        $roleId = $_SESSION['roleId'];
        $sql = "SELECT * FROM `users` WHERE users.id = ? ";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            
        }
    }
    echo '<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xlg-12">';
                            if(!empty($_SESSION['error-msg'])){ 
                        echo '<div class="text-danger">'. $_SESSION['error-msg'].'</div>';
                                $_SESSION['error-msg'] = "";
                            }else if (!empty($_SESSION['success-msg'])) { 
                            echo '<div class="text-success">'. $_SESSION['success-msg'].'</div>';
                              $_SESSION['success-msg'] = ""; } 
                    echo    '<div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action="../../php/userUpdate.php" method="post">
                                <input type="hidden" name="userId" value="'. $userId.'">';

                                echo   '<div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="fullName" placeholder="Name and Lastname..." class="form-control form-control-line" value="';
                                             if(!empty($row['fullname'])){ 
                                                $row['fullname'];
                                            }; 
                                            '">';
                                    echo '</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">User Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="userName" placeholder="Username..." class="form-control form-control-line" value="';
                                            if(!empty($row['username'])){ 
                                                 $row['username'];
                                            }; '">';
                                     echo '</div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12 d-flex">
                                            <input type="password" value="" class="form-control form-control-line" name="password" id="myPass" >
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="password_show_hide();">
                                                  <i class="me-2 mdi mdi-eye" id="show_eye_pass"></i>
                                                  <i class="me-2 mdi mdi-eye-off d-none" id="hide_eye_pass"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Repeat Password</label>
                                        <div class="col-md-12  d-flex">
                                            <input type="password" value="" class="form-control form-control-line" name="repeatPassword" id="myrePass" >
                                            <span class="input-group-text" onclick="repassword_show_hide();">
                                                <i class="me-2 mdi mdi-eye" id="show_eye_repass"></i>
                                                <i class="me-2 mdi mdi-eye-off d-none" id="hide_eye_repass"></i>
                                              </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">Select Role</label>
                                        <div class="col-sm-12">
              
                                        <select name="role" class="form-select shadow-none form-control-line">';
                                                $roles = "SELECT * FROM `role`";
                                                $result = mysqli_query($conn,$roles);
                                                while($role = mysqli_fetch_array($result)){
                                            

                                        echo '<option' ;
                                        if(!empty($row['roleId']) && $row['roleId'] == $role['id']){ 
                                            echo 'selected="selected" ';
                                          } 
                                        echo 'value="'. $role['id'] .'">'. $role['name'].'</option>';
                                              } 
                                    echo  '</select>
                                         
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button name="submitBtn" class="btn btn-success text-white">Add User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>

          

        <script>
            function password_show_hide() {
                var x = document.getElementById("myPass");
                var show_eye_pass = document.getElementById("show_eye_pass");
                var hide_eye_pass = document.getElementById("hide_eye_pass");
                hide_eye_pass.classList.remove("d-none");
                if (x.type === "myPass") {
                    x.type = "text";
                    show_eye_pass.style.display = "none";
                    hide_eye_pass.style.display = "block";
                } else {
                    x.type = "myPass";
                    show_eye_pass.style.display = "block";
                    hide_eye_pass.style.display = "none";
                }
            }
            function repassword_show_hide() {
                var x = document.getElementById("myrePass");
                var show_eye_repass = document.getElementById("show_eye_repass");
                var hide_eye_repass = document.getElementById("hide_eye_repass");
                hide_eye_repass.classList.remove("d-none");
                if (x.type === "myrePass") {
                    x.type = "text";
                    show_eye_repass.style.display = "none";
                    hide_eye_repass.style.display = "block";
                } else {
                    x.type = "myrePass";
                    show_eye_repass.style.display = "block";
                    hide_eye_repass.style.display = "none";
                }
            }
        </script>
    ';
}

function updateDrugForm(){
    $conn=dbConnect();
  
    getPermission($conn,'drug_update');

    if (!empty($_GET['id'])) {
        $drugId = $_GET['id'];
        $sql = "SELECT * FROM drugs WHERE drugs.id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $drugId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            // var_dump($row);
        }
    }


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
            // header("location: ../nice-html/ltr/?menu=pages-update-drug.php&id=$updatedDrugId");
            // exit();
        } 

        if(checkIntDose($updatedDrugDose) !== false){
            $_SESSION['error-msg'] = "Dos must be number";
            // header("location: ../nice-html/ltr/?menu=pages-update-drug.php&id=$updatedDrugId");
            // exit();
        } 
        if(checkIntCount($updatedDrugCount) !== false){
            $_SESSION['error-msg'] = "Count must be number";
            // header("location: ../nice-html/ltr/?menu=pages-update-drug.php&id=$updatedDrugId");
            // exit();
        } 

        $sql = "UPDATE `drugs` SET `name` = ?, `dose` = ?, `drugCount` = ?, `description` = ?, `expireDate` = ?, `drugCat` = ? WHERE id = $updatedDrugId";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "siissi", $updatedDrugName, $updatedDrugDose, $updatedDrugCount, $updatedDrugDesc, $updatedDrugExp, $updatedDrugCat);

            mysqli_stmt_execute($stmt);
            $_SESSION['success-msg'] = "*Your update was successful.";
            header("location: ?menu=pages-drug-list.php");

        } else {
            $_SESSION['error-msg'] = "*something was wrong in your update!";
            // header("location: ../nice-html/ltr/?menu=pages-update-drug.php&id=$updatedDrugId");
        }
    } 
        
    echo '<div class="page-wrapper">
           
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Update Drug</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Drug</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xlg-12">';
                            if(!empty($_SESSION['error-msg'])){
                        echo '<div class="text-danger">'. $_SESSION['error-msg'].'</div>';
                                $_SESSION['error-msg'] = "";
                            }else if (!empty($_SESSION['success-msg'])) { 
                        echo '<div class="text-success">'. $_SESSION['success-msg'].'</div>';
                            $_SESSION['success-msg'] = ""; } 
                    echo  '<div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action="" method="post">
                                <input type="hidden" name="drugId" value="'. $drugId .'">';
                                echo '<div class="form-group">
                                        <label class="col-md-12">*Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugName" placeholder="Drug Name..." class="form-control form-control-line" value="';
                                            if(!empty($row['name'])){ 
                                              echo  $row['name'];
                                            }
                                                echo '">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">*Dose</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugDose" placeholder="Drug Dose..." class="form-control form-control-line" value="';
                                            if(!empty($row['dose'])){ 
                                                echo   $row['dose'];
                                                }
                                                echo'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">*Count</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugCount" placeholder="Drug Count..." class="form-control form-control-line" value="';
                                            if(!empty($row['drugCount'])){  
                                                echo $row['drugCount'];
                                                }
                                                echo'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="drugDesc" class="form-control" rows="5" >';
                                         if(!empty($row['description'])){  
                                            echo  $row['description'];
                                        }
                                        echo'</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>*Expire Date</label>
                                        <input name="drugExp" id="datepicker" width="276" value="';
                                        if(!empty($row['expireDate'])){
                                            echo  $row['expireDate'];
                                        }
                                        echo    '"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">*Select Drug Category</label>
                                        <div class="col-sm-12">
                                        <select name="drugCat" class="form-select shadow-none form-control-line">';
                                            $categories = "SELECT * FROM `drug_category`";
                                            $result = mysqli_query($conn,$categories);
                                            while($category = mysqli_fetch_array($result)){
                                        
                                        echo '<option ';
                                        if(!empty($row['drugCat']) && $row['drugCat'] == $category['id']){ 
                                            echo' selected="selected"';
                                          } 
                                          echo'value="' . $category['id'] .'">' .  $category['name'] . '</option>';
                                         } 
                                         echo '</select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button name="submitBtn" class="btn btn-success text-white">Update Drug</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>';
                    
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "<p>Fill in all fiels!<p>";
                            }                        
                            
                            else if ($_GET["error"] == "stmtfailed") {
                                echo "<p>Something went wring, try again!<p>";
                            }
                            else if ($_GET["error"] == "none") {
                                echo "<p>Your data inserted!<p>";
                            }
                        }
                    
            echo    '</div>
            </div>'
    ;
    
    echo '<script>'."
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5'
    });"
    .' </script>';
    
}



function checkIntDose($drugDose){
    // die($drugDose);
    if (!isset($drugDose) || !ctype_digit($drugDose)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}
function checkIntCount($drugCount){
    if (!isset($drugCount) || !ctype_digit($drugCount)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}
function emptyInputSignin($fullName, $userName, $password, $passwordRepeat ,$role) {
    $result = true;
    if(empty($fullName) || empty($userName) || empty($password) || empty($passwordRepeat) || empty($role)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
 
function emptyInputDrugs($drugName, $drugDose, $drugCount, $drugExp, $drugCat) {
    $result=true;
    if(empty($drugName) || empty($drugDose) || empty($drugCount) || empty($drugExp) || empty($drugCat)){
        $result = true;
    }
    else {
        $result = false;
    }
 
    return $result;
}

function invalidUid($userName) {
    $result=true;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){
        $result = true;
    }
    else {
        $result =false;
    }
    return $result;
}

function passwordMatch($password, $passwordRepeat) {
    $result =true;
    if($password !== $passwordRepeat){
        $result = true;
    }
    else {
        $result =false;
    }
    return $result;
}

function uidExists($conn, $userName) {
    $sql = "SELECT * FROM users WHERE username = ? ;";
    $stmt = mysqli_stmt_init($conn);
   
    if(!mysqli_stmt_prepare($stmt,$sql) ){
        return false;
    }
    mysqli_stmt_bind_param($stmt,"s",$userName);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result =false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $fullName, $userName, $password, $role) {
    $sql = "INSERT INTO `users` (`fullname`, `username`, `password`, `roleId`) VALUES (? , ? ,? ,?);";
    $stmt = mysqli_stmt_init($conn);
  
    if(!mysqli_stmt_prepare($stmt,$sql) ){
        return false;
    }
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
     mysqli_stmt_bind_param($stmt,"sssi",$fullName, $userName, $hashedPwd, $role);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     return true;
}

function addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat) {
    $sql = "SELECT * FROM `drugs` WHERE `name` = ? AND `dose` = ? AND `expireDate` = ? AND `drugCat` = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "siss", $drugName, $drugDose, $drugExp, $drugCat);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rowCount = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    if ($rowCount > 0) {
        $sql = "UPDATE `drugs` SET `drugCount` = `drugCount` + ? WHERE `name` = ? AND `dose` = ? AND `expireDate` = ? AND `drugCat` = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "isiss", $drugCount, $drugName, $drugDose, $drugExp, $drugCat);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true; 
    } else {
        $sql = "INSERT INTO drugs (`name`, `dose`, `expireDate`, `drugCat`, `drugCount`, `description`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, "sisiis", $drugName, $drugDose, $drugExp, $drugCat, $drugCount, $drugDesc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true; 
    }
}

function addText($conn, $beforeAna, $afterAna,$userId) {
    $sql = "INSERT INTO `text` (`text`, `analyzed`, `userId`) VALUES (? , ? ,?);";
    $stmt = mysqli_stmt_init($conn);
   
    if(!mysqli_stmt_prepare($stmt,$sql) ){
        return false;
    }
     mysqli_stmt_bind_param($stmt,"ssi",$beforeAna, $afterAna,$userId);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
    return true;
}

function getPermission($conn, $permission) {
    if (isset($_SESSION['roleId']) && !empty($_SESSION['roleId'])) {
        $query = "SELECT `permission` FROM `permission` JOIN `role_permission` on `permission`.`id`=`role_permission`.`permissionId` WHERE `role_permission`.`roleId`= '" . $_SESSION['roleId'] . "';";
        $status = false;
        $result = mysqli_query($conn, $query);

        $allPermissions = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $allPermissions[] = $row['permission'];
        }
        

        if (!in_array($permission, $allPermissions)) {
            header("location: dashboard.php");
            exit;
        }
    } else {
        header("location: ../../../login-page/login.php");
        exit;
    }
}

function dbConnect(){
    $serverName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "pharmacy";
    // Create connection
    $conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}




