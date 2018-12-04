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
            //$object->isDelImage($pdo, $imgId);

            $object->setAsProfPic($pdo, $imgId, $uName);
//            header('Location: ../upload_image.php?img_upload=success');
            echo "success";
        }
        else
//        header('Location: ../upload_image.php?submit=not_set');
        echo "failed";
    }
    else 
        echo "login failed";
//    else
//        header('Location: ../upload_image.php?login=fail');