<?php
class Availability{
	private $conn;
	private $table = 'availability';

	//properties
	public $dFromDate;
	public $dToDate;
	public $nHouseID;

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
	
	public function create(){
		$query = "CALL sp_create_availability(:dFromDate, :dToDate, :nHouseID);";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':dFromDate', $this->dFromDate);
		$stmt->bindParam(':dToDate', $this->dToDate);
		$stmt->bindParam(':nHouseID', $this->nHouseID);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
	}

}