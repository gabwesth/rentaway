<?php
include_once '../../apis/user/read-all.php';

session_start(); 

if( $_SESSION ){
	header('Location: ../../index.php');
}

 if ($_POST){
	// get user info
	$sEmail = $_POST['txtEmail'];
	$sPassword = $_POST['txtPassword'];

	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$user = array(
			'nUserID' => $nUserID,
			'cName' => $cName,
			'cSurname' => $cSurname,
			'cEmail' => $cEmail,
			'cEncriptedPassword' => $cEncriptedPassword,
			'cAddress' => $cAddress,
			'dSignUpDate' => $dSignUpDate,
			'nTotalAmountSpent' => $nTotalAmountSpent
		);
	
		if($user["cEmail"] === $sEmail && password_verify($sPassword, $user["cEncriptedPassword"])){
			$_SESSION['jUser'] = $user;
			$_SESSION['key'] = $user["nUserID"];
			header('Location: ../../index.php');
			exit;
		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="login.css">
	<title>Log in</title>
</head>
<body>

	<div class="container">
		<input id="tab-1" type="radio" name="tab" class="log-in-toggle" checked><label for="tab-1" class="toggle-label">Log In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up-toggle"><label for="tab-2" class="toggle-label">Sign Up</label>
		<div class="form-group">
			<form method="POST" class="log-in-form" >
				<div class="group">
					<label for="user" class="label">Email</label>
					<input name="txtEmail" id="user" type="email" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input name="txtPassword" id="pass" type="password" data-type="password" required>
				</div>
				<!-- <div class="group">
					<input name="checkAgent" id="check" type="checkbox" class="check" >
					<label for="check"> I am an agent </label>
				</div> -->
				<div class="group">
					<button type="submit"> Log In </button>
				</div>
			</form>
			<form id="agent-signup" action=../../apis/api-sign-up.php method="POST" class="sign-up-form" >
				<div class="group">
					<label for="user" class="label">Name</label>
					<input name="cName" id="user" type="text" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Last Name</label>
					<input name="cSurname" id="user" type="text" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input name="cEmail" id="pass" type="email" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input name="cEncriptedPassword" id="pass" type="password" data-type="password" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Address</label>
					<input name="cAddress" id="pass" type="text" required>
				</div>
				<div class="group">
					<button type="submit"> Sign Un </button>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$('input[type="radio"]').click(function(){
        if($(this).attr("class")=="log-in-toggle"){
            $(".sign-up-form").hide();
            $(".log-in-form").show();
        }
        if($(this).attr("class")=="sign-up-toggle"){
					$(".sign-up-form").show();
          $(".log-in-form").hide();

        }        
    });
		$('.log-in-toggle').trigger('click');
	</script>
</body>
</html>