<?php
    include_once '../config/dbh.php';

    if (isset($_POST['changeEmailSubmit']))
    {
        session_start();
        $name = $_SESSION['username'];
        $email = $_POST['newEmail'];
        $pwd = hash('whirlpool', $_POST['pwd']);
        if (!empty($email) && !empty($pwd))
        {
            $object = new Dbh;
            $pdo = $object->connect();
            $row = $object->findNameMatch($pdo, $name);
            if ($pwd === $row['password'])
            {
                $object->updateAccEmail($pdo, $name, $email);
                header('Location: ../preferences.php?email_change=success');    
            }
            else
                header('Location: ../change_name.php?input=pwd_incorrect');
        }
        else
            header('Location: ../change_email.php?input=empty_fields');    
    }
    else
        header('Location: ../change_email.php?input=submit_not_set');