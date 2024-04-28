<?php
        include "../../includes/db.php";

        
    ?>
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin-dashboard.php"
                            aria-expanded="false">
                            <i class="mdi mdi-av-timer"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <?php
                        $query = "SELECT * FROM `menu_item` JOIN `role_permission` on `menu_item`.`permissionId`=`role_permission`.`permissionId` WHERE `role_permission`.`roleId`= '". $_SESSION['roleId'] ."';  ";
                        $result = mysqli_query($conn, $query);
                        // echo "result";
                        // die;
                        foreach($result as $row){
                        
                        
                    ?>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $row['url'] ?>" aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>
                            <span class="hide-menu"><?php echo  $row['name'] ?></span>
                        </a>
                    </li>

                   
                    <?php } ?>
                    <!-- <li class="sidebar-item">
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
                    </li> -->
                    
                </ul>
            </nav>
        </div>
    </aside>