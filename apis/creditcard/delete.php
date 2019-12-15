<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: DELETE');
	header('Content-Type: application/json');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/CreditCard.php'; 

	$database = new Database();
	$conn = $database->connect();

	$creditCard = new CreditCard($conn);

	$data = json_decode(file_get_contents("php://input"));

	$creditCard->nCreditCardID = $data->nCreditCardID;

	if($creditCard->delete()){
		echo json_encode(
			array('message' => 'CreditCard deleted')
		);
	} else {
		echo json_encode(
			array('message' => 'CreditCard not deleted')
		);
	}