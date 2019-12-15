<?php
class Reservation{
	private $conn;
	private $table = 'reservation';

	//properties
	public $nReservationID;
	public $nHouseID;
	public $nUserID;
	public $dCreationDate;
	public $dChekin;
	public $dChekout;
	public $nTotalPrice;
	public $nCreditcardID;

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
		$query = "CALL sp_create_reservation(
			:nHouseID,
			:nUserID,
			:dCreationDate,
			:dChekin,
			:dChekout,
			:nTotalPrice,
			:nCreditcardID);";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nHouseID', $this->nHouseID);
		$stmt->bindParam(':nUserID', $this->nUserID);
		$stmt->bindParam(':dCreationDate', $this->dCreationDate);
		$stmt->bindParam(':dChekin', $this->dChekin);
		$stmt->bindParam(':dChekout', $this->dChekout);
		$stmt->bindParam(':nTotalPrice', $this->nTotalPrice);
		$stmt->bindParam(':nCreditcardID', $this->nCreditcardID);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function update(){
		$query = "CALL sp_update_reservation(
			:nHouseID,
			:nUserID,
			:dChekin,
			:dChekout,
			:nTotalPrice,
			:nReservationID);";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nHouseID', $this->nHouseID);
		$stmt->bindParam(':nUserID', $this->nUserID);
		$stmt->bindParam(':dChekin', $this->dChekin);
		$stmt->bindParam(':dChekout', $this->dChekout);
		$stmt->bindParam(':nTotalPrice', $this->nTotalPrice);
		$stmt->bindParam(':nReservationID', $this->nReservationID);

		echo var_dump($stmt);
		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM $this->table WHERE nReservationID = :nReservationID";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nReservationID', $this->nReservationID);

		if($stmt->execute()){
			return true;
		}

		printf("Error: %s.\n", $stmt->error);
		return false;
	}

}