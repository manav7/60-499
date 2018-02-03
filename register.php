<?php
include("connection.php");
include("constant.php");

$conn = getConnection(RETAIL_DB);

    function died($error) {
        
        echo "<script>alert('We are very sorry, but there were error(s) found with the form you submitted.!');</script> ";
        echo "<script>alert('These errors appear below.');</script> <br /><br />";
        echo "<script>alert('$error');</script><br /><br />";
        echo "<script>alert('$Please go back and fix these errors.');</script><br /><br />";
        die();
    }
	// validation expected data exists
	if( isset($_POST['submit']) )
	{
			if(!isset($_POST['FirstName']) ||
			   !isset($_POST['SecondName']) ||
				!isset($_POST['Email']) || 
				!isset($_POST['Username'])  ||
                !isset($_POST['Password']) ||
                !isset($_POST['Phonenumber']) ||
                !isset($_POST['Address']) ||
                !isset($_POST['Country']))
				{
					  died('We are sorry, but there appears to be a problem with the form you 
			submitted.'); 

				}	
	}
	
	

		$FirstName = $_POST['FirstName'];
		$SecondName = $_POST['SecondName'];
		$Email = $_POST['Email'];
		$Username = $_POST['Username']; // required
		$password = $_POST['Password']; // required
		$Phonenumber = $_POST['Phonenumber'];
		$Address = $_POST['Address'];
		$Country = $_POST['Country'];
		
	
	  
		
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		if(!preg_match($email_exp,$email)) 
		{
			$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
		}
		
		/*if(strlen($error_message) > 0) {
    	die($error_message);
  }*/
  
//var_dump($_POST);


$sql = "INSERT INTO tblusers (Username, Password)
VALUES ('$Username', '$password')";

$result = mysqli_query($conn, $sql);

$variable = mysqli_insert_id($conn);

$sql1 = "INSERT INTO tblcustomer ( CustomerID, FirstName, LastName, Email, PhoneNumber, Address, Country)
VALUES ($variable, '$FirstName', '$SecondName', '$Email', '$Phonenumber', '$Address', '$Country')";

$result1 = mysqli_query($conn, $sql1);


if ( $result && $result1 ) {
    echo "ACCOUNT SUCCESSFULLY CREATED<br>";
	echo "Page redirect in 5 seconds back to menu<br>";
	header('Refresh: 5; URL=index.html');
} else {
    echo $conn->error;
}


 
  
  
  
  ?>