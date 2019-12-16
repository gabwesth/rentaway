<?php
class User{
	private $conn;
	private $table = 'user';

	//properties
	public $nUserID;
	public $cName;
	public $cSurname;
	public $cEmail;
	public $cEncriptedPassword;
	public $cAddress;
	public $dSignUpDate;
	public $nTotalAmountSpent;

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

	public function read_by_name($name){
		$query = "SELECT * FROM $this->table
				WHERE cName LIKE '%$name%' OR cSurname LIKE '%$name%'"; 
		$stmt = $this->conn->prepare($query); 
		$stmt->execute(); 
		return $stmt;
	}

	public function create(){
		$query = "call sp_create_user(
			:cName,
			:cSurname,
			:cEmail,
			:cEncriptedPassword,
			:cAddress,
			:dSignUpDate,
			:nTotalAmountSpent)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':cName', $this->cName);
		$stmt->bindParam(':cSurname', $this->cSurname);
		$stmt->bindParam(':cEmail', $this->cEmail);
		$stmt->bindParam(':cEncriptedPassword', $this->cEncriptedPassword);
		$stmt->bindParam(':cAddress', $this->cAddress);
		$stmt->bindParam(':dSignUpDate', $this->dSignUpDate);
		$stmt->bindParam(':nTotalAmountSpent', $this->nTotalAmountSpent);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function update(){
		$query = "call sp_update_user(
			:cName,
			:cSurname,
			:cEmail,
			:cEncriptedPassword,
			:cAddress,
			:nTotalAmountSpent,
			:nUserID)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':cName', $this->cName);
		$stmt->bindParam(':cSurname', $this->cSurname);
		$stmt->bindParam(':cEmail', $this->cEmail);
		$stmt->bindParam(':cEncriptedPassword', $this->cEncriptedPassword);
		$stmt->bindParam(':cAddress', $this->cAddress);
		$stmt->bindParam(':nTotalAmountSpent', $this->nTotalAmountSpent);

		$stmt->bindParam(':nUserID', $this->nUserID);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM $this->table WHERE nUserID = :nUserID";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nUserID', $this->nUserID);

		if($stmt->execute()){
			return true;
		}

		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function update_totalAmountSpent($nTotalPrice){
		$query = "CALL sp_update_totalAmountSpent_user(:nTotalPrice, :nUserID);";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nTotalPrice', $nTotalPrice);
		$stmt->bindParam(':nUserID', $this->nUserID);
		if($stmt->execute()){
			return true;
		}
		// printf("Error: %s.\n", $stmt->error);
		// return false;
	}

}