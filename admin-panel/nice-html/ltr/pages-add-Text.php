<?php 
    include "../../layout/header.php";
    include "../../layout/menu.php" ;
    include "../../includes/functions.php" ;


    $permission = 'analyze_text';
    getPermission($conn,$permission);
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
        }
        // echo "<label for='textAnalyzed'>Word and Space Counts:</label>";
        // echo '<textarea class="form-control" name = "textAnalyzed" rows="4" cols="50">';
        // foreach ($counts["words"] as $word => $count) {
        //     echo "$word: $count".", ";
        // }

        // echo "Spaces: " . $counts["spaces"] ;
        // echo "</textarea>";
        // echo "<br>";
        // echo '<button name="submitBtn" class="btn btn-success text-white">Save Text</button> ';



        
    }

?>
        
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
                                <?php if(!empty($success)){
                                    ?>
                                    <div><?php echo $success ?></div>

                                    <?php
                                } ?>
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
                
            </div>
            
            <?php include "../../layout/footer.php" ?>
