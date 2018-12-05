<?php
    include_once "../config/dbh.php";
    session_start();

    if (!empty($_SESSION['username']))
    {
        $liker = $_SESSION['username'];
        $likee = $_POST['likee_name'];
        $blocked = $likee;
        $object = new Dbh;
        $pdo = $object->connect();
        if (isset($_POST['like']))
        {
            $row = $object->checkIfLikeExists($pdo, $liker, $likee);
            if (empty($row))
            {
                $object->newLike($pdo, $liker, $likee);
            }
            header("Location: ../profile_suggestions.php?like=success");
        }
        else if (isset($_POST['unlike']))
        {
            $row = $object->checkIfLikeExists($pdo, $liker, $likee);
            if (!empty($row))
            {
                $object->delLike($pdo, $liker, $likee);
            }
            header("Location: ../profile_suggestions.php?unlike=success");
        }
        else if (isset($_POST['block']))
        {
            echo "block";
            $object->blockSelectedUser($pdo, $blocked);
            header("Location: ../profile_suggestions.php?block=success");
        }
        else
        {
            header("Location: ../profile_suggestions.php?like=failed ");
        }
    }
    else
        echo "not logged in";