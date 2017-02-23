<?php
 session_start();
	if(isset($_POST['action']) && $_POST['action'] == "reset"){
        session_destroy();
        header('Location: /');
    }
	if($_POST['guess'] == $_SESSION['num']){
        $_SESSION['check'] = true;
        $_SESSION['message'] = $_SESSION['num'] . " was the number!";
        $_SESSION['class'] = "green";
    } else {
        $_SESSION['check'] = false;
        $_SESSION['message'] = ($_POST['guess'] > $_SESSION['num']) ? "Too high!" : "Too low!";
        $_SESSION['class'] = "red";
    }
	header('Location: index.php');
?>