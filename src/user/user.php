<?php 
	include_once '../../apis/user/read-all.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../user/user.css">
	<title>Document</title>
</head>
<body>

<h1>Users</h1>
Search <input type="text" name="name-filter" id="name-filter">
	<div>
		<table id='user-list'>
			<tr>
				<th>nUserID</th>
				<th>cName</th>
				<th>cSurname</th>
				<th>cEmail</th>
				<th>cEncriptedPassword</th>
				<th>cAddress</th>
				<th>dSignUpDate</th>
				<th>nTotalAmountSpent</th>
			</tr>
			<?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
			<tr id=U-<?=$row['nUserID']?> >
				<td><?=$row['nUserID']?></td>
				<td><?=$row['cName']?></td>
				<td><?=$row['cSurname']?></td>
				<td><?=$row['cEmail']?></td>
				<td><?=$row['cEncriptedPassword']?></td>
				<td><?=$row['cAddress']?></td>
				<td><?=$row['dSignUpDate']?></td>
				<td><?=$row['nTotalAmountSpent']?></td>
				<td><button id='deleteUser' class="button" value="<?=$row['nUserID']?>"> Delete </button></td>
				<td><button id='updateUser' class="button" value="<?=$row['nUserID']?>"> Update </button></td>

			</tr>
			<?php endwhile; ?>
		</table>
	</div>


	<!--  ****************************************** Content ****************************************** -->
	<br>
	<div class="addNewUser">
		<div class="group">
			<label class="label">Name</label>
			<input id='newUserName' name="newUserName" type="text" class="input" require>
		</div>
		<div class="group">
			<label class="label">Surname</label>
			<input id='newSurname' name="newSurname" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Email</label>
			<input id='newEmail' name="newEmail" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">EncriptedPassword</label>
			<input id='newEncriptedPassword' name="newEncriptedPassword" type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">Address</label>
			<input id='newUserAddress' name='newUserAddress' type="text" class="input" required>
		</div>
		<div class="group">
			<label class="label">TotalAmountSpent</label>
			<input id='newTotalAmountSpent' name='newTotalAmountSpent' type="text" class="input" required>
		</div>
		<div class="group">
			<button id='createUser' type="submit" class="button"> Add User </button>
		</div>
		<div class="group">
			<button id='confirmUserUpdate' type="submit" class="button" value=""> Confirm Update </button>
		</div>
	</div>



	<!--  ****************************************** JS ****************************************** -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="user.js"></script>
</body>
</html>