<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: DELETE');
	header('Content-Type: application/json');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/Reservation.php'; 

	$database = new Database();
	$conn = $database->connect();

	$reservation = new Reservation($conn);

	$data = json_decode(file_get_contents("php://input"));

	$reservation->nReservationID = $data->nReservationID;

	if($reservation->delete()){
		echo json_encode(
			array('message' => 'Reservation deleted')
		);
	} else {
		echo json_encode(
			array('message' => 'Reservation not deleted')
		);
	}