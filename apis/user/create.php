<?php
	// header('Access-Controll-Allow-Origin: *');
	// header('Access-Controll-Allow-Methods: POST');
	// header('Content-Type: multipart/form-data');

	// include_once '../../config/database.php';
	// include_once '../../models/User.php'; 

	// $database = new Database();
	// $conn = $database->connect();

	// $user = new User($conn);


	// $user->cName = $_POST['cName']; 
	// $user->cSurname = $_POST['cSurname'];
	// $user->cEmail = $_POST['cEmail'];
	// $user->cEncriptedPassword = $_POST['cEncriptedPassword'];
	// $user->cAddress = $_POST['cAddress'];
	// $user->dSignUpDate = $_POST['dSignUpDate'];

	// if($user->create()){
	// 	echo json_encode($user);
	// } else {
	// 	echo json_encode(
	// 		array('message' => 'User not created')
	// 	);
	// }