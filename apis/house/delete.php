<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: DELETE');
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

	if($house->delete()){
		echo json_encode(
			array('message' => 'House deleted')
		);
	} else {
		echo json_encode(
			array('message' => 'House not deleted')
		);
	}