<?php
	session_start();
	//session_destroy();
	//var_dump($_SESSION);
	if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"]))
	{
		echo "<div class='errors'>";
		foreach($_SESSION["errors"] as $error)
		{
			echo "<p>" . $error . "</p>";
		}
		echo "</div>";
	}
	else if(isset($_SESSION["success"]))
	{
		echo "<div class='success'>" . $_SESSION["success"] . "</div>";
	}
?>

<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="RWD">
        <meta name="author" content="Jose Lechuga">
		<title>Registration without DB</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css.php">
	</head>
	<body>
		<div class="container">
			<h1>Register</h1>
			<form action="process.php" method="post" enctype = "multipart/form-data">
				<input type="hidden" name="action" value="registration">
				<div class="description">
					<p>Email*:</p>
					<p>First Name*:</p>
					<p>Last Name*:</p>
					<p>Password*:</p>
					<p>Confirm Password*:</p>
					<p>Birth Date:</p>
					<p>Profile Picture (optional):</p>
				</div>
				<div class="input">
					<input class="email" type="text" name="email">
					<input class="firstname" type="text" name="first_name">
					<input class="lastname" type="text" name="last_name">
					<input class="password" type="password" name="password">
					<input class="cpassword" type="password" name="c_password">
					<input class="birthdate" type="text" name="birthdate" placeholder="MM/DD/YYYY">
					<input type="file" accept="image/*" name="profilepic">
					<input type="submit" value="Register">
				</div>
			</form>
		</div>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>