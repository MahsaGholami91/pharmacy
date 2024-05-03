<?php
require_once "../../includes/db.php";
include "../../layout/header.php";
include "../../layout/menu.php" ;
include "../../includes/functions.php" ;

$permission = 'drug_update';
getPermission($conn,$permission);

if (!empty($_GET['id'])) {
    $drugId = $_GET['id'];
    $sql = "SELECT * FROM drugs WHERE drugs.id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $drugId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    }
}

//    session_start();

include "../includes/db.php";
require_once "../includes/functions.php";

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
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
        exit();
    } 

    if(checkIntDose($updatedDrugDose) !== false){
        $_SESSION['error-msg'] = "Dos must be number";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
        exit();
    } 
    if(checkIntCount($updatedDrugCount) !== false){
        $_SESSION['error-msg'] = "Count must be number";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
        exit();
    } 

    $sql = "UPDATE `drugs` SET `name` = ?, `dose` = ?, `drugCount` = ?, `description` = ?, `expireDate` = ?, `drugCat` = ? WHERE id = $updatedDrugId";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "siissi", $updatedDrugName, $updatedDrugDose, $updatedDrugCount, $updatedDrugDesc, $updatedDrugExp, $updatedDrugCat);

        mysqli_stmt_execute($stmt);
        $_SESSION['success-msg'] = "*Your update was successful.";
        header("location: ../nice-html/ltr/pages-drug-list.php");

    } else {
        $_SESSION['error-msg'] = "*something was wrong in your update!";
        header("location: ../nice-html/ltr/pages-update-drug.php?id=$updatedDrugId");
    }
} 

?>


        
        <div class="page-wrapper">
           
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
                                <form class="form-horizontal form-material mx-2" action="../../php/drugUpdate.php" method="post">
                                <input type="hidden" name="drugId" value="<?php echo $drugId; ?>">
                                    <div class="form-group">
                                        <label class="col-md-12">*Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugName" placeholder="Drug Name..." class="form-control form-control-line" value="<?php if(!empty($row['name'])){ echo $row['name'];}; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">*Dose</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugDose" placeholder="Drug Dose..." class="form-control form-control-line" value="<?php if(!empty($row['dose'])){ echo $row['dose'];}; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">*Count</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugCount" placeholder="Drug Count..." class="form-control form-control-line" value="<?php if(!empty($row['drugCount'])){ echo $row['drugCount'];}; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="drugDesc" class="form-control" rows="5" ><?php if(!empty($row['description'])){ echo $row['description'];}; ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>*Expire Date</label>
                                        <input name="drugExp" id="datepicker" width="276" value="<?php if(!empty($row['expireDate'])){ echo $row['expireDate'];}; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">*Select Drug Category</label>
                                        <div class="col-sm-12">
                                        <select name="drugCat" class="form-select shadow-none form-control-line">
                                        <?php 
                                            $categories = "SELECT * FROM `drug_category`";
                    
                                            $result = mysqli_query($conn,$categories);
                                            while($category = mysqli_fetch_array($result)){
                                        ?>
                                            <option <?php if(!empty($row['drugCat']) && $row['drugCat'] == $category['id']){ ?> selected="selected" <?php  } ?> value="<?php  echo $category['id'] ?>"><?php  echo $category['name']?></option>
                                        <?php } ?>
                                        </select>

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
                    </div>
                    <?php
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