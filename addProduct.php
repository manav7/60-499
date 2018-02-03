<?php
include("common.php");

if($_POST["strSaveForm"] == 1){
    saveProduct($_POST);
}

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
    <link <link rel="stylesheet" href="499_CSS/common.css" >
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
                    <a class="navbar-brand" href="index.html">
                        <b>
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
                            <span class="hide-menu">View Users</span>
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
                        <h3 class="text-themecolor">Add Products</h3>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product Form</h4>
                                <h6 class="card-subtitle">Add Products</code></h6>
                                <!-- <div class="container">     -->
                                    <div class="contactFormDiv">    
                                        <form class="form-horizontal" id="newProductFrm" action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                                          <div class="form-group">
                                            <label for="strProductName" class="col-sm-2 control-label">Product Name&nbsp;&nbsp;<span style="color:red; font-size:18px;">*</span></label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="strProductName" name="strProductName" placeholder="Product Name">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="strPManufacturer" class="col-sm-2 control-label">Manufacturer &nbsp;&nbsp;<span style="color:red; font-size:18px;">*</span></label>
                                            <div class="col-sm-10">
                                              <input type="text"  class="form-control" id="strPManufacturer" name="strProductManufacturer" placeholder="Product Manufacturer">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="strPriceProduct" class="col-sm-2 control-label">Product Price&nbsp;&nbsp;<span style="color:red; font-size:18px;">*</span></label>
                                            <div class="col-sm-10">
                                              <input type="text" name="strProductPrice" class="form-control" id="strProductPrice" placeholder="Product Price">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="strPhone2" class="col-sm-2 control-label">Quantity&nbsp;&nbsp;<span style="color:red; font-size:18px;">*</span></label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="strQuantity" name="strQuantity" placeholder="Product Quantity">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                              <button class="btn btn-default" onclick="saveProduct()">Save Product</button>
                                            </div>
                                          </div>
                                          <input type="hidden" id="strSaveForm" name="strSaveForm" value="0"/> 
                                        </form>
                                    </div>
                                <!-- </div> -->
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
                © 2017 Products
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
    <script>
        function saveProduct(){
            var strProductName = document.getElementById("strProductName").value;
            var strManufacturer = document.getElementById("strPManufacturer").value;
            var strProductPrice = document.getElementById("strProductPrice").value;
            var intProductQuantity = document.getElementById("strQuantity").value;

            if(strManufacturer && strProductName && strProductPrice && intProductQuantity){
                document.getElementById("strSaveForm").value = 1;
                document.getElementById("newProductFrm").submit();
            }
            else{
                alert("One or more required fields missing!");
                return;
            }
        }
    </script>
</body>
</html>
<? $strHTML .= ob_get_contents(); // get content from output buffer
    ob_end_clean(); // clean output buffer
    echo $strHTML;
?>          
