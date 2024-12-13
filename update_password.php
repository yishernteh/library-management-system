<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>

	<style type="text/css">
		body {
			height: 650px;
			background-image: url("images/10.jpg");
			background-repeat: no-repeat;
		}		
		.wrapper {
			width: 400px;
			height: 450px;
			margin: 100px auto;
			background-color: black;
			opacity: .8;
			color: white;
			padding: 27px 15px;
		}
		.form-control {
			width: 300px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div style="text-align: center;">
			<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Change Your Password</h1>
		</div>
		<div style="padding-left: 30px;">
			<form action="" method="post">
				<select name="user_type" class="form-control" required>
					<option value="" disabled selected>Select User Type</option>
					<option value="admin">Admin</option>
					<option value="student">Student</option>
				</select><br>
				<input type="text" name="username" class="form-control" placeholder="Username" required><br>
				<input type="text" name="email" class="form-control" placeholder="Email" required><br>
				<input type="text" name="password" class="form-control" placeholder="New Password" required><br>
				<button class="btn btn-default" type="submit" name="submit">Update</button>
			</form>
		</div>
	</div>

	<?php
		if (isset($_POST['submit'])) {
			// Sanitize user inputs
			$user_type = mysqli_real_escape_string($db, $_POST['user_type']);
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$password = mysqli_real_escape_string($db, $_POST['password']);

			// Determine table based on user type
			$table = ($user_type == 'admin') ? 'admin' : 'student';

			// Run the UPDATE query
			$query = "UPDATE $table SET password='$password' WHERE username='$username' AND email='$email'";
			mysqli_query($db, $query);

			// Check if any rows were affected
			if (mysqli_affected_rows($db) > 0) {
				echo '<script type="text/javascript">alert("The Password Updated Successfully");</script>';
			} else {
				echo '<script type="text/javascript">alert("Password not updated. Username or email not found.");</script>';
			}
		}
	?>
</body>
</html>
