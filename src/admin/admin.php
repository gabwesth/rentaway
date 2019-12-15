<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- <link rel="stylesheet" href="../house/house.css">
	<link rel="stylesheet" href="../reservation/reservation.css"> -->
	<title>Document</title>
</head>
<body>

	<div w3-include-html="../house/house.php"></div> 
	<br>
	<div w3-include-html="../reservation/reservation.php"></div> 
	<br>
	<div w3-include-html="../user/user.php"></div> 

	<!--  ****************************************** JS ****************************************** -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../house/house.js"></script>
	<script src="../reservation/reservation.js"></script>
	<script src="../user/user.js"></script>
	<script src="../include.js"></script>
	<script>includeHTML();</script>

</body>
</html>