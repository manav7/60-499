<?php
include("common.php");

/*TODO: use a css class to change field color when user clicks edit*/ 

$arrOutput = getAllOrders();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Admin Page</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Pro</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="AdminPage.php">
                        <b> <!-- Logo icon -->
                            Admin Page
                        </b>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
               <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> 
                            <a class="waves-effect waves-dark" href="AdminPage.php" aria-expanded="false"><i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">View Products</span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="UpdateProducts.php" aria-expanded="false"><i class="mdi mdi-table"></i>
                            <span class="hide-menu">Update Products</span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="addProduct.php" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Add Products</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="deleteProduct.php" aria-expanded="false"><i class="mdi mdi-earth"></i>
                            <span class="hide-menu">Delete Products</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="pages-blank.html" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">View Customers</span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="http://localhost/499_Project/admin_loginPage.php" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Log out </span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="pages-blank.html" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Data Warehouse </span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">All Customers</h3>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <? //var_dump($_POST);?>
                    <? //var_dump($arrCustomers); ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Orders</h4>
                                <div class="table-responsive">
                                    <table width="100%" border="1" id="data" class="display" cellspacing="0">
                                        <thead>
                                            <tr>
                                               <!--  <th>#</th> -->
                                                <th>Product Name</th>
                                                <th>Total</th>
                                                <th>Year</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <?
                                                   foreach ($arrOutput as $mixVal => $arrValues) {?>
                                                        <tr>
                                                            <?foreach ($arrValues as $strCol => $strColVal) {
                                                                 //echo "Column: ". $strCol . " Val: ". $strColVal . " ";
                                                                ?>
                                                                <td>
                                                                    <? 
                                                                        if($strCol == "CurrencyType" || $strCol == "USD" || $strCol == "CAD"){
                                                                            $val = ($strColVal == "USD") ? "USA" : "CANADA";
                                                                            echo $val;
                                                                        }
                                                                        else{
                                                                            echo $strColVal;
                                                                        }       
                                                                    ?>  
                                                               </td>
                                                            <?}?>
                                                        </tr>
                                                    <?}  
                                                ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                Customers   
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!--Data table files -->
    <script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    
    <script>
        $(document).ready(function() {
            $('#data').DataTable(); 
        });

        function editContact(){
            document.getElementById("blnEdit").value = 1;
            document.getElementById("editFrm").submit();
        }

        function updateContact(){
            document.getElementById("blnSave").value = 1;
            document.getElementById("editFrm").submit();  
        }
    </script>
</body>
</html>
<? $strHTML .= ob_get_contents(); // get content from output buffer
    ob_end_clean(); // clean output buffer
    echo $strHTML;
?>          
