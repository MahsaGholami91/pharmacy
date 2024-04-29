<?php 
    include "../../layout/header.php";
    include "../../layout/menu.php" ;
    include "../../includes/functions.php" ;



    $permission = 'drug_list';
    getPermission($conn,$permission);
       

?>
  
        <div class="page-wrapper">
           
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Drug List</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Drug List</li>
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
                                <h4 class="card-title">Drugs List</h4>
                            </div>
                            <div class="table-responsive">
                                <?php 
                                    require_once "../../includes/db.php";
                                    $recordsPerPage = 5;

                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;

                                    $offset = ($page - 1) * $recordsPerPage;

                                    $sql = "SELECT * FROM drugs LIMIT $offset, $recordsPerPage";
                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        die("Query failed");
                                    }

                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Dose</th>
                                            <th class="border-top-0">Count</th>
                                            <th class="border-top-0">Expire Date</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                            foreach($result as $row ){
                                                ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['dose']; ?></td>
                                                <td><?php echo $row['drugCount']; ?></td>
                                                <td><?php echo $row['expireDate']; ?></td>
                                                <td style="display: flex;gap: 10px;">
                                                    <form action="pages-update-drug.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" class="btn btn-success text-white">Update</button>
                                                    </form>
                                                    <form action="../../php/drugDelete.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                                <?php
                                            }
                                         
                                        ?>
                                    </tbody>
                                  
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="pagination">
                                <?php
                                // Count total number of records
                                $totalCountQuery = "SELECT COUNT(*) AS total FROM drugs";
                                $totalCountResult = mysqli_query($conn, $totalCountQuery);
                                $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                                $totalCount = $totalCountRow['total'];

                                // Calculate total number of pages
                                $totalPages = ceil($totalCount / $recordsPerPage);

                                // Previous page link
                                if ($page > 1) {
                                    echo '<a href="?page=' . ($page - 1) . '" class="page-link">&laquo; Previous</a>';
                                }

                                // Page numbers
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    echo '<a href="?page=' . $i . '" class="page-link">' . $i . '</a>';
                                }

                                // Next page link
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



            
