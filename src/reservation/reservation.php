<?php 
	include_once '../../apis/reservation/read-all.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../reservation/reservation.css">
	<title>Document</title>
</head>
<body>

<h1>Reservations</h1>
	<div>
		<table id='house-list'>
			<tr>
				<th>nReservationID</th>
				<th>nHouseID</th>
				<th>nUserID</th>
				<th>dCreationDate</th>
				<th>dChekin</th>
				<th>dChekout</th>
				<th>nTotalPrice</th>
				<th>nCreditcardID</th>
			</tr>
			<?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
			<tr id=R-<?=$row['nReservationID']?> >
				<td><?=$row['nReservationID']?></td>
				<td><?=$row['nHouseID']?></td>
				<td><?=$row['nUserID']?></td>
				<td><?=$row['dCreationDate']?></td>
				<td><?=$row['dChekin']?></td>
				<td><?=$row['dChekout']?></td>
				<td><?=$row['nTotalPrice']?></td>
				<td><?=$row['nCreditcardID']?></td>
				<td><button id='deleteReservation' class="button" value="<?=$row['nReservationID']?>"> Delete </button></td>
				<td><button id='updateReservation' class="button" value="<?=$row['nReservationID']?>"> Update </button></td>

			</tr>
			<?php endwhile; ?>
		</table>
	</div>


	<!--  ****************************************** Content ****************************************** -->
	<br>
	<div class="addNewHouse">
		<div class="group">
			<label class="label">HouseID</label>
			<input id='newHouseID' name="newHouseID" type="text" class="input" require>
		</div>
		<div class="group">
			<label class="label">userID</label>
			<input id='newUserID' name="newUserID" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Chekin</label>
			<input id='newCheckin' name="newCheckin" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Chekout</label>
			<input id='newCheckout' name='newCheckout' type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">TotalPrice</label>
			<input id='newTotalPrice' name='newTotalPrice' type="text" class="input" required>
		</div>
		<!-- <div class="group">
			<button id='createReservation' type="submit" class="button"> Add Reservation </button>
		</div> -->
		<div class="group">
			<button id='confirmReservationUpdate' type="submit" class="button" value=""> Confirm Update </button>
		</div>
	</div>



	<!--  ****************************************** JS ****************************************** -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="reservation.js"></script>
</body>
</html>