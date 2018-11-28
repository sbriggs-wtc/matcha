<?php
        include_once '../config/dbh.php';
        include_once 'auxillary_functions.inc.php';
    
    if ($_POST['signup_submit'] && 
        $_POST['name'] && 
        $_POST['fname'] &&
        $_POST['lname'] &&
        $_POST['mail'] && 
        $_POST['pwd'] && 
        $_POST['pwd_repeat'])
    {

        $name = htmlspecialchars($_POST['name']);
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $mail = $_POST['mail'];
        $pwd = $_POST['pwd'];
        $pwdRe = $_POST['pwd_repeat'];
        $notif = (isset($_POST['notif'])) ? 1 : 0;
        if (!checkPwdIsSamePwdRe($pwd, $pwdRe))
        {
            header('Location: ../signup.php?input=passwords_dont_match');
            return ;
        }
        if (!checkPwdIsValidLen($pwd))
        {
            header('Location: ../signup.php?input=password_invalid');
            return ;
        }
        if (!checkPwdIsValidInput($pwd))
        {
            header('Location: ../signup.php?input=password_too_simple');
            return ;
        }
        $object = new Dbh;
        $pdo = $object->connect();
        $object->createAccDetailsTb($pdo);
        if (!($object->checkNameIsTaken($pdo, $name)))
        {   
            $hashKey = hash('whirlpool', $pwd . $name);
            $hashPwd = hash('whirlpool', $pwd);
            sendConfirmationEmail($name, $mail, $hashKey);
            $object->insertAccDetails($pdo, $name, $fname, $lname, $mail, $hashPwd, $hashKey, $notif);
            echo "<h1>Please activate your account by clicking on the link that has been sent to your email address</h1>";
        }
        else
        {
            header('Location: ../signup.php?input=name_taken');
            return ;
        }
    }
    else
    {
        header('Location: ../signup.php?input=incomplete');
        return ;
    }