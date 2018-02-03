<?php // common file that holds all common functionalities for different pages
include("connection.php");
include("productClass.php");
include("customerClass.php");

function getAllOrders(){
	$connection = getConnection(RETAIL_DB);
	$arrReturn = array();
	$strSQL = "SELECT ProductName, CurrencyType, OrderDate As Year
				FROM tblorder
				INNER JOIN tblproduct ON (tblproduct.ProductID = tblorder.ProductID) GROUP BY OrderDate, ProductName";
	$rsResult = mysqli_query($connection, $strSQL);
	while ($arrRow = mysqli_fetch_assoc($rsResult)) {
		$arrReturn[] = $arrRow;
	}

	return $arrReturn;
				
}

function getAllSalesPerProduct(){
	$connection = getConnection(RETAIL_DB);
	$arrReturn = array();
	$blnFirstTime = true;
	$arrProductAndTotal = array();
	$intRowCount = 0;
	$strSQL = "SELECT OrderDate As Year, ProductName, (OrderQuantity * ProductPrice) As Total 
				FROM tblorder INNER JOIN tblproduct ON (tblorder.ProductID = tblproduct.ProductID) GROUP BY OrderDate, ProductName";

	$rsResult = mysqli_query($connection, $strSQL);
	$intNum_Rows = mysqli_num_rows($rsResult);
	while ($arrRow = mysqli_fetch_assoc($rsResult)) {
		$intRowCount ++;
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

	return $arrReturn;				
}

function getAllCustomers(){
	$objCustomer = new customer();
	return($objCustomer->getAllCustomers());
}

function loadAllProducts(){
	$objProduct = new product();
	return ($objProduct->getAllProducts());
}

function updateProductInfo($arrItemsToUpdates){
	$objProduct = new product();
	$objProduct->updateProducts($arrItemsToUpdates);
	//return ($objProduct->getAllProducts());
}

function saveProduct($arrPost){
	$objProduct = new product();
	$objProduct->setProductName($arrPost["strProductName"]);
	$objProduct->setProductPrice($arrPost["strProductPrice"]);
	$objProduct->setProductQuantity($arrPost["strQuantity"]);
	$objProduct->setProductManufacturer($arrPost["strProductManufacturer"]);
	$objProduct->insertProduct();
}

function deleteProduct($intProductID){
	$objProduct = new product($intProductID);
	$objProduct->deleteProduct();
}
?>