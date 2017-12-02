<?php

$arrCurrencyCodeMap = array('USD' => "USA", 
							'CAD' => "CANADA"
							);
 
$arrColumnToShow = array(1 => array("ProductName", "Country", "OrderDate"),
						 2 => array("OrderDate", "Total"),
						 3 => array("Year", "ProductName", "Total"),
						 4 => array("Country", "Sales"),
						 5 => array("ProductName", "Country", "OrderStatus"),
						 6 => array("ShipmentDate", "ShipmentService", "DeliveryStatus"),
						 7 => array("ShipmentDate", "ShipmentService", "DeliveryStatus")
						 );

 $arrQueryMapping = array (1 => "SELECT ProductName, CurrencyType, OrderDate
								 FROM tblorder
								 INNER JOIN tblproduct ON (tblproduct.ProductID = tblorder.ProductID)",
						   2 =>  "SELECT orderDate, SubTotal As Total FROM tblsales",
						   3 =>  "SELECT OrderDate As Year, ProductName, (OrderQuantity * ProductPrice) As Total 
						   		  FROM tblorder INNER JOIN tblproduct ON (tblorder.ProductID = tblproduct.ProductID) GROUP BY OrderDate, ProductName",

						   4 =>  "SELECT CurrencyType, SUM((OrderQuantity * ProductPrice)) As Total FROM tblOrder 
									INNER JOIN tblProduct ON (tblproduct.ProductID = tblorder.ProductID) GROUP BY CurrencyType",

						   5 =>   "SELECT ProductName, Country, OrderStatus 
									FROM tblorder
									INNER JOIN tblproduct ON (tblorder.ProductID = tblproduct.ProductID)
									INNER JOIN tblcustomer ON (tblorder.CustomerID = tblcustomer.CustomerID)
									WHERE OrderStatus = 'Cancelled'",

						   6 =>	   "SELECT ShipmentDate, ShipmentService, DeliveryStatus FROM tblshipment WHERE DeliveryStatus = 'Failed'",

						   7 =>		"SELECT ShipmentDate, ShipmentService, DeliveryStatus FROM tblshipment WHERE DeliveryStatus = 'Delivered'"			  

 						);	

?>