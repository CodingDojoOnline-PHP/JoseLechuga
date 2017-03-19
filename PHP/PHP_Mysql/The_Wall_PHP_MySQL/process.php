<?php
    session_start();
    require_once('the_wall_connection.php');

    //register button clicked
    if(isset($_POST['action']) && $_POST['action'] == 'register') {
        register_user($_POST);
    }
    //login button clicked
    elseif(isset($_POST['action']) && $_POST['action'] == 'login') {
        login_user($_POST);
    }
    //post mesage button clicked
    elseif(isset($_POST['action']) && $_POST['action'] == 'post_message') {
        post_message($_POST);
    }
    //post comment button clicked
    elseif(isset($_POST['action']) && $_POST['action'] == 'post_comment') {
        post_comment($_POST);
    }
    //user wants to delete post
    elseif(isset($_GET['action']) && $_GET['action'] == 'delete_message') {
        delete_message($_GET);
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'delete_comment') {
        delete_comment($_GET);
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
            header('location: wall.php');
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

    //function to store posted message in database
    function post_message($post) {
        //put the message into the database (escape it first)
        $message = escape_this_string($post['message']);
        $esc_userid = escape_this_string($_SESSION['user_id']);
        $query = "INSERT INTO messages (message, created_at, updated_at, user_id)
                    VALUES ('{$message}', NOW(), NOW(), '{$esc_userid}')";
        run_mysql_query($query);
        header('location: wall.php');
    }

    //function to store posted comment in the database
    function post_comment($post) {
        //put the comment into the database (escape it first)
        $comment = escape_this_string($post['comment']);
        $esc_userid = escape_this_string($_SESSION['user_id']);
        $esc_messageid = escape_this_string($post['message_id']);
        $query = "INSERT INTO comments (comment, created_at, updated_at, user_id, message_id)
                    VALUES ('{$post['comment']}', NOW(), NOW(), '{$esc_userid}', '{$esc_messageid}')";
        run_mysql_query($query);
        header('location: wall.php');
    }

    //function to delete a message
    function delete_message($get) {
        $delete_message_id = escape_this_string($get['message_id']);
        $query_message = "DELETE FROM messages WHERE id = '{$delete_message_id}'";
        $query_comments = "DELETE FROM comments WHERE message_id = '{$delete_message_id}'";
        run_mysql_query($query_comments);
        run_mysql_query($query_message);
        header('location: wall.php');
    }

    //function to delete a comment
    function delete_comment($get) {
        $delete_comment_id = escape_this_string($get['comment_id']);
        $query = "DELETE FROM comments WHERE id = '{$delete_comment_id}'";
        run_mysql_query($query);
        header('location: wall.php');
    }

?>
