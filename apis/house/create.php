<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: POST');
	header('Content-Type: multipart/form-data');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/House.php'; 

	$database = new Database();
	$conn = $database->connect();

	$house = new House($conn);

	// $data = json_decode(file_get_contents("php://input"));

	$house->cName = $_POST['cName']; 
	$house->cDescription = $_POST['cDescription'];
	$house->nSqm = $_POST['nSqm'];
	$house->nCapacity = $_POST['nCapacity'];
	$house->cCity = $_POST['cCity'];
	$house->cAddress = $_POST['cAddress'];
	$house->nPricePerDay = $_POST['nPricePerDay'];


	if($house->create()){
		echo json_encode($house);
		// echo json_encode(
		// 	array('message' => 'House created')
		// );
	} else {
		echo json_encode(
			array('message' => 'House not created')
		);
	}