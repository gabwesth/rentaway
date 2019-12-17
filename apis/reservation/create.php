<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Access-Controll-Allow-Methods: POST');
	header('Content-Type: multipart/form-data');
	// header('Access-Controll-Allow-Headers: Access-Controll-Allow-Headers,
	// 		Access-Controll-Allow-Methods, Content-Type, Authorization, X-Requested-With');

	include_once '../../config/database.php';
	include_once '../../models/Reservation.php'; 
	include_once '../../models/User.php'; 
	include_once '../../models/CreditCard.php'; 
	include_once '../../models/Availability.php'; 


	$database = new Database();
	$conn = $database->connect();

	$reservation = new Reservation($conn);
	$user = new User($conn);
	$credicard = new CreditCard($conn);
	$availability = new Availability($conn);

	// $data = json_decode(file_get_contents("php://input"));

	$reservation->nHouseID = $_POST['nHouseID'];
	$reservation->nUserID = $_POST['nUserID'];
	$reservation->dCreationDate = $_POST['dCreationDate'];
	$reservation->dChekin = $_POST['dChekin'];
	$reservation->dChekout = $_POST['dChekout'];
	$reservation->nTotalPrice = $_POST['nTotalPrice'];
	$reservation->nCreditcardID = $_POST['nCreditcardID'];

	$user->nUserID = $_POST['nUserID'];

	$credicard->nCreditcardID = $_POST['nCreditcardID']; 

	$availability->nHouseID = $_POST['nHouseID'];
	$availability->dFromDate = $_POST['dChekin'];
	$availability->dToDate = $_POST['dChekout'];

	try{
		
		$conn->beginTransaction();

		$reservation->create();

		$user->update_totalAmountSpent($reservation->nTotalPrice);

		$credicard->update_totalAmountSpent($reservation->nTotalPrice);

		$availability->create();

		$conn->commit();

		echo 'Reservation created';
	
	} catch(PDOException $e) {
		echo $e;
	}