<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: POST');
	header('Content-Type: multipart/form-data');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/User.php'; 

	$database = new Database();
	$conn = $database->connect();

	$user = new User($conn);

	// $data = json_decode(file_get_contents("php://input"));

	$user->cName = $_POST['cName']; 
	$user->cSurname = $_POST['cSurname'];
	$user->cEmail = $_POST['cEmail'];
	$user->cEncriptedPassword = $_POST['cEncriptedPassword'];
	$user->cAddress = $_POST['cAddress'];
	$user->dSignUpDate = $_POST['dSignUpDate'];

	if($user->create()){
		echo json_encode($user);

		// echo json_encode(
		// 	array('message' => 'User created')
		// );
	} else {
		echo json_encode(
			array('message' => 'User not created')
		);
	}