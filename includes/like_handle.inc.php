<?php
    include_once '../config/dbh.php';

    session_start();
    if (!empty($_SESSION['username']))
    {
        if (isset($_POST['submit']))
        {
            $imgId = $_POST['imgid'];
            $liker = $_SESSION['username'];
            $object = new Dbh;
            $pdo = $object->connect();
            $object->createLikesTb($pdo);
            $row = $object->checkIfAlreadyLikes($pdo, $imgId, $liker);
            if (empty($row))
            {
                $object->insertLikes($pdo, $imgId, $liker);
                echo "like submitted";
            }
            else
                echo "you already like this";
        }
    }
    else
    {
        echo "not logged in";
    }
    