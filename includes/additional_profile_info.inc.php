<?php
    include_once '../config/dbh.php';

    session_start();

    if (isset($_POST['add_inf_submit']))
    {
        $gender     = (!empty($_POST['gender']))    ? $_POST['gender']                        : 0;
        $sex        = (!empty($_POST['sex']))       ? $_POST['sex']                           : 0;
        $bio        = (!empty($_POST['bio']))       ? htmlspecialchars($_POST['bio'])         : 0;
        $age        = (!empty($_POST['age']))       ? htmlspecialchars($_POST['age'])         : 0;
        $location   = (!empty($_POST['location']))  ? htmlspecialchars($_POST['location'])    : 0;
        $int1       = (!empty($_POST['int1']))      ? htmlspecialchars($_POST['int1'])        : 0;
        $int2       = (!empty($_POST['int2']))      ? htmlspecialchars($_POST['int2'])        : 0;
        $int3       = (!empty($_POST['int3']))      ? htmlspecialchars($_POST['int3'])        : 0;

        if (isset($_SESSION['username']))
        {
            $uname = $_SESSION['username'];
            $object = new Dbh;
            $pdo = $object->connect();

            $row = $object->checkIfInterestAlreadyExists($pdo, $int1);
            if(empty($row) && !empty($int1))
            {
                $object->updateIntList($pdo, $int1);
            }

            $row = $object->checkIfInterestAlreadyExists($pdo, $int2);
            if(empty($row))
            {
                if(!empty($int2))       
                    $object->updateIntList($pdo, $int2);
            }

            $row = $object->checkIfInterestAlreadyExists($pdo, $int3);
            if(empty($row))
            {
                if(!empty($int3))       
                    $object->updateIntList($pdo, $int3);
            }

            $object->updateAccAdditionalInfo($pdo, $uname, $gender, $sex, $bio, $age, $location,
            $int1, $int2, $int3);

            header('Location: logout.inc.php?input=profile_updated');  
        }
        else
            header('Location: ../additional_profile_info.php?login=not_logged_in');    
    }