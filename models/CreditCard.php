<?php
class CreditCard{
	private $conn;
	private $table = 'creditcard';

	//properties
	public $nCreditcardID;
	public $cNameOnCard;
	public $cCardNumber;
	public $nExpMonth;
	public $nExpYear;
	public $nSecurityCode;
	public $nTotalAmountSpent;
	public $nUserID;

	//constructor
	public function __construct($db) {
		$this->conn = $db;
	}
	
	public function read_all(){
		$query = "SELECT * FROM $this->table"; 
		$stmt = $this->conn->prepare($query); 
		$stmt->execute(); 
		return $stmt;
	}

	public function read_by_user_id($userID){
		$query = "SELECT * FROM $this->table
			WHERE nUserID = $userID"; 
		$stmt = $this->conn->prepare($query); 
		$stmt->execute(); 
		return $stmt;
	}

	public function create(){
		$query = "CALL `sp_create_creditcard`(
			:cNameOnCard,
			:cCardNumber,
			:nExpMonth,
			:nExpYear,
			:nSecurityCode,
			0,
			:nUserID
		)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':cNameOnCard', $this->cNameOnCard);
		$stmt->bindParam(':cCardNumber', $this->cCardNumber);
		$stmt->bindParam(':nExpMonth', $this->nExpMonth);
		$stmt->bindParam(':nExpYear', $this->nExpYear);
		$stmt->bindParam(':nSecurityCode', $this->nSecurityCode);
		$stmt->bindParam(':nUserID', $this->nUserID);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	// public function update(){
	// 	$query = "UPDATE $this->table
	// 	 SET 
	// 		cNameOnCard = :cNameOnCard,
	// 		cCardNumber = :cCardNumber,
	// 		nExpMonth = :nExpMonth,
	// 		nExpYear = :nExpYear,
	// 		nSecurityCode = :nSecurityCode,
	// 		nTotalAmountSpent = :nTotalAmountSpent
	// 	WHERE
	// 		nCreditcardID = :nCreditcardID";
	// 	$stmt = $this->conn->prepare($query);

	// 	echo $query;

	// 	$stmt->bindParam(':nCreditcardID', $this->nCreditcardID);
	// 	$stmt->bindParam(':cNameOnCard', $this->cNameOnCard);
	// 	$stmt->bindParam(':cCardNumber', $this->cCardNumber);
	// 	$stmt->bindParam(':nExpMonth', $this->nExpMonth);
	// 	$stmt->bindParam(':nExpYear', $this->nExpYear);
	// 	$stmt->bindParam(':nSecurityCode', $this->nSecurityCode);
	// 	$stmt->bindParam(':nTotalAmountSpent', $this->nTotalAmountSpent);

	// 	if($stmt->execute()){
	// 		return true;
	// 	}
	// 	printf("Error: %s.\n", $stmt->error);
	// 	return false;
	// }

	// public function delete(){
	// 	$query = "DELETE FROM $this->table WHERE nUserID = :nUserID";

	// 	$stmt = $this->conn->prepare($query);

	// 	$stmt->bindParam(':nUserID', $this->nUserID);

	// 	if($stmt->execute()){
	// 		return true;
	// 	}

	// 	printf("Error: %s.\n", $stmt->error);
	// 	return false;
	// }

	public function update_totalAmountSpent($nTotalPrice){
		echo $nTotalPrice;
		$query = "CALL sp_update_totalAmountSpent_creditCard(:nTotalPrice, :nCreditcardID);";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nTotalPrice', $nTotalPrice);
		$stmt->bindParam(':nCreditcardID', $this->nCreditcardID);
		if($stmt->execute()){
			return true;
		}
		// printf("Error: %s.\n", $stmt->error);
		// return false;
	}

}