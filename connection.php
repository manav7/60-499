<?php

 /*establish database connection with database information*/

 $db_username = "root";
 $db_name = "project_499";
 $host = "localhost";
 $password = "wils1996";

 $connection = mysqli_connect($host, $db_username, $password, $db_name);


  if(mysqli_connect_errno()){
  	echo "Failed to connect: " . mysqli_connect_errno();
  }
  else{
  	//echo "Connected!";
  }

?>