<?php
include("common.php");

if($_POST["blnDelete"] && $_POST["intProductID"]){
    deleteProduct($_POST["intProductID"]);
}

$arrProducts = loadAllProducts();
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
                        <h3 class="text-themecolor">Delete Products</h3>
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
                    <? //var_dump($arrUpdates); ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Products</h4>
                                <h6 class="card-subtitle">click each column to begin updatting</h6>
                                <div class="table-responsive" style="overflow-y:scroll;">
                                    <form id="deleteFrm" action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Product Manufacturer</th>
                                                    <th>Product Price</th>
                                                    <th>Quantity</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <?  $intCount = 1;
                                                        $strNameAttr = "";
                                                        $strValueAttr = "";
                                                        foreach ($arrProducts as $intProductID => $arrRows) {
                                                            $strNameAttr = "";
                                                            ?>
                                                            <tr>
                                                                <td><?echo $intCount?></td>
                                                                <?foreach ($arrRows as $strCol => $strColVal){?>
                                                                    <?if($strCol == "ProductID"){ 
                                                                        continue;         
                                                                    }
                                                                    else{?>
                                                                        <td><?echo ($strCol == "ProductPrice")? "$".$strColVal : $strColVal?></td> 
                                                                    <?}?> 
                                                                <?}?>
                                                                <td><button  onclick="deleteContact('<?echo $intProductID?>')">
                                                                        Delete <img src="images/deleteIcon.png" width="25" height="30"/>
                                                                    </button>
                                                                </td>
                                                            </tr>     
                                                        <? $intCount ++;
                                                        }?>
                                                </tbody>
                                        </table>
                                        <input type="hidden" id="productID" name="intProductID" value="0"></input>
                                        <input type="hidden" id="blnDelete" name="blnDelete" value="0"></input>
                                    </form>
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
        function deleteContact(intProductID){
            document.getElementById("productID").value = intProductID;
            document.getElementById("blnDelete").value = 1;
            document.getElementById("deleteFrm").submit();
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


    function generateArrayFromPost($arrPost){
        $arrayUpdates = array();
        $arrElements = array();
        $blnFirstTime = true;
        $intCount = 0;
        foreach ($arrPost as $strKey => $strValue) {
            $intCount++;
            if($strKey != "blnEdit" && $strKey != "blnSave"){
                $arrTokens = explode("-", $strKey); // key is of the form ["ID-ColumnName"]
                if($blnFirstTime){ 
                    $strPrevKey = $arrTokens[0];
                    $blnFirstTime = false;
                }
                
                // map a productID to it row data
                // || $intCount == (count($arrPost)-2)
                if(($strPrevKey != $arrTokens[0])){
                   // echo "Count: ". $intCount;
                    $arrayUpdates[$strPrevKey] = $arrElements;
                    $strPrevKey = $arrTokens[0];
                    $arrElements = array();
                }
                else if($intCount == (count($arrPost)-2)){
                    $arrElements[$arrTokens[1]] = $strValue;
                    $arrayUpdates[$strPrevKey] = $arrElements;
                    $strPrevKey = $arrTokens[0];
                    $arrElements = array();    
                }
                $arrElements[$arrTokens[1]] = $strValue;  // map each product column to value    
            }            
        }

        //var_dump($arrayUpdates);
        return $arrayUpdates;
    }
?>          
