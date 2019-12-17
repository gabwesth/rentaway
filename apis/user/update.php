<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: PUT');
	header('Content-Type: application/json');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/User.php'; 

	$database = new Database();
	$conn = $database->connect();

	$user = new User($conn);

	$data = json_decode(file_get_contents("php://input"));

	$user->nUserID = $data->nUserID; 
	$user->cName = $data->cName; 
	$user->cSurname = $data->cSurname;
	$user->cPhoneNumber = $data->cPhoneNumber;
	$user->cEmail = $data->cEmail;
	$user->cEncriptedPassword = $data->cEncriptedPassword;
	$user->cAddress = $data->cAddress;
	$user->nTotalAmountSpent = $data->nTotalAmountSpent;
	
	if($user->update()){
		echo json_encode(
			array('message' => 'User updated')
		);
	} else {
		echo json_encode(
			array('message' => 'User not updated')
		);
	}