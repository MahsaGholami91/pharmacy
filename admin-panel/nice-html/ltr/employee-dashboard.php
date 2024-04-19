<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Nice Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Nice Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../../dist/css/style.min.css" rel="stylesheet">
 
</head>

<body>
   
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
  
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
    
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
              
                    <div class="navbar-brand">
                        <a href="employee-dashboard.php" class="logo">
                            <b class="logo-icon">
                               
                                <img src="../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                          
                            <span class="logo-text">
                                <img src="../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                <img src="../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
              
                    
                </div>
               
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
              
                    <ul class="navbar-nav float-start me-auto">
                       
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 me-1"></i>
                                    <div class="ms-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
            
                    <ul class="navbar-nav float-end">
                  
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="pages-profile.html"><i class="ti-user me-1 ms-1"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="../../../login-page/login.php"><i class="ti-user me-1 ms-1"></i>
                                Log Out</a>
                            </ul>
                        </li>
                   
                    </ul>
                </div>
            </nav>
        </header>
    
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="employee-dashboard.php"
                                aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-add-drug.php"
                                aria-expanded="false">
                                <i class="mdi mdi-arrange-bring-forward"></i>
                                <span class="hide-menu">Add Drug</span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </nav>
            </div>
        </aside>
        
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
                    <div class="col-lg-12 col-xlg-12">
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
                    </div>
                </div>
               
            </div>
            
            <footer class="footer text-center">
                
            </footer>
           
        </div>
       
    </div>
    
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../../dist/js/waves.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.min.js"></script>
    <script src="../../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../../dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>