
<?php 

    include "../../layout/header.php";
    include "../../layout/menu.php" ;
    include "../../includes/functions.php" ;
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
            $_SESSION['error-msg'] = "Dose must be number";
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        } 
        if(checkIntCount($drugCount) !== false){
            $_SESSION['error-msg'] = "Count must be number";
            header("location: ../nice-html/ltr/pages-add-drug.php");
            exit();
        }
        

        if(addOrUpdateDrug($conn, $drugName, $drugDose, $drugCount, $drugDesc, $drugExp, $drugCat)){
            $_SESSION['success-msg'] = "Drug added";
            header("Location: ../nice-html/ltr/pages-add-drug.php");
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
                        }else if (!empty($_SESSION['success-msg'])) { ?>
                            <div class="text-success"><?php echo $_SESSION['success-msg']; ?></div>
                            <?php $_SESSION['success-msg'] = ""; } ?>
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

