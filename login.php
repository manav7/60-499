<?php

include("connection.php");
$connection = getConnection(RETAIL_DB);
session_start();
  
        $username = $_POST['Username'];
		$password = $_POST['Password'];
		
		echo "username: " .$username;
		
		if($_POST){
		$query = "SELECT Username, Password FROM tblusers
					WHERE Username = '$username' AND Password = '$password' ";
					
		/*make query against database*/
		$result = mysqli_query($connection, $query);

		/*if user information is valid begin a session*/
		if(mysqli_num_rows($result)<0){
		    echo "wrong username or password";
			header("Location: http://localhost/60-499/60-499/login.html");
		}
		else{
			//setcookie("blnAuthenticated", 1);
			$_SESSION["blnAuthenticated"] = 1; 
			header("Location: http://localhost/60-499/60-499/index.html");
		}			

    }

?> 