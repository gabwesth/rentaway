<?php
	//Headers
	// header('Access-Controll-Allow-Origin: *');
	// header('Content-Type: application/json');

	include_once '../../config/database.php';
	include_once '../../models/User.php'; 


	$database = new Database();
	$conn = $database->connect();

	$user = new User($conn);

	$result = $user->read_all();


	// $num = $result->rowCount();

	// if($num > 0){
	// 	$user_arr = array();
	// 	$user_arr['data'] = array();

	// 	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	// 		extract($row);

	// 		$user_item = array(
	// 			'nUserID' => $nUserID,
	// 			'cName' => $cName,
	// 			'cSurname' => $cSurname,
	// 			'cEmail' => $cEmail,
	// 			'cEncriptedPassword' => $cEncriptedPassword,
	// 			'cAddress' => $cAddress,
	// 			'dSignUpDate' => $dSignUpDate,
	// 			'nTotalAmountSpent' => $nTotalAmountSpent
	// 		);
			
	// 		array_push($user_arr['data'], $user_item);
	// 	}
	// 	 echo json_encode($user_arr);
	// } else {
	// 	echo 'no users';
	// }
