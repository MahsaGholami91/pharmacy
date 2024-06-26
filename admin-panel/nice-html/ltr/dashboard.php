<?php 
    include "../../layout/header.php";
    include "../../layout/menu.php" ;
    include "../../includes/db.php";

// var_dump($_SESSION);
// die;
$query = "SELECT * FROM `role` WHERE `id`= '". $_SESSION['roleId'] ."';  ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$roleName = $row['name'];
?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <p>You are in<span class="fw-bold"> Dashboard </span>as <?php  echo $roleName ?>!</p>
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
        </div>
        
<?php include "../../layout/footer.php" ?>