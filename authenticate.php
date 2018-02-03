<?php
include("connection.php");
$connection = getConnection(RETAIL_DB);
session_start();
	$username = $_POST["inputUserName"];
	$password = $_POST["inputPassword"];
	//var_dump($_POST);
	if($_POST){
		$strSQL = "SELECT * FROM admin
					JOIN tblRoleXF
					ON (tblRoleXF.userID = admin.ID)
					JOIN tblUserRole
					ON (tblUserRole.ID = tblRoleXF.roleID)
					WHERE Username = '$username'  AND Password = '$password'
					AND RoleName = 'Web_Admin'";

		$rsResult = mysqli_query($connection, $strSQL);
		//echo "Query Used: ". $strSQL;
		$arrRow = mysqli_fetch_assoc($rsResult);

		if(!$arrRow["ID"]){
			header("Location: http://localhost/499_Project/admin_loginPage.php?blnError=1");
		}
		else{
			setcookie("intUserID", $arrRow["intUserID"]);
			//setcookie("blnAuthenticated", 1);
			$_SESSION["blnAuthenticated"] = 1; 
			header("Location: http://localhost/499_Project/AdminPage.php");
		}				
		
	}
?>