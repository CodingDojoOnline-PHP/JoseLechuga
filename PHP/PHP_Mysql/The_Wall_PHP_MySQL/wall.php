<?php
    session_start();
    require_once('the_wall_connection.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Wall Assignment</title>
    <meta charset='UTF-8'/>
    <meta name='description' content='The wall' />
    <meta name="author" content="Jose Lechuga">
    <link rel='stylesheet' type='text/css' href='css/wall.css'/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
    <div id='container'>
        <!-- welcome banner -->
        <div class='welcome'>
            <h1>Jose's Dojo Wall</h1>
            <h3>Welcome, <?= $_SESSION['first_name'] ?> </h3>
            <a href='process.php'>Log off</a>
        </div>

        <!-- post a message -->
        <div class='post'>
            <h4>Post a message</h4>
            <form action='process.php' method='post'>
                <textarea name='message'></textarea>
                <input type='submit' name='post_message' value='Post a message' />
                <input type='hidden' name='action' value='post_message' />
            </form>
        </div>
        </div>

        <!-- messages -->
        <?php
            //display all messages
            $query = "SELECT messages.id, message, messages.created_at, messages.updated_at, user_id, first_name, last_name FROM messages LEFT JOIN users on users.id = messages.user_id";
            $user_messages = fetch_all($query);
            $user_messages = array_reverse($user_messages);
            if(count($user_messages) > 0) {
                foreach($user_messages as $user_message) {
                    $message_date = strtotime($user_message['created_at']);
                    $formatted_date = date("F dS, Y h:ia", $message_date); ?>
                    <!-- message -->
                    <div class='message'>
                        <h4><?= $user_message['first_name'] . " " . $user_message['last_name'] . " - " . $formatted_date ?>
                            <?php
                            //user can delete his/her own messages if they try to delete it within 30 minutes of posting it
                            $current_datetime = getDate();
                            $formatted_current_datetime = date("Y-m-d H:i:s", $current_datetime['0']);
                            $message_created_date = $user_message['created_at'];
                            $time_lapsed = strtotime($formatted_current_datetime) - strtotime($message_created_date);
                            $minutes_passed = date('i', $time_lapsed); //format time passed in minutes
                            if($_SESSION['user_id'] === $user_message['user_id'] && $minutes_passed <= 30) { ?>
                                <a href='process.php?action=delete_message&message_id=<?= $user_message['id'] ?>'>Delete</a>
                            <?php }?>
                        </h4>
                        <p><?= $user_message['message'] ?></p>
                    </div>
                    <!-- comments -->
                    <?php
                        $query = "SELECT comment, first_name, last_name, comments.message_id, comments.created_at, comments.id, comments.user_id
                                    FROM comments
                                    LEFT JOIN users on users.id = comments.user_id
                                    WHERE comments.message_id = {$user_message['id']}";
                        $user_comments = fetch_all($query);
                        foreach($user_comments as $user_comment) {
                            $comment_date = strtotime($user_comment['created_at']);
                            $formatted_comment_date = date("F dS, Y h:ia", $comment_date); ?>
                            <div class='comment'>
                                <h4><?= $user_comment['first_name'] . " " . $user_comment['last_name'] . " - " . $formatted_comment_date ?>
                                <?php
                                // users can delete his/her own comments if they try to delete it within 30 minutes of posting it
                                    $current_datetime = getDate();
                                    $formatted_current_datetime = date("Y-m-d H:i:s", $current_datetime['0']);
                                    $comment_created_date = $user_comment['created_at'];
                                    $time_lapsed = strtotime($formatted_current_datetime) - strtotime($comment_created_date);
                                    $minutes_passed = date('i', $time_lapsed);
                                    if($_SESSION['user_id'] === $user_comment['user_id'] && $minutes_passed <= 30) { ?>
                                        <a href='process.php?action=delete_comment&comment_id=<?= $user_comment['id'] ?>'>Delete comment</a>
                                    <?php } ?>
                                </h4>
                                <p><?= $user_comment['comment'] ?></p>
                            </div>
                    <?php } ?>
                    <div class='post-comment'>
                        <h5>Post a comment</h5>
                        <form action='process.php' method='post'>
                            <textarea name='comment'></textarea>
                            <input type='submit' name='post_comment' value='Post a comment' />
                            <input type='hidden' name='action' value='post_comment'/>
                            <input type='hidden' name='message_id' value='<?= $user_message['id'] ?>' />
                        </form>
                    </div>
                <?php }
            }
        ?>
    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</bodY>
</html>
