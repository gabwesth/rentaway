<?php
	//Headers
	// header('Access-Controll-Allow-Origin: *');
	// header('Content-Type: application/json');

	// include_once '../../config/database.php';
	// include_once '../../models/House.php'; 


	// $database = new Database();
	// $conn = $database->connect();

	// $house = new House($conn);

	// $result = $house->read_all();

	// $num = $result->rowCount();

	// if($num > 0){
	// 	$house_arr = array();
	// 	$house_arr['data'] = array();

	// 	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	// 		extract($row);

	// 		$house_item = array(
	// 			'nHouseID' => $nHouseID,
	// 			'cName' => $cName,
	// 			'cDescription' => $cDescription,
	// 			'nBedrooms' => $nBedrooms,
	// 			'nBathrooms' => $nBathrooms,
	// 			'nSqm' => $nSqm,
	// 			'nCapacity' => $nCapacity,
	// 			'cCity' => $cCity,
	// 			'cAddress' => $cAddress,
	// 			'nOwnerID' => $nOwnerID
	// 		);
			
	// 		array_push($house_arr['data'], $house_item);
	// 	}
	// 	 echo json_encode($house_arr);
	// } else {
	// 	echo 'no houses';
	// }
