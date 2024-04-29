
<?php 
    include "../../layout/header.php";
    include "../../layout/menu.php" ;
    include "../../includes/functions.php" ;


    $permission = 'add_drug';
    getPermission($conn,$permission);
        

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
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2"  action="../../php/addDrug.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugName" placeholder="Drug Name..." class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Dose</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugDose" placeholder="Drug Dose..." class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Count</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugCount" placeholder="Drug Count..." class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="drugDesc" class="form-control" rows="5"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Expire Date</label>
                                        <input name="drugExp" id="datepicker" width="276" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-12">Select Drug Category</label>
                                        <div class="col-sm-12">
                                        <?php 
                                            require_once "../../includes/db.php";
                                        ?>
                                            <select name="drugCat" class="form-select shadow-none form-control-line">
                                                <option value="Select Drug Category" selected>Select Category</option>
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
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "<p>Fill in all fiels!<p>";
                            }                        
                            
                            else if ($_GET["error"] == "drugtaken") {
                                echo "<p>Username allready taken!<p>";
                            }
                            else if ($_GET["error"] == "stmtfailed") {
                                echo "<p>Something went wring, try again!<p>";
                            }
                            else if ($_GET["error"] == "none") {
                                echo "<p>Your data inserted!<p>";
                            }
                        }
                    ?>
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
// include "../../layout/header.php";
// include "../../layout/menu.php";
// include "../../includes/functions.php";

// $permission = 'add_drug';
// getPermission($conn, $permission);

// Initialize variables to store error messages
// $errors = array();

// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Drug Name
    // if (empty($_POST["drugName"])) {
    //     $errors["drugName"] = "Drug name is required";
    // }

    // Validate Drug Dose
    // if (empty($_POST["drugDose"]) || !is_numeric($_POST["drugDose"])) {
    //     $errors["drugDose"] = "Drug dose must be a valid number";
    // }

    // Validate Drug Count
    // if (empty($_POST["drugCount"]) || !is_numeric($_POST["drugCount"])) {
    //     $errors["drugCount"] = "Drug count must be a valid number";
    // }

    // Validate Drug Category
    // if ($_POST["drugCat"] == "Select Drug Category") {
    //     $errors["drugCat"] = "Please select a drug category";
    // }

    // Check if there are no errors
    // if (empty($errors)) {
        // Process form data and insert into database
        // Your code to handle form submission goes here
        // Redirect to success page or perform any other action
//         header("Location: ../../php/addDrug.php");
//         exit();
//     }
// }
?>
<!-- 
<div class="page-wrapper">
    <form class="form-horizontal form-material mx-2" action="" method="post">
        <div class="form-group">
            <label class="col-md-12">Name</label>
            <div class="col-md-12">
                <input type="text" name="drugName" placeholder="Drug Name..." class="form-control form-control-line"> -->
                <?php //if (isset($errors["drugName"])) echo "<p class='text-danger'>" . $errors["drugName"] . "</p>"; ?>
            <!-- </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Dose</label>
            <div class="col-md-12">
                <input type="text" name="drugDose" placeholder="Drug Dose..." class="form-control form-control-line"> -->
                <?php //if (isset($errors["drugDose"])) echo "<p class='text-danger'>" . $errors["drugDose"] . "</p>"; ?>
            <!-- </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Count</label>
            <div class="col-md-12">
                <input type="text" name="drugCount" placeholder="Drug Count..." class="form-control form-control-line"> -->
                <?php// if (isset($errors["drugCount"])) echo "<p class='text-danger'>" . $errors["drugCount"] . "</p>"; ?>
            <!-- </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="drugDesc" class="form-control" rows="5"></textarea>
        </div>
        
        <div class="form-group">
            <label>Expire Date</label>
            <input name="drugExp" id="datepicker" width="276" />
        </div>
        
        <div class="form-group">
            <label class="col-sm-12">Select Drug Category</label>
            <div class="col-sm-12"> -->
                <?php //require_once "../../includes/db.php"; ?>
                <!-- <select name="drugCat" class="form-select shadow-none form-control-line">
                    <option value="Select Drug Category" selected>Select Category</option> -->
                    <?php 
                        // $categories = "SELECT * FROM `drug_category`";
                        // $result = mysqli_query($conn,$categories);
                        // while($row = mysqli_fetch_array($result)){
                    ?>
                    <!-- <option value="<?php// echo $row['id']; ?>"><?php //echo $row['name']; ?></option> -->
                    <?php //} ?>
                <!-- </select> -->
                <?php //if (isset($errors["drugCat"])) echo "<p class='text-danger'>" . $errors["drugCat"] . "</p>"; ?>
            <!-- </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button name="submitBtn" class="btn btn-success text-white">Add Drug</button>
            </div>
        </div>
    </form>
</div> -->

<?php
    // include "../../layout/footer.php";
?>

