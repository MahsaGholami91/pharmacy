<?php 
    include "../../layout/header.php";
    include "../../layout/menu.php";
    include "../../includes/functions.php" ;

    getPermission($conn, 'add_user');
    if (isset($_POST["submitBtn"])) {
 
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $role = $_POST['role'];

        require_once "../includes/db.php";
        require_once "../includes/functions.php";

        if(emptyInputSignin($fullName, $userName, $password, $repeatPassword ,$role) !== false){

            $_SESSION['error-msg'] = "Fill in the fields with stars";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        if(invalidUid($username) !== false){
            $_SESSION['error-msg'] = "username dosent valid";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        if(passwordMatch($password, $repeatPassword) !== false){
            $_SESSION['error-msg'] = "password and repeat password dosent same!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        if(uidExists($conn, $username ) !== false){
            $_SESSION['error-msg'] = "username exist!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
   
        if(createUser($conn,$fullName, $userName, $password, $role)){
            $_SESSION['success-msg'] = "user added!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();

        }else {
            $_SESSION['error-msg'] = "something was wrong!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
        
    }

?>
        <div class="page-wrapper">
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
                    <div class="col-lg-12 col-xlg-12">
                        <?php
                            if(!empty($_SESSION['error-msg'])){ ?>
                            <div class="text-danger"><?php echo $_SESSION['error-msg']; ?></div>
                            <?php     
                                $_SESSION['error-msg'] = "";
                            }else if (!empty($_SESSION['success-msg'])) { ?>
                                <div class="text-success"><?php echo $_SESSION['success-msg']; ?></div>
                             <?php $_SESSION['success-msg'] = ""; } ?>
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action="../../php/signin.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name*</label>
                                        <div class="col-md-12">
                                            <input type="text" name="fullName" placeholder="Name and Lastname..." class="form-control form-control-line" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">User Name*</label>
                                        <div class="col-md-12">
                                            <input type="text" name="userName" placeholder="Username..." class="form-control form-control-line" >
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
                                        <div class="col-sm-12">
                                            <?php 
                                                require_once "../../includes/db.php";
                                            ?>
                                        <select name="role" >
                                            <option value="" >Select Role</option>
                                            <?php 
                                                $roles = "SELECT * FROM `role`";
                                                $result = mysqli_query($conn,$roles);
                                                while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php  echo $row['id'] ?>"><?php echo $row['name']?></option>
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
                </div>
            </div>
           
            <footer class="footer text-center">
                
            </footer>
            
        </div>
        
    </div>
      
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../../dist/js/waves.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.min.js"></script>
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
</body>

</html>