<?php
include '../config/dbh.php';
include "auxillary_functions.inc.php";

if (isset($_POST['resetPwdSubmit']))
{
    $hashKey = $_GET['hashKey'];
    $pwdNew = $_POST['pwdNew'];
    $pwdNewRe = $_POST['pwdNewRe'];
    if (!empty($pwdNew))
    {
        if (!checkPwdIsSamePwdRe($pwdNew, $pwdNewRe))
            {
                header("Location: ../reset_pwd.php?input=passwords_dont_match&hashKey=" .$hashKey);
                return ;
            }
            if (!checkPwdIsValidLen($pwdNew))
            {
                header("Location: ../reset_pwd.php?input=password_invalid_length&hashKey=" .$hashKey);
                return ;
            }
            if (!checkPwdIsValidInput($pwdNew))
            {
                header("Location: ../reset_pwd.php?input=password_too_simple&hashKey=" .$hashKey);
                return ;
            }
        $pwdNew = hash('whirlpool', $_POST['pwdNew']);
        $pwdNewRe = hash('whirlpool', $_POST['pwdNewRe']);
        $object = new Dbh;
        $pdo = $object->connect();
        $row = $object->findKeyMatch($pdo, $hashKey);
        $object->updateResetAccPwd($pdo, $hashKey, $pwdNew);
        header('Location: ../index.php?pwd_reset=success');
    }
    else
        header("Location: ../reset_pwd.php?input=empty_fields&hashKey=" .$hashKey);
}
else
header("Location: ../reset_pwd.php?input=submit_not_set&hashKey=" .$hashKey);;

