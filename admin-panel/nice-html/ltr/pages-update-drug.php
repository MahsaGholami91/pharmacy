<?php

if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once "../../includes/db.php";
    $drugId = $_POST['id'];
    $sql = "SELECT drugs.*, drug_category.name AS category_name FROM drugs JOIN drug_category ON drugs.drugCat = drug_category.id WHERE drugs.id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $drugId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $drugName   = $row['name'];
            $drugDose   = $row['dose'];
            $drugCount  = $row['drugCount'];
            $drugDesc   = $row['description'];
            $drugExp    = $row['expireDate'];
            $drugCat    = $row['category_name'];
        }
    }
}


include "../../layout/header.php";
include "../../layout/aside.php" ;
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
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action="../../php/drugUpdate.php" method="post">
                                <input type="hidden" name="drugId" value="<?php echo $drugId; ?>">
                                    <div class="form-group">
                                        <label class="col-md-12">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugName" placeholder="Drug Name..." class="form-control form-control-line" value="<?php echo $drugName; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Dose</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugDose" placeholder="Drug Dose..." class="form-control form-control-line" value="<?php echo $drugDose; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Count</label>
                                        <div class="col-md-12">
                                            <input type="text" name="drugCount" placeholder="Drug Count..." class="form-control form-control-line" value="<?php echo $drugCount; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="drugDesc" class="form-control" rows="5" value="<?php echo $drugDesc; ?>"><?php echo $drugDesc; ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Expire Date</label>
                                        <input name="drugExp" id="datepicker" width="276" value="<?php echo $drugExp; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">Select Drug Category</label>
                                        <div class="col-sm-12">
                                        <select name="drugCat" class="form-select shadow-none form-control-line">
                                        <option value="<?php  echo $row['drugCat'] ?>"><?php  echo $drugCat?></option>
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