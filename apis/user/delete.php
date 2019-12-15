<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: DELETE');
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

	if($user->delete()){
		echo json_encode(
			array('message' => 'User deleted')
		);
	} else {
		echo json_encode(
			array('message' => 'User not deleted')
		);
	}