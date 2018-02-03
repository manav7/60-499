<?php 
include("..\constant.php");
include("..\connection.php");
session_start();
$strGraphDesc = "";
if($_SESSION["queryID"]){
    $intQueryID = $_SESSION["queryID"];
    $arrOutput = executeQuery($intQueryID);
    //print_r($arrOutput);
    global $arrColumnToShow;
    global $arrCurrencyCodeMap;
    global $arrDescriptionText;

    $strGraphDesc = $arrDescriptionText[$intQueryID];
    
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
    <title>Query Result</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
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
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b>
                           Query Results
                        </b>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- this is used to align the user info to the right -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <!-- <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-20">
                                <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li> -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/imageDefault.jpg" alt="user" class="profile-pic m-r-5" />Login UserName Here</a>
                        </li>
                    </ul>
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
                            <a href="wareHouseQuery.php" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Queries</a>
                        </li>
                        <li>
                            <a href="Graph_result.php" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Graphical Representation</a>
                        </li>
                        <li>
                            <a href="tabularRep.php" class="waves-effect"><i class="fa fa-table m-r-10" aria-hidden="true"></i>Tabular Representation</a>
                        </li>
                        <li>
                            <a href="icon-fontawesome.html" class="waves-effect"><i class="fa fa-font m-r-10" aria-hidden="true"></i>Icons</a>
                        </li>
                        <li>
                            <a href="map-google.html" class="waves-effect"><i class="fa fa-globe m-r-10" aria-hidden="true"></i>Google Map</a>
                        </li>
                        <li>
                            <a href="pages-blank.html" class="waves-effect"><i class="fa fa-columns m-r-10" aria-hidden="true"></i>Blank Page</a>
                        </li>
                        <li>
                            <a href="pages-error-404.html" class="waves-effect"><i class="fa fa-info-circle m-r-10" aria-hidden="true"></i>Error 404</a>
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
                <?//var_dump($_SESSION);?>
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabular Representation Of Data</h3>
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title"><?echo $strGraphDesc;?></h4>
                                <div class="table-responsive">
                                    <div>    
                                        <table width="100%" border="1" id="data" class="display" cellspacing="0">
                                            <thead> 
                                                <tr>
                                                <?
                                                    $arrColumnsHeaders = $arrColumnToShow[$intQueryID];
                                                    foreach ($arrColumnsHeaders as $strCol) {?>
                                                        <th>
                                                            <?echo $strCol;?>   
                                                       </th>
                                                    <?}
                                                ?>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            <?  if($intQueryID == PRODUCT_PER_YEAR){
                                                    
                                                    //print_r($arrOutput);
                                                        foreach ($arrOutput as $dtmYear => $arrYearProductSum) {
                                                            //echo "Year: ". $dtmYear. " ";
                                                            foreach ($arrYearProductSum as $strProductName => $intTotal) {
                                                                //echo "Product: ". $strProductName;
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?echo $dtmYear; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?echo $strProductName;?>
                                                                    </td>
                                                                    <td>
                                                                        <?echo "$".$intTotal;?>
                                                                    </td>
                                                                </tr>
                                                            <?}

                                                        }?>
                                                    <?      
                                                }
                                                else{
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
                                                }           
                                            ?>
                                            </tbody>
                                            </table>
                                        </div>
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
            <footer class="footer text-center">
                Tabular Representation
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
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!--Data table files -->
    <script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../499_CSS/queryResult.css">
    <script>
        $(document).ready(function() {
            $('#data').DataTable(); 
        });
    </script>
</body>
</html>
<?
    $strHTML .= ob_get_contents(); // get content from output buffer
    ob_end_clean(); // clean output buffer
    echo $strHTML;

    function executeQuery($intID){
        $arrReturn;
        $connection = getConnection(WAREHOUSE_DB); 
        global $arrQueryMapping;
        $arrTemp = array();
        $arrProductAndTotal = array();
        $strSQL = $arrQueryMapping[$intID];
        $rsResult = mysqli_query($connection, $strSQL);
        $arrYearProductSum = array();
        $blnFirstTime = true;
        $intTotal = 0;
        $intNum_Rows = mysqli_num_rows($rsResult);
        //echo "Row Count: ". $intNum_Rows;
        $intRowCount = 0;
        while ($arrRow = mysqli_fetch_assoc($rsResult)) {
            $intRowCount ++;
            if($intID == ALL_SALES_ORDER || $intID == CANCELLED_ORDERS || $intID == FAILED_SHIPMENT || $intID == DELIVERED_SHIPMENT){
                $arrReturn[] = $arrRow;
            }
            else if($intID == TOTAL_SALES){       
                foreach ($arrRow as $strkey => $mixVal) {
                    $strElement = ($strkey == "Total") ? "$".$mixVal : $mixVal;
                    $arrTemp[$strkey] = $strElement;
                }
                $arrReturn[] = $arrTemp;
            }
            else if($intID == PRODUCT_PER_YEAR){
                $dtmYear = explode("-", $arrRow["Year"])[0];
                //echo "Year: ".$dtmYear ." ";
                if($blnFirstTime){
                    $prevYear = explode("-", $arrRow["Year"])[0];
                    // echo "Prev Year: ". $prevYear;
                }
                //echo " RowCount = ". $intRowCount ." ";
                // if a key does exist update the amount for it
                if(array_key_exists($arrRow["ProductName"], $arrProductAndTotal) == true && ($dtmYear == $prevYear)){
                    $intAmt = $arrProductAndTotal[$arrRow["ProductName"]]; // get old amount 
                    $intAmt += $arrRow["Total"]; // update amount
                    $arrProductAndTotal[$arrRow["ProductName"]] = $intAmt; // insert updated amount
                }   // if the 
                else if(array_search($arrRow["ProductName"], $arrProductAndTotal) == false && ($dtmYear == $prevYear)){
                    $arrProductAndTotal[$arrRow["ProductName"]] = $arrRow["Total"];
                }
                if(($dtmYear != $prevYear) || ($intRowCount == $intNum_Rows)){ 
                    // map each year to it sum
                    $arrReturn[$prevYear] = $arrProductAndTotal;
                    $prevYear = $dtmYear; // reset previous year variable
                    // discard previous items in product-Total mapping
                    $arrProductAndTotal = array();
                    $arrProductAndTotal[$arrRow["ProductName"]] = $arrRow["Total"];
                    
                }
                //echo " RowCount == ". $intRowCount. " SQL count: ". $intNum_Rows;
                $blnFirstTime = false;  
            }
            else if ($intID == SALES_PER_COUNTRY){
                foreach ($arrRow as $strkey => $mixVal) {
                    $strElement = ($strkey == "Total") ? "$".$mixVal : $mixVal;
                    $arrTemp[$strkey] = $strElement;
                }
                $arrReturn[] = $arrTemp;
            }
        
        }

        return $arrReturn;
    }

?>
