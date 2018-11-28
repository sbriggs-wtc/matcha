<?php
    include "../config/dbh.php";
    include "auxillary_functions.inc.php";

    $name = $_POST['loginName'];
    $object = new Dbh;
    $pdo = $object->connect();
    $row = $object->findNameMatch($pdo, $name);
    if ($row)
    {
        sendPwdResetEmail($name, $row['email_addr'], $row['hash_key']);
        echo "<h1>Please click on the unique link sent to your email address</h1>";
    }   
    else
        header('Location: ../forgot_hashPwd.php?input=name_does_not_match_database_entries');    