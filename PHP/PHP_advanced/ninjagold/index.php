<?php
session_start();

?>


<html>
<head>
    <title>Ninja Gold</title>
    <style type="text/css">

        #container {
            margin: 0px auto;
            width: 970px;
            height: 600px;
        }

        #building {
            width: 960px;
            height: 175px;
        }

        form, #your_gold {
            border: 1px solid black;
            height: 100px;
            width: 150px;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
            padding: 20px 5px;
            text-align: center;
        }

        #building form {
            background-color: silver;
        }

        #your_gold {
            background-color: yellow;
        }

        #your_gold h3 {
            border: 1px solid black;
            height: 35px;
            width: 75px;
            margin-left: 35px;
            background-color: white;
            padding-top: 10px;
        }

        #reset {
            border: none;
        }

        #activities {
            width: 960px;
            height: 200px;
        }

    </style>
</head>
<body>
<div id="container">
    <h1>Play the Ninja Gold Game</h1>
    <div id="your_gold">
        <p>Your Gold</p>
        <h3>
            <?php
            if(!isset($_SESSION['gold']))
            {
                echo "0";
            }
            else
            {
                echo $_SESSION['gold'];
            }
            ?>
        </h3>
    </div>
    <form id="reset" action="ninja_process.php" method="post">
        <input type="hidden" name="reset" value="new">
        <input type="submit" value="Start a New Game">
    </form>
    <div id=building>
        <form action="ninja_process.php" method="post">
            <p>Farm</p>
            <p>(earns 10-20 golds)</p>
            <input type="hidden" name="building" value="farm">
            <input type="submit" value="find gold!">
        </form>
        <form action="ninja_process.php" method="post">
            <p>Cave</p>
            <p>(earns 5-10 golds)</p>
            <input type="hidden" name="building" value="cave">
            <input type="submit" value="find gold!">
        </form>
        <form action="ninja_process.php" method="post">
            <p>House</p>
            <p>(earns 2-5 golds)</p>
            <input type="hidden" name="building" value="house">
            <input type="submit" value="find gold!">
        </form>
        <form action="ninja_process.php" method="post">
            <p>Casino</p>
            <p>(earns/takes 0-50 golds)</p>
            <input type="hidden" name="building" value="casino">
            <input type="submit" value="find gold!">
        </form>
    </div>
    <div id="activites">
        <p>Activities:</p>
        <?php
        if(isset($_SESSION['activity']))
        {
            ksort($_SESSION['activity']);
            foreach($_SESSION['activity'] as $activity)
            {
                ?>
                <p><?= $activity ?></p>
                <?php
            }
        }
        ?>
    </div>
</div>
</body>
</html>
