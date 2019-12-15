<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: PUT');
	header('Content-Type: application/json');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/House.php'; 

	$database = new Database();
	$conn = $database->connect();

	$house = new House($conn);

	$data = json_decode(file_get_contents("php://input"));

	$house->nHouseID = $data->nHouseID;
	$house->cName = $data->cName; 
	$house->cDescription = $data->cDescription;
	$house->nSqm = $data->nSqm;
	$house->nCapacity = $data->nCapacity;
	$house->cCity = $data->cCity;
	$house->cAddress = $data->cAddress;
	$house->nPricePerDay = $data->nPricePerDay;


	if($house->update()){
		echo json_encode(
			array('message' => 'House updated')
		);
	} else {
		echo json_encode(
			array('message' => 'House not updated')
		);
	}