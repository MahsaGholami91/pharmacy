<?php   
    include "header.php";
?>
    
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <?php
                        // $query = "SELECT * FROM `permission` JOIN `role_permission` on `permission`.`permission`=`role_permission`.`permission` WHERE `role_permission`.`roleId`= ?; ";
                        // $result = mysqli_query($conn, $query);
                        echo "result";
                        die;
                    ?>



                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin-dashboard.php"
                            aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-add-user.php" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>
                            <span class="hide-menu">Add User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-add-drug.php" aria-expanded="false">
                            <i class="mdi mdi-arrange-bring-forward"></i>
                            <span class="hide-menu">Add Drug</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-drug-list.php" aria-expanded="false">
                            <i class="mdi mdi-arrange-bring-forward"></i>
                            <span class="hide-menu">Drug List</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-add-Text.php" aria-expanded="false">
                            <i class="mdi mdi-file"></i>
                            <span class="hide-menu">Analyze Text</span>
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </aside>