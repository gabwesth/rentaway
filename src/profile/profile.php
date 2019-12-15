<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="profile.css">
	<title>Document</title>
</head>
<body>

<?php
	session_start();
	$key = $_SESSION['key'];
	$jUser = $_SESSION['jUser'];
	$sName = $jUser->name;
	$sLastName = $jUser->lastName;
	$sImage = $jUser->image;
?>
		<!--  ****************************************** Navbar ****************************************** -->
	<nav>
		<div id="logo">
			<a href="http://localhost:8888/real-estate/src/home-page/home-page.php">	
				<img src="./../../assets/zillow-logo.png" class="logo">
			</a>
		</div>
	</nav>

	<!--  ****************************************** Content ****************************************** -->
	<div id="content">
		<div id="<?=$key?>" class="userInfo">
			<div class="image-container">
				<div class="avatar-upload">
					<div class="avatar-edit">
						<input name="image" type='file' id="file" accept=".png, .jpg, .jpeg"/>
						<label for="file"></label>
					</div>
					<div class="avatar-preview">
						<div id="imagePreview" style="background-image: url(<?=$sImage?>);"></div>
					</div>
				</div>
			</div>
			<!-- <input type="file" name="file" id="file" /> -->

			<input name="txtName" type="text" value="<?=$sName?>" autocomplete="off">
			<input name="txtLastName" type="text" value="<?=$sLastName?>" autocomplete="off">
			<button id="submitChanges">Save changes</button>
			<?php
				$id = $_SESSION["key"];
				if(substr($id, 0, 1) === 'A'){
				echo "<a href='http://localhost:8888/real-estate/src/properties/properties.php'><h1>MY PROPERTIES</h1></a>";
				}
			?>
			<a href="http://localhost:8888/real-estate/apis/api-logout.php"><h1>LOG OUT</h1></a>
			<a href="http://localhost:8888/real-estate/apis/api-delete-profile.php"><h1>DELETE PROFILE</h1></a>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="profile.js"></script>
</body>
</html>