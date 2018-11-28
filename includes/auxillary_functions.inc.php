<?php
    
    function checkPwdIsSamePwdRe($pwd, $pwdRe)
    {
        if ($pwd !== $pwdRe) {
            
            return false;
        }
        return true;
    }

    function checkPwdIsValidLen($pwd)
    {
        if (strlen($pwd) < 8) {
            
            return false;
        }
        else if (strlen($pwd) > 20) {
            
            return false;
        }
        return true;
    }

    function checkPwdIsValidInput($pwd)
    {
        if(!(preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/', $pwd))) {
            return false;
        }
        return true;
    }

    function sendConfirmationEmail($name, $mail, $hashKey)
    {
        $link = "http://localhost:8080/matcha/activate_acc.php?hashKey=" .$hashKey;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = "Camagru Account Verification";
        $headers .= "From: sbriggs@student.wethinkcode.co.za";
        $txt =
        "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        Hi " . $name . ", 
        Activate your Camagru account by
        clicking <a href=" . $link . ">here.</a>
        </body>
        </html>
        ";
        mail($mail, $subject, $txt, $headers);
    }

    function sendPwdResetEmail($name, $mail, $hashKey)
    {
        $link = "http://localhost:8080/camagru/reset_pwd.php?hashKey=" .$hashKey;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = "Reset Password";
        $headers .= "From: sbriggs@student.wethinkcode.co.za";
        $txt =
        "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        Hi " . $name . ", 
        reset your password by clicking <a href=" . $link . ">here.</a>
        </body>
        </html>
        ";
        mail($mail, $subject, $txt, $headers);
    }

    function sendCommentNotificationEmail($name, $mail)
    {
        $link = "http://localhost:8080/camagru/reset_pwd.php";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = "Comment Notification";
        $headers .= "From: sbriggs@student.wethinkcode.co.za";
        $txt =
        "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        Hi " . $name . ", 
        You just commented on a photo.
        </body>
        </html>
        ";
        mail($mail, $subject, $txt, $headers);
    }