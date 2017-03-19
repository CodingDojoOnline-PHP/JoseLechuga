<?php
session_start();
require_once('login_reg_connection.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Registration Assignment</title>
    <meta charset='UTF-8'/>
    <meta name='description' content='login registration' />
    <meta name="author" content="Jose Lechuga">
    <link rel='stylesheet' type='text/css' href='css/success.css'/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
<div id='container'>
    <div class='welcome'>
        <h1>Jose's login registration</h1>
        <h3>Welcome, <?= $_SESSION['first_name'] ?> </h3>
        <a href='process.php'>Log off</a>
    </div>
    <div class="message">
        <h1> Welcome, Thank you for trying out my login registration.</h1>
    </div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</bodY>
</html>
