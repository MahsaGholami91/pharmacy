<?php 
    include "../../layout/header.php";
    include "../../layout/aside.php" ;


?>
        

       
        <div class="page-wrapper">
           
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <!-- <div class="col-lg-12 col-xlg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Drugs List</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">NAME</th>
                                            <th class="border-top-0">Dose</th>
                                            <th class="border-top-0">Count</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="txt-oflo">Elite admin</td>
                                            <td class="txt-oflo">18</td>
                                            <td><span class="font-medium">24</span></td>
                                            <td style="display: flex;gap: 10px;">
                                                <form action="drugUpdate.php" method="POST">
                                                    <button type="submit" class="btn btn-success text-white">Update</button>
                                                </form>
                                                <form action="drugDelete.php" method="POST">
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>
                                            </td>
                                           
                                        </tr>
                                        <tr>

                                            <td class="txt-oflo">Real Homes WP Theme</td>
                                            <td class="txt-oflo">19</td>
                                            <td><span class="font-medium">1250</span></td>
                                            <td style="display: flex;gap: 10px;">
                                                <form action="drugUpdate.php" method="POST">
                                                    <button type="submit" class="btn btn-success text-white">Update</button>
                                                </form>
                                                <form action="drugDelete.php" method="POST">
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td class="txt-oflo">Ample Admin</td>
                                            <td class="txt-oflo">19</td>
                                            <td><span class="font-medium">1250</span></td>
                                            <td style="display: flex;gap: 10px;">
                                                <form action="drugUpdate.php" method="POST">
                                                    <button type="submit" class="btn btn-success text-white">Update</button>
                                                </form>
                                                <form action="drugDelete.php" method="POST">
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                </div>
                
            </div>
            
            <?php include "../../layout/footer.php" ?>