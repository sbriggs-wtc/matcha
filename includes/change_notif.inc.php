<?php
    include '../config/dbh.php';

    if (isset($_POST['changeNotifSubmit']))
    {
        session_start();
        $name = $_SESSION['username'];
        $pwd = hash('whirlpool', $_POST['pwd']);
        $notif = empty($_POST['notif']) ? 0 : 1;
        if (!empty($pwd))
        {
            $object = new Dbh;
            $pdo = $object->connect();
            $row = $object->findNameMatch($pdo, $name);
            if ($pwd === $row['password'])
            {
                $object->updateAccNotif($pdo, $name, $notif);
                header('Location: ../preferences.php?notif_change=success');    
            }
            else
                header('Location: ../change_notif.php?input=pwd_incorrect');
        }
        else
            header('Location: ../change_notif.php?input=empty_fields');
    }
    else
        header('Location: ../change_notif.php?input=submit_not_set');