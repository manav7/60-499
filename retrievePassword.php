<?php
include_once("connection.php");
$arrUserInfo = array();
if($_POST["user-Name"]){
	if(!retrievePswrd($_POST["user-Name"])){
		echo "<script>alert('User name or email is incorrect!')</script>";
	}
}
else if($_POST["strEmail"]){
	if(!retrievePswrd($_POST["strEmail"])){
		echo "<script>alert('User name or email is incorrect!')</script>";
	}	
}
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Password</title>
	<script>
		window.onload = function(){
			var userName = "";
			var password = "";
			<?if($arrUserInfo["userName"]){
				$userName = $arrUserInfo["userName"];
				$password = $arrUserInfo["password"];
				$blnFound = true;
			}
			//echo "user name: ". $userName;
			?>
			<?if($blnFound){?>
				document.getElementById("showPassword").innerHTML = " Password: "+ '<?echo $password?>';
				//document.getElementById("showUsername").innerHTML = "Username: " + '<?echo $userName?>';  	
			<?}?>	
		}
	</script>
</head>
<body>
	<center><h3>Enter user name or email to retrieve password.<br/>
	<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" style="margin-left: 30px;">
		<label>UserName:</label> <input type="text" id="strUserName" name="user-Name" /> <input type="submit" value="Go" />
	</form>
	<br/><br/>
	<p style="font-weight:bold;margin-left: 30px;" id="showPassword"></p>
	<p style="font-weight:bold;margin-left: 30px;" id="showUsername"></p><br/>
	<div style="margin-left: 30px;">
		<a href="admin_loginPage.php">
			<button style="padding:10px;">
	     	<b>Login Page</b>
	     	</button>
		</a>
	</div>
</body>
</html>
<?


function retrievePswrd($userNameOrEmail){
	//echo "Input value ".$userNameOrEmail;
	$connection = getConnection(RETAIL_DB);
	global $arrUserInfo;
	$strSQL = "SELECT UserName, Password
	FROM admin
	WHERE UserName = '$userNameOrEmail'";

	$rsResult = mysqli_query($connection, $strSQL);
		//echo "Query Used: ". $strSQL;
	$arrRow = mysqli_fetch_assoc($rsResult);

	if($arrRow["UserName"]){
		$arrUserInfo["password"] = $arrRow["Password"];
		$arrUserInfo["userName"] = $arrRow["UserName"];
		return true;
	}
	else{
		return false;
	}
}
?>
