<?php
date_default_timezone_set('America/Toronto'); // used to avoid warnings
 /*establish database connection with database information*/
$arrLocal_IP = array("127.0.0.1", "::1"); // ip address for local servers
// variable declaration
$connection = null;
$db_username = "";
$db_name = "";
$host = "";
$password = "";
if(in_array($_SERVER["REMOTE_ADDR"], $arrLocal_IP)){
	//echo "On local server: apache";
	$db_username = "root";
	$db_name = "project_499";
	$host = "localhost";
	$password = "rootmanav";
	// warehouse database variable
}
else{
	//echo "On school server: myweb";
	$db_username = "chugh11_499";
	$db_name = "chugh11_project499";
	$host = "localhost";
	$password = "warehouse";
}
$db_name2 = "retail_warehouse";
  
/*	this function opens connection with the desired 
	database depending on the request(input) 
 */
 function getConnection($intDatabaseType){
 	global $db_username, $db_name, $host, $password, $db_name2;
 	if($intDatabaseType == RETAIL_DB){ // connect to retail warehouse 
 		//echo "<center><div> User Name: ". $db_username. "</div></center>";
 		$connection	= mysqli_connect($host, $db_username, $password, $db_name);
 	}
 	else{ // connect to warehouse database
 		$connection = mysqli_connect($host, $db_username, $password, $db_name2);
 	}
 	return $connection;	
 }
 
  if(mysqli_connect_errno()){
  	echo "Failed to connect: " . mysqli_connect_errno();
  }
  else{
  	//echo "Connected!";
  }
?>