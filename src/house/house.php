<?php 
	include_once '../../apis/house/read-all.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../house/house.css">
	<title>Document</title>
</head>
<body>

<h1>houses</h1>
	<div>
		<table id='house-list'>
			<tr>
				<th>nHouseID</th>
				<th>cName</th>
				<th>cDescription</th>
				<th>nSqm</th>
				<th>nCapacity</th>
				<th>cCity</th>
				<th>cAddress</th>
				<th>nPricePerDay</th>
			</tr>
			<?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
			<tr id=H-<?=$row['nHouseID']?> >
				<td><?=$row['nHouseID']?></td>
				<td><?=$row['cName']?></td>
				<td><?=$row['cDescription']?></td>
				<td><?=$row['nSqm']?></td>
				<td><?=$row['nCapacity']?></td>
				<td><?=$row['cCity']?></td>
				<td><?=$row['cAddress']?></td>
				<td><?=$row['nPricePerDay']?></td>
				<td><button id='deleteHouse' class="button" value="<?=$row['nHouseID']?>"> Delete </button></td>
				<td><button id='updateHouse' class="button" value="<?=$row['nHouseID']?>"> Update </button></td>

			</tr>
			<?php endwhile; ?>
		</table>
	</div>


	<!--  ****************************************** Content ****************************************** -->
	<br>
	<div class="addNewHouse">
		<div class="group">
			<label class="label">Name</label>
			<input id='newName' name="newName" type="text" class="input" require>
		</div>
		<div class="group">
			<label class="label">Description</label>
			<input id='newDescription' name="newDescription" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">SQM</label>
			<input id='newSqm' name="newSqm" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Capacity</label>
			<input id='newCapacity' name="newCapacity" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">City</label>
			<input id='newCity' name='newCity' type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Address</label>
			<input id='newAddress' name='newAddress' type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Price per day</label>
			<input id='newPricePerDay' name='newPricePerDay' type="text" class="input" required>
		</div>
		<div class="group">
			<button id='createHouse' type="submit" class="button"> Add Property </button>
		</div>
		<div class="group">
			<button id='confirmHouseUpdate' type="submit" class="button" value=""> Confirm Update </button>
		</div>
	</div>



	<!--  ****************************************** JS ****************************************** -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="house.js"></script>
</body>
</html>