<?php

ob_start();
?>
<html> 
     <head>
	       <title>This is a DataWarehouse Quering System Prototype</title>
		   <link rel = "stylesheet" type = "text/css" href = "mystyle.css">
	<script type="text/javascript">
		function showResult(intQueryID){
			//alert("ID: " + intQueryID);
			// set parameter to be passed
			if(intQueryID){
				document.getElementById("queryID").value = intQueryID;
				document.getElementById("queryFrm").submit(); // submit form to process page
			}
			else{
				alert("This is yet to be implemented!!");
			}	
		}
	</script>	   
	 <head>
	 
	       <body>
		       	<form action="processQuery.php" method="post" id="queryFrm">
			        <h1 align="center"> Data Warehouse Quering System </h1>
					
					<img src="Image.jpg">
					
					<div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult(1);">View all sales order</a></p>
					</div>
					
					<div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult(2);">View total sales</a></p>
					</div>
					
					<!-- <div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult();">View all sales per product by year</a></p>
					</div> -->
					
					<div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult(4);">View all sales per country</a></p>
					</div>
					
					<div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult(5);">View all orders cancelled</a></p>
					</div>
					
					<div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult(6);">View all failed shipment/delivery </a></p>
					</div>
					
					<div id ="queries" style="cursor: pointer;">
						<p><a onclick = "showResult(7);">View all delivered shipment</a></p>
					</div>
					<input value="" type="hidden" name="queryID" id="queryID" />
				</form>		
		   </body>
		   
</html>
<? $strHTML .= ob_get_contents(); // get content from output buffer
	ob_end_clean(); // clean output buffer
	echo $strHTML;
?>		         
				 