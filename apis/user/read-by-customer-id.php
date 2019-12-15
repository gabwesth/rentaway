<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/User.php'; 


	$database = new Database();
	$conn = $database->connect();

	$user = new User($conn);

	$userID = isset($_GET['id']) ? $_GET['id'] : die();

	$result = $user->read_by_user_id($userID);

	if($row = $result->fetch(PDO::FETCH_ASSOC)){

		extract($row);

		$user->nUserID = $nUserID; 
		$user->cName = $cName; 
		$user->cSurname = $cSurname;
		$user->cEmail = $cEmail;
		$user->cEncriptedPassword = $cEncriptedPassword;
		$user->cAddress = $cAddress;
		$user->dSignUpDate = $dSignUpDate;
		$user->nTotalAmountSpent = $nTotalAmountSpent;
		
		echo json_encode($user);
	} else {
		echo 'No users with the given id';
	}

