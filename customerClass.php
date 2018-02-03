<?php
include_once("connection.php");
include_once("constant.php");

	class customer {

		var $intCustomerID;
		var $strFirstName;
		var $strLastName;
		var $strEmail;
		var $strPhoneNumber;
		var $strAddress;
		var $strCountry;
		var $connection;	
		//var $arrProducts;

		// constructor with an empty default parameter
		public function __construct($intCustomerID = ""){ 
			$this->intCustomerID = $intCustomerID;
			$this->connection = getConnection(RETAIL_DB);
		}

		public function getCustomerByID($intCustomerID){
			$arrReturn = array();
			

			$strSQL = "SELECT * FROM tblCustomer
						WHERE customerID = ". $intCustomerID;

			$rsResult = mysqli_query($this->connection, $strSQL);

			while($arrRow = mysqli_fetch_assoc($rsResult)){
				$arrReturn[$arrRow["customerID"]] = $arrRow;
			}

			return $arrReturn;			
		}

		public function deleteCustomer(){
			

			$strSQL = "DELETE FROM tblCustomer WHERE CustomerID = $this->intCustomerID";

			$rsResult = mysqli_query($this->connection, $strSQL);

			//echo "Query: ". $strSQL;
		}

		public function getAllCustomers(){
			$arrReturn = array();
			

			$strSQL = "SELECT CustomerID, CONCAT(FirstName, ' ', LastName) AS Name, Email, PhoneNumber, Address, 
			 			Country FROM tblCustomer";

			$rsResult = mysqli_query($this->connection, $strSQL);

			while($arrRow = mysqli_fetch_assoc($rsResult)){
				$arrReturn[$arrRow["CustomerID"]] = $arrRow;
			}

			return $arrReturn;		
		}

		public function setFirstName($strName){
			$this->strFirstName = $strName;
		}

		public function setLastName($strName){
			$this->strLastName = $strName;
		}

		public function setEmail($strEmail){
			$this->strEmail = $strEmail;
		}

		public function setPhoneNumber($strPhoneNumber){
			$this->strPhoneNumber = $strPhoneNumber;
		}

		public function setHomeAddress($strAddress){
			$this->strAddress = $strAddress;
		}

		public function setCountry($strCountry){
			$this->strCountry = $strCountry;
		}

		//=============================================

		public function getFirstName(){
			return ($this->strFirstName);
		}

		public function getLastName(){
			return ($this->strLastName);
		}

		public function getEmail(){
			return ($this->strEmail);
		}

		public function getPhoneNumber(){
			return ($this->strPhoneNumber);
		}

		public function getHomeAddress(){
			return ($this->strAddress);
		}

		public function getCountry(){
			return($this->strCountry);
		}

		public function insertCustomer(){
			
			$strFirstName = $this->getFirstName();
			$strLastName = $this->getLastName();
			$strEmail = $this->getEmail();
			$strPhoneNumber = $this->getPhoneNumber();
			$strAddress = $this->getHomeAddress();
			$strCountry = $this->getCountry();

			$strSQL = "INSERT INTO tblCustomer
						(FirstName, LastName, Email, PhoneNumber, Address, Country)	
						VALUES ('$strFirstName', '$strLastName', '$strEmail', '$strPhoneNumber', '$strAddress', '$strCountry')";

			$rsResult = mysqli_query($this->connection, $strSQL);	

			// if($rsResult){
			// 	echo "Product successfully Created";
			// }
		}
		
	}

?>