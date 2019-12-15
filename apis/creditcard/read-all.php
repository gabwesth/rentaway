<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/CreditCard.php'; 


	$database = new Database();
	$conn = $database->connect();

	$creditCard = new CreditCard($conn);

	$result = $creditCard->read_all();

	$num = $result->rowCount();

	if($num > 0){
		$creditCard_arr = array();
		$creditCard_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$creditCard_item = array(
				'nCreditcardID' => $nCreditcardID,
				'cNameOnCard' => $cNameOnCard, 
				'cCardNumber' => $cCardNumber,
				'nExpMonth' => $nExpMonth,
				'nExpYear' => $nExpYear,
				'nSecurityCode' => $nSecurityCode,
				'nTotalAmountSpent' => $nTotalAmountSpent
			);
			
			array_push($creditCard_arr['data'], $creditCard_item);
		}
		 echo json_encode($creditCard_arr);
	} else {
		echo 'no creditCards';
	}

