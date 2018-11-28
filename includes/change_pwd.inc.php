<?php
    include '../config/dbh.php';
    include 'auxillary_functions.inc.php';

    if (isset($_POST['ch_pwd_submit']))
    {
        session_start();
        $uName = $_SESSION['username'];
        $pwdOld = hash('whirlpool', $_POST['pwd_old']);
        $pwdNew = $_POST['pwd_new'];
        $pwdNewRe = $_POST['pwd_new_re'];
        
        if (!empty($pwdOld) && !empty($pwdNew) && !empty($pwdNewRe))
        {
            $object = new Dbh;
            $pdo = $object->connect();
            $row = $object->findNameMatch($pdo, $uName);
            if ($pwdOld === $row['password'])
            {
                if (!checkPwdIsSamePwdRe($pwdNew, $pwdNewRe))
                {
                    header('Location: ../change_pwd.php?input=passwords_dont_match');
                    return ;
                }
                if (!checkPwdIsValidLen($pwdNew))
                {
                    header('Location: ../change_pwd.php?input=password_invalid');
                    return ;
                }
                if (!checkPwdIsValidInput($pwdNew))
                {
                    header('Location: ../change_pwd.php?input=password_too_simple');
                    return ;
                }
                $pwdNew = hash('whirlpool', $_POST['pwd_new']);
                $pwdNewRe = hash('whirlpool', $_POST['pwd_new_re']);
                $object->updateAccPwd($pdo, $uName, $pwdNew);
                header('Location: ../preferences.php?password_change=success');
            }
            else
                header('Location: ../change_pwd.php?input=pwd_incorrect');
        }
        else
            header('Location: ../change_pwd.php?input=empty_fields');    
    }
    else
        header('Location: ../change_pwd.php?input=submit_not_set');