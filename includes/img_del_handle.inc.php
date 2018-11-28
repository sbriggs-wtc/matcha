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
            $object->createLikesTb($pdo);
            $object->isDelImage($pdo, $imgId);
            header('Location: ../upload_image.php');
        }
    }
    else
        echo "not logged in";
    