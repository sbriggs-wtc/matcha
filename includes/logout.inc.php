<?php

    include_once '../config/dbh.php';

    session_start();

    date_default_timezone_set('Africa/Johannesburg');
    $date_time =  date("Y-m-d h:i:sa");

    $object = new Dbh;
    $pdo = $object->connect();
    $object->setUserConnectionStatus($pdo, 'Disconnected', $_SESSION['username']);
    $object->setUserConnectionTime($pdo, $date_time, $_SESSION['username']);

    session_unset();
    session_destroy();
    header("Location: ../index.php ");