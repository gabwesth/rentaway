<?php 
	include_once '../../apis/house/read-all.php';
	session_start();
	if(!$_SESSION){
		echo "<a href='http://localhost:8888/rentaway/src/log-in/login.php'><label class='label'>LOG IN</label></a>";
	}
	else{
		$user = $_SESSION['jUser'];
		$userID = $_SESSION['key'];
		echo "<a href='http://localhost:8888/rentaway/apis/api-logout.php'><label class='label'>LOG OUT</label></a>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="home-page.css">
	<title>Document</title>
</head>
<body>

<div id="user" data-value='<?=$userID?>'><?=$user['cName'].' '.$user['cSurname']?></div>
<h1>houses</h1>
<div class="filter-date">
	From <input id='from' type="date" value="2019-12-08">
	To <input id='to' type="date" value="2019-12-09">
	<button id='search'>search</button>
</div>
<br>
<div>
	<table id='filtered-list' style="display: none">
		<tr>
			<th>cName</th>
			<th>cDescription</th>
			<th>nSqm</th>
			<th>nCapacity</th>
			<th>cCity</th>
			<th>cAddress</th>
			<th>nPricePerDay</th>
		</tr>
	</table>
</div>

<div id="confirmation-modal" class="modal">

	<!-- Modal content -->
	<div class="modal-content">
		<span class="close">&times;</span>
		<table id='confirm-house'>
			<tr>
				<th>cName</th>
				<th>cDescription</th>
				<th>nSqm</th>
				<th>nCapacity</th>
				<th>cCity</th>
				<th>cAddress</th>
				<th>nPricePerDay</th>
			</tr>
		</table>
		<br>
		<table id='confirm-price'>
			<tr>
				<th>Check In</th>
				<th>Check Out</th>
				<th>Total Price</th>
			</tr>
		</table>
		<p>choose payment method</p>
		<select id="creditCard">
			<option value="new"> ADD NEW CARD </option>
		</select>

		<form id="addNewCard">
			<p> Insert card information </p>
			<input id="cNameOnCard" name="cNameOnCard" type="text" placeholder="Name">
			<input name="cCardNumber" type="text" placeholder="Number">
			<input name="nExpMonth" type="text" placeholder="ExpMonth">
			<input name="nExpYear" type="text" placeholder="ExpYear">
			<input name="nSecurityCode" type="text" placeholder="Security Code">
			<input name="nUserID" type="text" value="<?=$userID?>" hidden>
			<button type="submit">ADD</button>
		</form>

		<p>confirm booking?</p>
		<button id="confirmBooking">CONFIRM</button>
	</div>

</div>


	<!--  ****************************************** JS ****************************************** -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="home-page.js"></script>
</body>
</html>