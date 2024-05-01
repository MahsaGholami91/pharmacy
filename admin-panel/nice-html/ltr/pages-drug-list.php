<?php 
   include "../../layout/header.php";
   include "../../layout/menu.php";
   include "../../includes/functions.php" ;
    getPermission($conn,'drug_list');
       
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
        <form id="deleteForm" action="../../php/drugDelete.php" method="POST">
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
                                                <a href="pages-update-drug.php?id=<?php echo $row['id']; ?>">
                                                        <button type="submit" class="btn btn-success text-white">Update</button>
                                                        </a>
                                                    <button type="button" class="btn btn-danger text-white" onclick="openDeleteModal(<?php echo $row['id']; ?>)">Delete</button>
                                                   
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
                                $totalCountQuery = "SELECT COUNT(*) AS total FROM drugs";
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



            
