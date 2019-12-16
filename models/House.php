<?php
class House{
	private $conn;
	private $table = 'house';

	//properties
	public $nHouseID;
	public $cName;
	public $cDescription;
	public $nSqm;
	public $nCapacity;
	public $cCity;
	public $cAddress;
	public $nPricePerDay;

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

	public function read_by_house_id($houseID){
		$query = "SELECT * FROM $this->table
				WHERE nHouseID = $houseID"; 
		$stmt = $this->conn->prepare($query); 
		$stmt->execute(); 
		return $stmt;
	}

	public function create(){
		$query = "CALL sp_create_house(
		 	:cName,
			:cDescription,
			:nSqm,
			:nCapacity,
			:cCity,
			:cAddress,
			:nPricePerDay)";
		$stmt = $this->conn->prepare($query);

		
		$stmt->bindParam(':cName', $this->cName);
		$stmt->bindParam(':cDescription', $this->cDescription);
		$stmt->bindParam(':nSqm', $this->nSqm);
		$stmt->bindParam(':nCapacity', $this->nCapacity);
		$stmt->bindParam(':cCity', $this->cCity);
		$stmt->bindParam(':cAddress', $this->cAddress);
		$stmt->bindParam(':nPricePerDay', $this->nPricePerDay);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function update(){
		$query = "CALL sp_update_house(
			:cName,
		   :cDescription,
		   :nSqm,
		   :nCapacity,
		   :cCity,
		   :cAddress,
		   :nPricePerDay,
		   :nHouseID)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nHouseID', $this->nHouseID);
		$stmt->bindParam(':cName', $this->cName);
		$stmt->bindParam(':cDescription', $this->cDescription);
		$stmt->bindParam(':nSqm', $this->nSqm);
		$stmt->bindParam(':nCapacity', $this->nCapacity);
		$stmt->bindParam(':cCity', $this->cCity);
		$stmt->bindParam(':cAddress', $this->cAddress);
		$stmt->bindParam(':nPricePerDay', $this->nPricePerDay);


		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM $this->table WHERE nHouseID = :nHouseID";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nHouseID', $this->nHouseID);

		if($stmt->execute()){
			return true;
		}

		printf("Error: %s.\n", $stmt->error);
		return false;
	}

	public function read_by_availability($in, $out, $city){

		$end_query = ';';
		if($city !== 'everywhere'){
			$end_query = ' AND cCity = '.$city.';';
		}

		$query = "SELECT nHouseID, cName, cDescription, nSqm, nCapacity, cCity, cAddress, nPricePerDay
		FROM House
		WHERE nHouseID NOT IN (
		SELECT nHouseID FROM Availability
		WHERE '$in' BETWEEN dFromDate AND dToDate
		OR '$out' BETWEEN dFromDate AND dToDate)
		AND nHouseID NOT IN (
		SELECT nHouseID FROM Availability
		WHERE dFromDate BETWEEN '$in' AND '$out'
		OR dToDate BETWEEN '$in' AND '$out') $end_query";
		$stmt = $this->conn->prepare($query);
		$stmt->execute(); 
		return $stmt;
	}

	public function read_cities(){
		$query = "SELECT DISTINCT `cCity` FROM $this->table"; 
		$stmt = $this->conn->prepare($query); 
		$stmt->execute(); 
		return $stmt;
	}

}