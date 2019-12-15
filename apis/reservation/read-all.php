<?php
	// Headers
	// header('Access-Controll-Allow-Origin: *');
	// header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/Reservation.php'; 


	$database = new Database();
	$conn = $database->connect();

	$reservation = new Reservation($conn);

	$result = $reservation->read_all();

	// $num = $result->rowCount();

	// if($num > 0){
	// 	$reservation_arr = array();
	// 	$reservation_arr['data'] = array();

	// 	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	// 		extract($row);

	// 		$reservation_item = array(
	// 			'nHouseID' => $nHouseID,
	// 			'nUserID' => $nUserID,
	// 			'dCreationDate' => $dCreationDate,
	// 			'dChekin' => $dChekin,
	// 			'dChekout' => $dChekout,
	// 			'nTotalPrice' => $nTotalPrice,
	// 			'nCreditcardID' => $nCreditcardID 
	// 		);
			
	// 		array_push($reservation_arr['data'], $reservation_item);
	// 	}
	// 	 echo json_encode($reservation_arr);
	// } else {
	// 	echo 'no reservations';
	// }
