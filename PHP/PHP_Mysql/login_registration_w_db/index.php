<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Registration Assignment</title>
    <meta charset='UTF-8' />
    <meta name='description' content='Login Registration' />
    <meta name="author" content="Jose Lechuga">
    <link rel='stylesheet' type='text/css' href='css/style.css'/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div id='container'>
    <h2>Please log in or register</h2>

    <!-- display any errors -->
    <div class='messages'>
        <?php
        if(isset($_SESSION['errors'])) {
            foreach($_SESSION['errors'] as $error) {
                echo "<p class='error'>" . $error . "</p>";
            }
            unset($_SESSION['errors']);
        }
        if(isset($_SESSION['registered'])) {
            echo "<p class='registered'>" . $_SESSION['registered'] . "</p>";
            unset($_SESSION['registered']);
        }
        ?>
    </div>

    <!--save first/last name & email values so user does not have to retype if there are errors in some fields but not all -->
    <?php
    if(isset($_SESSION['first_name'])) {
        $first_value = $_SESSION['first_name'];
    }
    if(!isset($_SESSION['first_name'])) {
        $first_value = '';
    }
    if(isset($_SESSION['last_name'])) {
        $last_value = $_SESSION['last_name'];
    }
    if(!isset($_SESSION['last_name'])) {
        $last_value = '';
    }
    if(isset($_SESSION['email'])) {
        $email_value = $_SESSION['email'];
    }
    if(!isset($_SESSION['email'])) {
        $email_value = '';
    }
    ?>

    <!-- login -->
    <form action='process.php' method='post'>
        <h3>Log In</h3>
        <div class='required'>
            <label for='email'>Email:</label>
            <input type='text' name='email' />
        </div>
        <div class='required'>
            <label for='password'>Password:</label>
            <input type='password' name='password' />
        </div>
        <input type='submit' name='login' value='Login' />
        <input type='hidden' name='action' value='login' />
    </form>

    <!-- register -->
    <form class = 'register' action='process.php' method = 'post'>
        <h3>Register</h3>
        <div class='required'>
            <label for='first_name'>First name:</label>
            <input type='text' name='first_name' value='<?= $first_value ?>'/>
        </div>
        <div class='required'>
            <label for='last_name'>Last name:</label>
            <input type='text' name='last_name' value='<?= $last_value ?>'/>
        </div>
        <div class='required'>
            <label for='email'>Email:</label>
            <input type='text' name='email' value='<?= $email_value ?>'/>
        </div>
        <div class='required'>
            <label for='password'>Password:</label>
            <input type='password' name='password'/>
        </div>
        <div class='required'>
            <label for='confirm-password'>Confirm password:</label>
            <input type='password' name='confirm-password'/>
        </div>
        <input type='submit' name='register' value='Register'/>
        <input type='hidden' name='action' value='register'/>
    </form>

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
