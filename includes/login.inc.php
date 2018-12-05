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
                if ($row['is_blocked'] != 1)
                {
                    if($row['active'])
                    {
                        session_start();
                        $_SESSION['username'] = $row['user_name'];
                        $_SESSION['gender'] = $row['gender'];
                        $_SESSION['sexual_preference'] = $row['sexual_preference'];
                        $_SESSION['location'] = $row['location'];
                        $_SESSION['id_profile_pic'] = $row['id_profile_pic'];
                        $object->setUserConnectionStatus($pdo, 'Online', $_SESSION['username']);
                        $object->setUserConnectionTime($pdo, 'Online', $_SESSION['username']);
                        header('Location: ../index.php?login=success');
                    }
                    else
                        header('Location: ../index.php?login=account_not_activated');
                }
                else
                    echo "<h1>Your Account has been blocked, please contact administrator to unblock</h1>";
            }
            else
                header('Location: ../index.php?login=passwords_dont_match');
        }
        else
        header('Location: ../index.php?login=name_not_found');
    }
    else
        header('Location: ../index.php?login=incomplete');
