<?php
include "../../layout/header.php";
include "../../layout/menu.php";
include "../../includes/functions.php";
require_once "../../includes/db.php";

function addTextForm() {

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
                    if(!empty($_SESSION['error-msg'])){
                        echo '<div class="text-danger">' .  $_SESSION['error-msg'] . '</div>';
                        $_SESSION['error-msg'] = "";
                    }else if (!empty($_SESSION['success-msg'])) { 
                        echo '<div class="text-success">' . $_SESSION['success-msg'] . '</div>';
                        $_SESSION['success-msg'] = ""; 
                    }
                    echo '<div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Drugs List</h4>
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
                                        <td style="vertical-align: middle;">' . $row['text'] '</td>
                                        <td style="vertical-align: middle;">' . row['analyzed'] . '</td>
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

        // include "../../layout/footer.php";
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
    include "../../layout/header.php";
    include "../../layout/menu.php";
    include "../../includes/functions.php";
    require_once "../../includes/db.php";

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
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        }
        if(checkIntDose($drugDose) !== false){
            $_SESSION['error-msg'] = "Dose must be a number";
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        }
        if(checkIntCount($drugCount) !== false){
            $_SESSION['error-msg'] = "Count must be a number";
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        }

        if(addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat)){
            $_SESSION['success-msg'] = "Drug added";
            header("Location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        } else {
            $_SESSION['error-msg'] = "Something went wrong!";
            header("location: ../nice-html/ltr/pages-add-user.php");
            exit();
        }
    }

    ?>

    <div class="page-wrapper">
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
                <div class="col-lg-12 col-xlg-12">
                    <?php
                    if(!empty($_SESSION['error-msg'])){ ?>
                        <div class="text-danger"><?php echo $_SESSION['error-msg']; ?></div>
                    <?php
                        $_SESSION['error-msg'] = "";
                    } else if (!empty($_SESSION['success-msg'])) { ?>
                        <div class="text-success"><?php echo $_SESSION['success-msg']; ?></div>
                    <?php
                        $_SESSION['success-msg'] = "";
                    } ?>
                    <div class="card">
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
                                    <div class="col-sm-12">
                                        <?php
                                        require_once "../../includes/db.php";
                                        ?>
                                        <select name="drugCat" class="form-select shadow-none form-control-line">
                                            <option value="" >Select Category</option>
                                            <?php
                                            $categories = "SELECT * FROM `drug_category`";

                                            $result = mysqli_query($conn,$categories);
                                            while($row = mysqli_fetch_array($result)){
                                                ?>
                                                <option value="<?php  echo $row['id'] ?>"><?php  echo $row['name']?></option>
                                            <?php } ?>
                                        </select>
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
        <footer class="footer text-center">

        </footer>
    </div>

    </div>

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap5'
        });
    </script>
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../../dist/js/waves.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.min.js"></script>
    </body>

    </html>
<?php
}




function addUserForm() {
    include "../../layout/header.php";
    include "../../layout/menu.php";
    include "../../includes/functions.php";

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
                            <form class="form-horizontal form-material mx-2" action="" method="post">
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
<?php
}



?>

