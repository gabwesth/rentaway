<?php
	//Headers
	header('Access-Controll-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/House.php'; 


	$database = new Database();
	$conn = $database->connect();

	$house = new House($conn);

	$result = $house->read_cities();

	$num = $result->rowCount();

	
	if($num > 0){
		$cities_arr = array();
		$cities_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$city = $cCity;
			
			array_push($cities_arr['data'], $city);
		}
		 echo json_encode($cities_arr);
	} else {
		echo 'no citiess';
	}
