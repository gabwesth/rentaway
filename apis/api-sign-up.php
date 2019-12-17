<?php
 
    if ($_POST){

			include_once '../config/database.php';
			include_once '../models/User.php'; 
		
			$database = new Database();
			$conn = $database->connect();
		
			$user = new User($conn);
			
			$password = $_POST['cEncriptedPassword'];
			$encriptedPassword = password_hash($password, PASSWORD_DEFAULT);
		
			// $data = json_decode(file_get_contents("php://input"));
		
			$user->cName = $_POST['cName']; 
			$user->cSurname = $_POST['cSurname'];
			$user->cEmail = $_POST['cEmail'];
			$user->cEncriptedPassword = $encriptedPassword;
			$user->cAddress = $_POST['cAddress'];
			$user->dSignUpDate = date("Y-m-d");


			if($user->create()){
				echo json_encode($user);
			} else {
				echo json_encode(
					array('message' => 'User not created')
				);
			}
	} // CONSIDER TO LOG IN IMMEDIATELLY
		