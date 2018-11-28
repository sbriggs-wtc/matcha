<?php
    include_once '../config/dbh.php';

    if (isset($_POST['changeNameSubmit']))
    {
        session_start();
        $currName = $_SESSION['username'];
        $newName = $_POST['newName'];
        //$pwd = $_POST['pwd'];
        $pwd = hash('whirlpool', $_POST['pwd']);
        if (!empty($newName) && !empty($pwd))
        {
            $object = new Dbh;
            $pdo = $object->connect();
            $currUserRow = $object->findNameMatch($pdo, $currName);
            
            if ($pwd === $currUserRow['password'])
            {
                $checkRow = $object->findNameMatch($pdo, $newName);
                if (empty($checkRow))
                {
                    $object->updateAccName($pdo, $currName, $newName);
                    $_SESSION['username'] = $newName;
                    header('Location: ../preferences.php?change_name=success');
                }
                else
                    header('Location: ../change_name.php?input=name_in_use');
            }
            else
                header('Location: ../change_name.php?input=pwd_incorrect');
        }
        else
            header('Location: ../change_name.php?input=empty_fields');
    }
    else
        header('Location: ../change_name.php?input=submit_not_set');