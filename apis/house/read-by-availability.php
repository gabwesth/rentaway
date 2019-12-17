<?php
	//Headers
	// header('Access-Controll-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/House.php'; 


	$database = new Database();
	$conn = $database->connect();

	$house = new House($conn);

	$in = isset($_GET['in']) ? $_GET['in'] : die();
	$out = isset($_GET['out']) ? $_GET['out'] : die();
	$city = isset($_GET['city']) ? $_GET['city'] : die();

	$result = $house->read_by_availability($in, $out, $city);

	$num = $result->rowCount();


	
	if($num > 0){
		$house_arr = array();
		$house_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$house_item = array(
				'nHouseID' => $nHouseID,
				'cName' => $cName,
				'cDescription' => $cDescription,
				'nSqm' => $nSqm,
				'nCapacity' => $nCapacity,
				'cCity' => $cCity,
				'cAddress' => $cAddress,
				'nPricePerDay' => $nPricePerDay,
			);
			
			array_push($house_arr['data'], $house_item);
		}
		 echo json_encode($house_arr);
	} else {
		echo 'no houses';
	}