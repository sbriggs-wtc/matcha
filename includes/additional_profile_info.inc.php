<?php
    include_once '../config/dbh.php';

    session_start();

    if (isset($_POST['add_inf_submit']))
    {
        $gender     = (!empty($_POST['gender']))    ? $_POST['gender']      : 0;
        $sex        = (!empty($_POST['sex']))       ? $_POST['sex']         : 0;
        $bio        = (!empty($_POST['bio']))       ? $_POST['bio']         : 0;
        $age        = (!empty($_POST['age']))       ? $_POST['age']         : 0;
        $location   = (!empty($_POST['location']))  ? $_POST['location']    : 0;
        
        // print_r($_POST);
        if (isset($_SESSION['username']))
        {
            $uname = $_SESSION['username'];
            $object = new Dbh;
            $pdo = $object->connect();

            $row = $object->checkIfInterestAlreadyExists($pdo, $_POST['int1']);
            if(empty($row) && !empty($_POST['int1']))
            {
                $object->updateIntList($pdo, $_POST['int1']);
            }

            $row = $object->checkIfInterestAlreadyExists($pdo, $_POST['int2']);
            if(empty($row))
            {
                if(!empty($_POST['int2']))       
                    $object->updateIntList($pdo, $_POST['int2']);
            }

            $row = $object->checkIfInterestAlreadyExists($pdo, $_POST['int3']);
            if(empty($row))
            {
                if(!empty($_POST['int3']))       
                    $object->updateIntList($pdo, $_POST['int3']);
            }

            $row = $object->checkIfInterestAlreadyExists($pdo, $_POST['int4']);
            if(empty($row))
            {
                if(!empty($_POST['int4']))
                    $object->updateIntList($pdo, $_POST['int4']);
            }

            $row = $object->checkIfInterestAlreadyExists($pdo, $_POST['int5']);
            if(empty($row))
            {
                if(!empty($_POST['int5']))
                    $object->updateIntList($pdo, $_POST['int5']);
            }

            $object->updateAccAdditionalInfo($pdo, $uname, $gender, $sex, $bio, $age, $location,
            $_POST['int1'], $_POST['int2'], $_POST['int3'], $_POST['int4'], $_POST['int5']);

            header('Location: logout.inc.php?input=profile_updated');  
//          header('Location: ../additional_profile_info.php?input=profile_updated');    
        }
        else
            header('Location: ../additional_profile_info.php?login=not_logged_in');    
    }