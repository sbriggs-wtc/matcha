<?php
    include_once '../config/dbh.php';

    if ($_POST['login_submit'] && $_POST['login_name'] && $_POST['login_hashPwd'])
    {

        $name = htmlspecialchars($_POST['login_name']);
        $hashPwd = hash('whirlpool', $_POST['login_hashPwd']);
        $object = new Dbh;
        $pdo = $object->connect();
        $row = $object->findNameMatch($pdo, $name);
        if ($row)
        {
            if ($row['password'] === $hashPwd)
            {
                if($row['active'])
                {
                    session_start();
                    $_SESSION['username'] = $row['user_name'];
                    $_SESSION['gender'] = $row['gender'];
                    $_SESSION['sexual_preference'] = $row['sexual_preference'];
                    $_SESSION['location'] = $row['location'];
                    $object->setUserConnectionStatus($pdo, 'Connected', $_SESSION['username']);
                    $object->setUserConnectionTime($pdo, 'Connected', $_SESSION['username']);

                    header('Location: ../index.php?login=success');
                }
                else
                    header('Location: ../index.php?login=account_not_activated');
            }
            else
                header('Location: ../index.php?login=passwords_dont_match');
        }
        else
        header('Location: ../index.php?login=name_not_found');
    }
    else
        header('Location: ../index.php?login=incomplete');
