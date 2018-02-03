<?php
include("..\constant.php");
include("..\connection.php");
//var_dump($_POST);
$arrDataPoint = array();
$strY_AxisDisplay = "";
$strGraphDesc = "";
if($_POST["queryID"]){
	$intQueryID = $_POST["queryID"];
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
	else if($intQueryID == ALL_SALES_ORDER || $intQueryID == FAILED_SHIPMENT){
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
<!DOCTYPE>
<html>
<head>
	<title>Result</title>
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
			if(intJsQueryID != '<?echo PRODUCT_PER_YEAR?>'){
				// hide the graph for query 5 and 7
				if((intJsQueryID == '<?echo CANCELLED_ORDERS?>') || (intJsQueryID == '<?echo DELIVERED_SHIPMENT?>')){
					hide("frmDiv");
				}
				else{ // hide the filter for all query except query 3
					hide("year_select");
					y_axisText = "<?echo $strY_AxisDisplay?>";
				}
			}
			else if (intJsQueryID == '<?echo PRODUCT_PER_YEAR?>') {
				show("year_select");
				y_axisText = "<?echo $strY_AxisDisplay?>";
			}

			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				title: {
					text: "<?echo $strGraphDesc?>"
				},
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
</head>
<body>
	<center>	
	<p><strong><a href="wareHouseQuery.php"> &lt; Query Page </a> &nbsp;&nbsp;&nbsp;&nbsp; Query Output</strong></p><br/>
	<div id="frmDiv">
		<form method="post" id="frmFilter" action="<?=$_SERVER['PHP_SELF'];?>">
			<fieldset id="Year_fld">
				<legend>Graphical Representation Of Data</legend>
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
				<div id="chartContainer"></div>	  
			</fieldset>
			<input type="hidden" value="" name="year" id="year"/>
			<input type="hidden" value="" name="queryID" id="queryID"/>
		</form>
	</div>	
	<div id="resultTable" class="topMargin">	
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
	</center>
</body>
</html>
<?
	$strHTML .= ob_get_contents(); // get content from output buffer
    ob_end_clean(); // clean output buffer
    echo $strHTML;
    
	function executeQuery($intID){
		$arrReturn;
		global $connection;
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
			if($intID == 1 || $intID == 5 || $intID == 6 || $intID == 7){
				$arrReturn[] = $arrRow;
			}
			else if($intID == 2){		
				foreach ($arrRow as $strkey => $mixVal) {
					$strElement = ($strkey == "Total") ? "$".$mixVal : $mixVal;
					$arrTemp[$strkey] = $strElement;
				}
				$arrReturn[] = $arrTemp;
			}
			else if($intID == 3){
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
				}	// if the 
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
			else if ($intID == 4){
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