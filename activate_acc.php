<?php
include_once 'config/dbh.php';

if (isset($_GET['hashKey']))
{
    $hashKey = $_GET['hashKey'];
    $object = new Dbh;
    $pdo = $object->connect();
    $row = $object->findKeyMatch($pdo, $hashKey);
    $object->activateAcc($pdo, $hashKey);
    echo "<h1>Your account has been successfully activated</h1>";
    echo '<br/><a href="index.php">Continue</a><br/>';
}
else
    echo "<h1>Your account has not been activated</h1>";
?>
