<?php 
include("..\constant.php");
include("..\connection.php");
session_start();
$arrDataPoint = array();
$strY_AxisDisplay = "";
$strGraphDesc = "";

// save the queryID in a session upon first entry into this page
if($_POST["queryID"]){
    $_SESSION["queryID"] = $_POST["queryID"];    
}
// set the queryID to the one that has been posted or the one in the session
$intQueryID = ($_POST["queryID"])? $_POST["queryID"] : $_SESSION["queryID"];

// redirect to the table page if query doesn't need graphs
if($intQueryID == CANCELLED_ORDERS || $intQueryID == DELIVERED_SHIPMENT){
    header("location:http://localhost/499_Project/queries/tabularRep.php");
}
if($intQueryID){
    $arrOutput = executeQuery($intQueryID);
    //print_r($arrOutput);
    global $arrColumnToShow;
    global $arrCurrencyCodeMap;
    global $arrY_AxisText;
    global $arrDescriptionText;
    //var_dump($arrOutput);
    $strY_AxisDisplay = $arrY_AxisText[$intQueryID];
    $strGraphDesc = $arrDescriptionText[$intQueryID];
    if($intQueryID == PRODUCT_PER_YEAR){ 
        if($_POST["year"]){ // use the selected key
            $arrDataPoint = generateYearlyDataPoint($arrOutput, $_POST["year"]);
            $strGraphDesc = "Product Sales For ".$_POST["year"];
        }
        else{ // use the first key as a default filter for the graph
            $arrKeys = array_keys($arrOutput);
            $arrDataPoint = generateYearlyDataPoint($arrOutput, $arrKeys[0]);
            $strGraphDesc = "Product Sales For ".$arrKeys[0];
        }       
    }
    else if($intQueryID == ALL_SALES_ORDER){ 
        if($_POST["year"]){ // use the selected key
            $arrDataPoint = generateYearlyDataPoint($arrOutput, $_POST["year"]);
            $strGraphDesc = "Sales Order For ".$_POST["year"];
        }
        else{ // use the first key as a default filter for the graph
            $arrKeys = array_keys($arrOutput);
            $arrDataPoint = generateYearlyDataPoint($arrOutput, $arrKeys[0]);
            $strGraphDesc = "Sales Order For ".$arrKeys[0];
        }       
    }
    else if($intQueryID == FAILED_SHIPMENT){
        $arrDataPoint = generateCountDataPoint($arrOutput);
    }
    else if($intQueryID == TOTAL_SALES){
        $arrDataPoint = generateDateDataPoint($arrOutput);  
    }
    else if($intQueryID == SALES_PER_COUNTRY){
        $arrDataPoint = generateCountryDataPoint($arrOutput);
    }
    //var_dump($arrDataPoint);
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
                            <a href="#" onclick="openPage()" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Graphical Representation</a>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">Graphical Representation Of Data</h3>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Area Chart</h4>
                                <div class="flot-chart overFlow">
                                    <form method="post" id="frmFilter" action="<?=$_SERVER['PHP_SELF'];?>">
                                        <div id="year_select">
                                            Year: <select name="years" id="yearSelect">
                                                    <option value=""></option>
                                                    <?foreach ($arrOutput as $intYear => $arrYearProductSum) {?>
                                                        <option value="<?echo $intYear;?>"><?echo $intYear;?></option>  
                                                    <?}?>
                                                  </select> 
                                                  <input type="button" value="generate graph" onclick="generate()"></input>
                                        </div>
                                        <br/><br/>
                                        <div class="flot-chart-content" id="flot-line-chart"></div>   
                                        <input type="hidden" value="" name="year" id="year"/>
                                        <input type="hidden" value="" name="queryID" id="queryID"/>
                                    </form>

                                    <!-- <div class="flot-chart-content" id="flot-line-chart"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Column Chart</h4>
                                <div class="flot-chart overFlow">
                                        <div class="flot-chart-content" id="flot-line-chart2"></div>   
                                    <!-- <div class="flot-chart-content" id="flot-line-chart"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img1.jpg" alt="Card">
                            <div class="card-block">
                                <ul class="list-inline font-14">
                                    <li class="p-l-0">20 May 2016</li>
                                    <li><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img2.jpg" alt="Card">
                            <div class="card-block">
                                <ul class="list-inline font-14">
                                    <li class="p-l-0">20 May 2016</li>
                                    <li><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img4.jpg" alt="Card">
                            <div class="card-block">
                                <ul class="list-inline font-14">
                                    <li class="p-l-0">20 May 2016</li>
                                    <li><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
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
                Query Results
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
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot-data.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../499_CSS/queryResult.css">
    <script>
        function openPage(){
            location.reload(true);   
        }
        function hide(strElementID){
            var objElement = document.getElementById(strElementID);
            // remove the top margin if query has no graph
            if(strElementID == "frmDiv"){
                $("#resultTable").removeClass("topMargin");
            }
            objElement.style.display = "none";  
        }
        function show(strElementID){
            var objElement = document.getElementById(strElementID);
            objElement.style.display = "block";
        }
        window.onload = function () {
            var intJsQueryID = "<?echo $intQueryID?>";
            var y_axisText = ""; 
            
            // hide the filter for all query except query 3
            if(intJsQueryID != '<?echo PRODUCT_PER_YEAR?>' && intJsQueryID != '<?echo ALL_SALES_ORDER?>'){
                // hide the graph for query 5 and 7
                if((intJsQueryID == '<?echo CANCELLED_ORDERS?>') || (intJsQueryID == '<?echo DELIVERED_SHIPMENT?>')){
                    hide("frmDiv");
                }
                else{ // hide the filter for all query except query 3
                    hide("year_select");
                    y_axisText = "<?echo $strY_AxisDisplay?>";
                }
            }
            else if (intJsQueryID == '<?echo PRODUCT_PER_YEAR?>' || intJsQueryID == '<?echo ALL_SALES_ORDER?>') {
                show("year_select");
                y_axisText = "<?echo $strY_AxisDisplay?>";
            }

            var chart = new CanvasJS.Chart("flot-line-chart", {
                animationEnabled: true,
                title: {
                    text: "<?echo $strGraphDesc?>"
                },
                dataPointMaxWidth: 60, // max width of each datapoint bar
                axisY: {
                    title: y_axisText
                },
                data: [
                {
                    type: "area",                
                    dataPoints: <?php echo json_encode($arrDataPoint, JSON_NUMERIC_CHECK); ?>
                }
                ]
            });
            chart.render();

            var chart = new CanvasJS.Chart("flot-line-chart2", {
                animationEnabled: true,
                title: {
                    text: "<?echo $strGraphDesc?>"
                },
                dataPointMaxWidth: 60, // max width of each datapoint bar
                axisY: {
                    title: y_axisText
                },
                data: [
                {
                    type: "column",                
                    dataPoints: <?php echo json_encode($arrDataPoint, JSON_NUMERIC_CHECK); ?>
                }
                ]
            });
            chart.render();
        }

        /*todo: if queryID is 3 then show fieldset field otherwise hide it*/
        function generate(){
            var objYearSelect = document.getElementById("yearSelect");
            var intSelectedYear = objYearSelect.options[objYearSelect.selectedIndex].value;
            document.getElementById('year').value = intSelectedYear;
            document.getElementById("queryID").value = '<?echo $_POST["queryID"];?>';
            document.getElementById("frmFilter").submit();
        }
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
        $arrProductAndCount = array();
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
            if($intID == CANCELLED_ORDERS || $intID == FAILED_SHIPMENT || $intID == DELIVERED_SHIPMENT){
                $arrReturn[] = $arrRow;
            }
            else if($intID == TOTAL_SALES){       
                foreach ($arrRow as $strkey => $mixVal) {
                    $strElement = ($strkey == "Total") ? "$".$mixVal : $mixVal;
                    $arrTemp[$strkey] = $strElement;
                }
                $arrReturn[] = $arrTemp;
            }
            else if($intID == PRODUCT_PER_YEAR){ // map products to total per year
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
            else if($intID == ALL_SALES_ORDER){
                $dtmYear = explode("-", $arrRow["Year"])[0];
                //echo "Year: ".$dtmYear ." ";
                if($blnFirstTime){
                    $prevYear = explode("-", $arrRow["Year"])[0];
                    // echo "Prev Year: ". $prevYear;
                }
                //echo " RowCount = ". $intRowCount ." ";
                // if a key does exist update the amount for it
                if(array_key_exists($arrRow["ProductName"], $arrProductAndCount) == true && ($dtmYear == $prevYear)){
                    $intCount = $arrProductAndCount[$arrRow["ProductName"]]; // get old amount 
                    $intCount +=1;  // increment counter for this product
                    $arrProductAndCount[$arrRow["ProductName"]] = $intCount; // insert updated amount
                }   // if the 
                else if(array_search($arrRow["ProductName"], $arrProductAndCount) == false && ($dtmYear == $prevYear)){
                    $arrProductAndCount[$arrRow["ProductName"]] = 1;
                }
                if(($dtmYear != $prevYear) || ($intRowCount == $intNum_Rows)){ 
                    // map each year to it sum
                    $arrReturn[$prevYear] = $arrProductAndCount;
                    $prevYear = $dtmYear; // reset previous year variable
                    // discard previous items in product-Total mapping
                    $arrProductAndCount = array();
                    $arrProductAndCount[$arrRow["ProductName"]] = 1;
                    
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

    function generateYearlyDataPoint($arrInfo, $intYear){
        //var_dump($arrInfo);
        //var_dump($arrInfo[$intYear]);
        $arrDataPoint = array();
        foreach ($arrInfo[$intYear] as $strProductName => $intTotal) {
            $arrDataPoint[] = array("y" => $intTotal, "label" => $strProductName);  
        }

        return $arrDataPoint;
    }

    /*This generate any datapoint based on frequency counts*/
    function generateCountDataPoint($arrInfo){
        $arrFrequencyCount = array();
        $arrDataPoint = array();
        //var_dump($arrInfo);
        foreach ($arrInfo as $intKey => $arrRows) {
            foreach ($arrRows as $strCol => $strColVal) {
                if($strCol == "ProductName" || $strCol == "ShipmentService"){
                    if(!in_array($strColVal, $arrFrequencyCount)) { // data already exist 
                        $intCount = $arrFrequencyCount[$strColVal];
                        $intCount +=1;
                        $arrFrequencyCount[$strColVal] = $intCount;
                    }
                    else{
                        $arrFrequencyCount[$strColVal] = 1;
                    }
                }
            }
        }
        //var_dump($arrFrequencyCount);
        // populate datapoint array
        foreach ($arrFrequencyCount as $strIndex => $intCount) {
            $arrDataPoint[] = array("y" => $intCount, "label" => $strIndex);
        }

        return $arrDataPoint;
    }

    function generateDateDataPoint($arrInfo){
        $arrDataPoint = array();
        $strDate = "";
        $intTotal = "";

        foreach ($arrInfo as $intKey => $arrRows) {
            foreach ($arrRows as $strCol => $strColVal) {
                if($strCol == "orderDate"){
                    $strDate = date_format(date_create($strColVal), "M j, Y");
                    // $arrDataPoint[] = array("y" => )
                }
                else if($strCol == "Total"){
                    $intTotal = substr($strColVal, 1); // get rid of the dollar symbol
                }
            }
            if($strDate && $intTotal){
                //echo "Date: ". $strDate ." Total = ".$intTotal;
                $arrDataPoint[] = array("y" => $intTotal, "label" => $strDate);
            }
        }

        return $arrDataPoint;
    }

    function generateCountryDataPoint($arrInfo){
        $arrDataPoint = array();
        global $arrCurrencyCodeMap;
        $strCountry = "";
        $intTotal = "";
        //var_dump($arrCurrencyCodeMap);
        foreach ($arrInfo as $intKey => $arrRows) {
            foreach ($arrRows as $strCol => $strColVal) {
                if($strCol == "CurrencyType"){
                    $strCountry = ($strColVal == "USD") ? "USA" : "CANADA";
                }
                else if($strCol == "Total"){
                    $intTotal = substr($strColVal, 1);
                }
            }
            if($strCountry && $intTotal){
                $arrDataPoint[] = array("y" => $intTotal, "label" => $strCountry);
            }
        }

        return $arrDataPoint;
    }
?>               