<?php
session_start();
require_once('login_reg_connection.php');

//register button clicked
if(isset($_POST['action']) && $_POST['action'] == 'register') {
    register_user($_POST);
}
//login button clicked
elseif(isset($_POST['action']) && $_POST['action'] == 'login') {
    login_user($_POST);
}
// user logging off
else {
    session_destroy();
    header('location: index.php');
    exit();
}

//function to login the user
function login_user($post) {
    $password = md5($post['password']);
    $email = escape_this_string($post['email']);
    $query = "SELECT * FROM users
                WHERE users.password = '{$password}' AND users.email = '{$email}'";
    $user = fetch_all($query);
    if(count($user) > 0) {
        $_SESSION['user_id'] = $user[0]['id'];
        $_SESSION['first_name'] = $user[0]['first_name'];
        $_SESSION['last_name'] = $user[0]['last_name'];
        $_SESSION['logged_in'] = true;
        header('location: success.php');
    }
    else {
        $_SESSION['errors'] = array();
        $_SESSION['errors'][] = 'Login information is incorrect/user does not exist';
        $_SESSION['email'] = ''; //set email to empty string so if login is incorrect, it doesn't fill in the email on the register side
        header('location: index.php');
    }
}

//function to register user
function register_user($post) {

    //error array to keep track of errors
    $_SESSION['errors'] = array();

    //first name validation (not empty, contains only letters & spaces)
    if(empty($post['first_name'])) {
        $_SESSION['errors'][] = "Please enter your first name.";
    }

    if(!preg_match("/^[a-zA-Z ]*$/", $post['first_name'])) {
        $_SESSION['errors'][] = "Please make sure your first name only contains letters.";
    }

    //last name validation (not empty, contains only letters & spaces)
    if(empty($post['last_name'])) {
        $_SESSION['errors'][] = "Please enter your last name.";
    }

    if(!preg_match("/^[a-zA-Z ]*$/", $post['last_name'])) {
        $_SESSION['errors'][] = "Please make sure your last name only contains letters.";
    }

    //email validation (not empty, valid email)
    if(empty($post['email'])) {
        $_SESSION['errors'][] = "Please enter your email.";
    }
    if(!empty($post['email']) && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'][] = "Please enter a valid email address.";
    }

    //validate that password is not empty
    if(empty($post['password'])) {
        $_SESSION['errors'][] = "Please enter a password.";
    }

    //validate that passwords match
    if($post['password'] != $post['confirm-password']) {
        $_SESSION['errors'][] = "Your passwords do not match.";
    }

    //if there are errors, re-direct user back to login/register page
    if(count($_SESSION['errors']) > 0) {
        header('location: index.php');
    }
    else {
        insert_new_user($post['first_name'], $post['last_name'], $post['email'], $post['password']);
    }
}

// if validations all passed, allow user to register (escape all fields first & encrypt password).  Note: used md5 encryption since this is just a small assignment
function insert_new_user($first, $last, $email, $password) {
    $esc_first = escape_this_string($first);
    $esc_last = escape_this_string($last);
    $esc_email = escape_this_string($email);
    $encrypt_password = md5($password);
    $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
                VALUES ('{$esc_first}', '{$esc_last}', '{$esc_email}', '{$encrypt_password}', NOW(), NOW())";
    run_mysql_query($query);
    $_SESSION['registered'] = 'Thank you for registering, please log in.';
    header('location: index.php');
}

?>
