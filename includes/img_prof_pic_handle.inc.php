<?php
    include_once '../config/dbh.php';

    session_start();
    if (!empty($_SESSION['username']))
    {
        if (isset($_POST['submit']))
        {
            $imgId = $_POST['imgid'];
            $uName = $_SESSION['username'];
            $object = new Dbh;
            $pdo = $object->connect();
            $object->setAsProfPic($pdo, $imgId, $uName);
            $_SESSION['id_profile_pic'] = $imgId;
            echo "success";
        }
        else
        echo "failed";
    }
    else 
        echo "login failed";