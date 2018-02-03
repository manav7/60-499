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

 $arrQueryMapping = array (1 => "SELECT ProductName, CurrencyType, OrderDate As Year
								 FROM tblorder
								 INNER JOIN tblproduct ON (tblproduct.ProductID = tblorder.ProductID) GROUP BY OrderDate, ProductName",
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

// constants for each queryID
 define(ALL_SALES_ORDER, 1);
 define(TOTAL_SALES, 2);
 define(PRODUCT_PER_YEAR, 3);
 define(SALES_PER_COUNTRY, 4);
 define(CANCELLED_ORDERS, 5); // no graph
 define(FAILED_SHIPMENT, 6);
 define(DELIVERED_SHIPMENT, 7); // no graph


// constants for database type
 define(RETAIL_DB, 1); // retail database flag
 define(WAREHOUSE_DB, 2); // warehouse database flag

// constants for each y-axis "display text"
 $arrY_AxisText = array(ALL_SALES_ORDER => "Number Of Orders",
 						TOTAL_SALES => "Total Sales($)",
 						PRODUCT_PER_YEAR => "Total Sales For Product($)",
 						SALES_PER_COUNTRY => "Total Sales($) Made",
 						FAILED_SHIPMENT => "Failure Rate"
 						);

 $arrDescriptionText = array(ALL_SALES_ORDER => "All Sales Order",
 							TOTAL_SALES => "Total Sales Per Date",
 							SALES_PER_COUNTRY => "Total Sales Per Country",
 							FAILED_SHIPMENT => "Failure Rate Per Service"
 							);
 
?>