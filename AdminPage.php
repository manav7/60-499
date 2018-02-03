<?php
include("common.php");
session_start();

if(!$_SESSION["blnAuthenticated"]){
    header("Location: http://localhost/499_Project/admin_loginPage.php");
}
else{
    $arrProducts = loadAllProducts();
}
//var_dump($arrProducts);
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
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="499_CSS/common.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
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
                            <a class="waves-effect waves-dark" href="viewOrders.php" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">View sales order</span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="viewProductSales.php" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Sales per product</span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="viewCustomerInfo.php" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">View Customer Info</span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="http://localhost/499_Project/admin_loginPage.php" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i>
                            <span class="hide-menu">Log out </span>
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
                        <h3 class="text-themecolor">Product Overview</h3>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Sales overview chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                       <!--  <div class="card"> -->
                            <div class="card-body">
                                <div class="tableContainer">
                                    <div id="resultTable" class="topMargin rightMargin">
                                        <table width="100%" border="1" id="data" class="display" cellspacing="0">
                                            <thead> 
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Product Manufacturer</th>
                                                    <th>Product Price</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                    <?foreach ($arrProducts as $intProductID => $arrRows) {?>
                                                        <tr>
                                                            <?foreach ($arrRows as $strCol => $strColVal){?>
                                                                <?if($strCol == "ProductID"){ 
                                                                  continue;         
                                                                }
                                                                else{?>
                                                                   <td><?echo ($strCol == "ProductPrice")? "$".$strColVal : $strColVal?></td> 
                                                                <?}?> 
                                                            <?}?>
                                                        </tr>
                                                    <?}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                           <!--  </div> -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2017 Admin Page </footer>
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
    <!-- Bootstrap popper Core JavaScript -->
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
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/plugins/d3/d3.min.js"></script>
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <!--Data table files -->
    <script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
     <script>
        $(document).ready(function() {
            $('#data').DataTable(); 
        });
    </script>
</body>
</html>
<? $strHTML .= ob_get_contents(); // get content from output buffer
    ob_end_clean(); // clean output buffer
    echo $strHTML;
?>               