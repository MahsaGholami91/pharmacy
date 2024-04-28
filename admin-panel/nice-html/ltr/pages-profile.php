<?php     

        session_start();

    
if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once "../../includes/db.php";
    $userId = $_POST['id'];
    $sql = "SELECT users.*, role.name AS role_name FROM `users` JOIN `role` ON users.roleId = role.id WHERE users.id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $fullName = $row['fullName'];
            $userName = $row['userName'];
            $password = $row['password'];
            $role = $row['role_name'];
            
        }
    }
}
    include "../../layout/header.php";
    include "../../layout/menu.php" ;
 ?>
        <div class="page-wrapper">
            
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
                    <div class="col-lg-12 col-xlg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action="../../php/signin.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="fullName" placeholder="Name and Lastname..." class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">User Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="userName" placeholder="Username..." class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12 d-flex">
                                            <input type="password" value="" class="form-control form-control-line" name="password" id="myPass">
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
                                            <input type="password" value="" class="form-control form-control-line" name="repeatPassword" id="myrePass">
                                            <span class="input-group-text" onclick="repassword_show_hide();">
                                                <i class="me-2 mdi mdi-eye" id="show_eye_repass"></i>
                                                <i class="me-2 mdi mdi-eye-off d-none" id="hide_eye_repass"></i>
                                              </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">Select Role</label>
                                        <div class="col-sm-12">
                                            <?php 
                                                require_once "../../includes/db.php";

                                                ?>
                                        <select name="role" >
                                            <option value="Select Role" selected>Select Role</option>
                                            <?php 
                                                $roles = "SELECT * FROM `role`";
                        
                                                $result = mysqli_query($conn,$roles);
                                                while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php  echo $row['id'] ?>"><?php  echo $row['name']?></option>
                                                <?php   } ?>
                                        </select>



                                         
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
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "<p>Fill in all fiels!<p>";
                            }
                            else if ($_GET["error"] == "invalidUid") {
                                echo "<p>Choose a proper username!<p>";
                            }
                            else if ($_GET["error"] == "invalidEmail") {
                                echo "<p>Choose a proper email!<p>";
                            }
                            else if ($_GET["error"] == "passworddontmatch") {
                                echo "<p>Passwors doesnt match!<p>";
                            }
                            else if ($_GET["error"] == "usernametaken") {
                                echo "<p>Username allready taken!<p>";
                            }
                            else if ($_GET["error"] == "stmtfailed") {
                                echo "<p>Something went wring, try again!<p>";
                            }
                            else if ($_GET["error"] == "none") {
                                echo "<p>You have signed in!<p>";
                            }
                        }
                    ?>
                </div>
                
            </div>
            
            <?php include "../../layout/footer.php" ?>