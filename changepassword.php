<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Change Password</title>
	<style>
	form {
		max-width: 400px;
		margin: 0 auto;
		padding: 20px;
		background-color: #fff;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
		border-radius: 5px;
	}

	label {
		display: block;
		font-weight: bold;
		margin-bottom: 5px;
	}

	input[type="password"] {
		width: 100%;
		padding: 10px;
		margin-bottom: 15px;
		border: 1px solid #ccc;
		border-radius: 5px;
	}

	button[type="submit"] {
		background-color: #007bff;
		color: #fff;
		border: none;
		padding: 10px 20px;
		border-radius: 5px;
		cursor: pointer;
	}

	button[type="submit"]:hover {
		background-color: #0056b3;
	}
	</style>
</head>
<body>
	<h1><center>Change Password</center></h1>
	<form action="changepassdb.php" method="post">
		<label for="currentPassword">Current Password:</label>
		<input type="password" id="currentPassword" name="currentPassword" required><br>

		<label for="newPassword">New Password:</label>
		<input type="password" id="newPassword" name="newPassword" required><br>

		<label for="confirmPassword">Confirm New Password:</label>
		<input type="password" id="confirmPassword" name="confirmPassword" required><br>

		<button type="submit" name="changePassword">Change Password</button>
	</form>
</body>
</html>
