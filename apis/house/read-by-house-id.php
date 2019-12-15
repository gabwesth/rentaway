<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/House.php'; 


	$database = new Database();
	$conn = $database->connect();

	$house = new House($conn);

	$houseID = isset($_GET['id']) ? $_GET['id'] : die();

	$result = $house->read_by_house_id($houseID);

	if($row = $result->fetch(PDO::FETCH_ASSOC)){
		
		extract($row);

		$house->nHouseID = $nHouseID;
		$house->cName = $cName;
		$house->cDescription = $cDescription;
		$house->nSqm = $nSqm;
		$house->nCapacity = $nCapacity;
		$house->cCity = $cCity;
		$house->cAddress = $cAddress;
		$house->nPricePerDay = $nPricePerDay;

		 echo json_encode($house);
	} else {
		echo 'no houses';
	}
