<?php

 /*establish database connection with database information*/
 $arrLocal_IP = array("127.0.0.1", "::1"); // ip address for local servers
if(in_array($_SERVER["REMOTE_ADDR"], $arrLocal_IP)){
	//echo "On local server: apache";
	$db_username = "root";
	$db_name = "project_499";
	$host = "localhost";
	$password = "wils1996";
}
else{
	//echo "On school server: myweb";
	$db_username = "chugh11_499";
	$db_name = "chugh11_project499";
	$host = "localhost";
	$password = "warehouse";

}
 // $db_username = "root";
 // $db_name = "project_499";
 // $host = "localhost";
 // $password = "wils1996";

 $connection = mysqli_connect($host, $db_username, $password, $db_name);


  if(mysqli_connect_errno()){
  	echo "Failed to connect: " . mysqli_connect_errno();
  }
  else{
  	//echo "Connected!";
  }

?>