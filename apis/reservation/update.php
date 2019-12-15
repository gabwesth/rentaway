<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: PUT');
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
	$reservation->nHouseID = $data->nHouseID;
	$reservation->nUserID = $data->nUserID;
	$reservation->dChekin = $data->dChekin;
	$reservation->dChekout = $data->dChekout;
	$reservation->nTotalPrice = $data->nTotalPrice;

	// echo json_encode($reservation);

	if($reservation->update()){
		echo json_encode(
			array('message' => 'Reservation updated')
		);
	} else {
		echo json_encode(
			array('message' => 'Reservation not updated')
		);
	}