<?php 
    include "../../layout/header.php";
    include "../../layout/menu.php" ;
    include "../../includes/functions.php" ;

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

    getPermission($conn,'analyze_text');
    $success = "";

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
            // var_dump($downloadLink);
            // die;
            
        }        
    }

   

?>
        <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
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
                                <h4 class="card-title">Drugs List</h4>
                            </div>
                            <div class="table-responsive">
                                <?php 
                                    require_once "../../includes/db.php";
                                    $recordsPerPage = 5;

                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;

                                    $offset = ($page - 1) * $recordsPerPage;

                                    $sql = "SELECT * FROM `text` LIMIT $offset, $recordsPerPage";
                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        die("Query failed");
                                    }

                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">Text</th>
                                            <th class="border-top-0">Analyzed</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                            foreach($result as $row ){
                                                ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo $row['id']; ?></td>
                                                <td style="vertical-align: middle;"><?php echo $row['text']; ?></td>
                                                <td style="vertical-align: middle;"><?php echo $row['analyzed']; ?></td>
                                                <td style="vertical-align: middle;">
                                                <button type="button" class="btn btn-danger text-white" onclick="openDeleteModal(<?php echo $row['id']; ?>)">Delete</button>
                                                <?php 
                                                    $downloadLink = createResultFile($row['text'], countWordsAndSpaces($row['text']));
                                                    if ($downloadLink): ?>
                                                        <div class="download-link">
                                                            <a href="<?php echo $downloadLink; ?>" download>Download Result File</a>
                                                        </div>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                  
                                </table>
                            </div>

                            <div class="pagination">
                                <?php
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
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include "../../layout/footer.php" ?>
