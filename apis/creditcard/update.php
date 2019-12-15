<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: PUT');
	header('Content-Type: multipart/form-data');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/CreditCard.php'; 

	$database = new Database();
	$conn = $database->connect();

	$creditCard = new CreditCard($conn);

	// $data = json_decode(file_get_contents("php://input"));

	$creditCard->nCreditcardID = $_POST['nCreditcardID'];
	$creditCard->cNameOnCard = $_POST['cNameOnCard']; 
	$creditCard->cCardNumber = $_POST['cCardNumber'];
	$creditCard->nExpMonth = $_POST['nExpMonth'];
	$creditCard->nExpYear = $_POST['nExpYear'];
	$creditCard->nSecurityCode = $_POST['nSecurityCode'];
	$creditCard->nTotalAmountSpent = $_POST['nTotalAmountSpent'];

	if($creditCard->update()){
		echo json_encode(
			array('message' => 'CreditCard updated')
		);
	} else {
		echo json_encode(
			array('message' => 'CreditCard not updated')
		);
	}