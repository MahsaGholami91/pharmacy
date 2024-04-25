<?php 
session_start();
    include "../../layout/header.php";
    include "../../layout/aside.php" ;
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
                                <form class="form-horizontal form-material mx-2"  method="post" >   
                                    <div class="form-group">
                                        <label for="text">Enter your text:</label>
                                        <textarea id="text" class="form-control" name="text" rows="4" cols="50"></textarea><br>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="btn btn-success text-white" type="submit" value="Count Words" onclick="analizeText()">
                                        </div>
                                    </div>
                                    <?php


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
                                            echo "<label for='textAnalyzed'>Word and Space Counts:</label>";
                                            echo '<textarea class="form-control" name = "textAnalyzed" rows="4" cols="50">';
                                            foreach ($counts["words"] as $word => $count) {
                                                echo "$word: $count".", ";
                                            }

                                            echo "Spaces: " . $counts["spaces"] ;
                                            echo "</textarea>";
                                            echo "<br>";
                                            echo '<button name="submitBtn" class="btn btn-success text-white">Save Text</button> ';
                                            
                                        }
                                        
                                        
                                    ?>
                                </form>

                                

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <?php include "../../layout/footer.php" ?>
