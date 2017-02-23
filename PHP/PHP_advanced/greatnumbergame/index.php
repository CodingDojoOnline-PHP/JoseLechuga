
<?php session_start();
if(!isset($_SESSION['num'])) {
    $_SESSION['num'] = rand(1, 100);
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Counter Demo</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div id="wrapper">
    <h1>Welcome to the Great Number Game</h1>
    <p>I'm thinking of a number between 1 - 100</p>
    <p>Take a guess!</p>
    <?php
    if(isset($_SESSION['message'])){
        ?><p id="result" class="<?= $_SESSION['class'] ?>"><?=$_SESSION['message'];?></p>
        <?php
    }
    if(isset($_SESSION['check']) && $_SESSION['check']){?>
        <form action="process.php" method="post">
            <input type="hidden" name="action" value="reset">
            <input type="submit" value="Play again!">
        </form>
        <?php
    } else { ?>
        <form action="process.php" method="post">
            <input id="box" type="text" name="guess">
            <input id="button" type="submit" value="Submit">
        </form>
        <?php
    }
    ?>
</div>
</body>
</html>
