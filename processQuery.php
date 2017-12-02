<?php
include("constant.php");
include("connection.php");

if($_POST["queryID"]){
	$intQueryID = $_POST["queryID"];
	$arrOutput = executeQuery($intQueryID);
	//print_r($arrOutput);
	global $arrColumnToShow;
	global $arrCurrencyCodeMap;   
}

ob_start();
?>
<!DOCTYPE>
<html>
<head>
	<title>Result</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="test.js"></script>
	<!--Data table files -->
	<script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<script>
		$(document).ready(function() {
			$('#data').DataTable();	
		});
	</script>
</head>
<body style="background-color:#DCDCDC;">
	<center>
	<h3>Query Output</h3><br/>	
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
	</tbody>	
	<?  if($intQueryID == 3){
			foreach ($arrOutput as $intKey => $arrYearProductSum) {?>
				<tr>	
				<?foreach ($arrYearProductSum as $dtmYear => $arrProductSum) {
					foreach ($arrProductSum as $strProductName => $intTotal) {?>
						<td>
							<?echo $dtmYear; ?>
						</td>
						<td>
							<?echo $strProductName;?>
						</td>
						<td>
							<?echo $intTotal;?>
						</td>
					<?}

				}?>
				</tr>
			<?}		
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
	</center>
</body>
</html>
<?
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
		while ($arrRow = mysqli_fetch_assoc($rsResult)) {
			if($intID == 1){
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
				if($blnFirstTime){
					$prevYear = explode("-", $arrRow["Year"])[0];
				}
				if(array_key_exists($arrRow["ProductName"], $arrProductAndTotal) == true && ($dtmYear == $prevYear)){
					$intAmt = $arrProductAndTotal[$arrRow["ProductName"]]; // get old amount 
					$intAmt += $arrRow["Total"]; // update amount
					$arrProductAndTotal[$arrRow["ProductName"]] = $intAmt; // insert updated amount
				}
				else if(array_search($arrRow["ProductName"], $arrProductAndTotal) == false && ($dtmYear == $prevYear)){
					$arrProductAndTotal[$arrRow["ProductName"]] = $arrRow["Total"];
				}
				else if($dtmYear != $prevYear){
					//add to collection of year product Total mapping
					$arrYearProductSum[$prevYear] = $arrProductAndTotal;
					$prevYear = $dtmYear; // reset previous year variable
					// discard previous items in product-Total mapping
					$arrProductAndTotal = array();
					$arrProductAndTotal[$arrRow["ProductName"]] = $arrRow["Total"];
				}
				$arrReturn[] = $arrYearProductSum;
				$blnFirstTime = false;	
			}
			else if ($intID == 4){
				foreach ($arrRow as $strkey => $mixVal) {
					$strElement = ($strkey == "Total") ? "$".$mixVal : $mixVal;
					$arrTemp[$strkey] = $strElement;
				}
				$arrReturn[] = $arrTemp;
			}
			else if($intID == 5 || $intID == 6 || $intID == 7){
				$arrReturn[] = $arrRow;
			}
		
		}

		return $arrReturn;
	}

	// function generateHTML($arrData){
	// 	$strHTML = "";
	// 	foreach ($arrData as $dtmYear => $arrProductSum) {
	// 		foreach ($arrProductSum as $strProductName => $strValue) {
				
	// 		}
	// 	}
	// }
?>