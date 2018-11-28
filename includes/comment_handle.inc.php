<?php
    include_once '../config/dbh.php';
    include_once 'auxillary_functions.inc.php';

    session_start();
        
    if (!empty($_SESSION['username']))
    {
        if (isset($_POST['submit']))
        {
            $imgId = $_POST['imgid'];
            $imgOwner = $_POST['imgowner'];
            $commentator = $_SESSION['username'];
            $comment = htmlspecialchars($_POST['text']);
            if (!empty($comment))
            {
                $object = new Dbh;
                $pdo = $object->connect();
                $object->createCommentsTb($pdo);
                $object->insertComment($pdo, $imgId, $imgOwner, $commentator, $comment);
                $row = $object->selectCommentatorNotifEmail($pdo, $commentator);
                $mail = $row[0]['email_addr'];
                if($row[0]['notifications'] == 1)
                    sendCommentNotificationEmail($commentator, $mail);
                echo "comment submitted";
            }
        }
    }
    else
    {
        echo "not logged in";
    }