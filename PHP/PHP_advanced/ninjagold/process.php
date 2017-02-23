<?php
session_start();
if(!isset($_SESSION['gold']))
{
    $_SESSION['gold'] = 0;
}
if(isset($_POST['building']))
{
    if($_POST['building'] == 'farm')
    {
        $_SESSION['random'] = rand(10,20);
        $_SESSION['gold'] = $_SESSION['gold'] + $_SESSION['random'];
        $_SESSION['activity'][] = "You earned a farm and earned " . $_SESSION['random'] . " golds.";
        header('location: ninja_gold.php');
    }
    if($_POST['building'] == 'cave')
    {
        $_SESSION['random'] = rand(5,10);
        $_SESSION['gold'] = $_SESSION['gold'] + $_SESSION['random'];
        $_SESSION['activity'][] = "You earned a cave and earned " . $_SESSION['random'] . " golds.";
        header('location: ninja_gold.php');
    }
    if($_POST['building'] == 'house')
    {
        $_SESSION['random'] = rand(2,5);
        $_SESSION['gold'] = $_SESSION['gold'] + $_SESSION['random'];
        $_SESSION['activity'][] = "You earned a house and earned " . $_SESSION['random'] . " golds.";
        header('location: ninja_gold.php');
    }
    if($_POST['building'] == 'casino')
    {
        $_SESSION['random'] = rand(-50,50);
        $_SESSION['gold'] = $_SESSION['gold'] + $_SESSION['random'];
        header('location: ninja_gold.php');
    }
}
if(isset($_POST['reset']))
{
    session_destroy();
    header('location: ninja_gold.php');
    die();
}
?>
