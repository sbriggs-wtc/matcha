<?php
    include_once '../config/dbh.php';

    session_start();
    

    if (isset($_POST['add_inf_submit']))
    {
        $gender = !empty($_POST['gender']) ? $_POST['gender'] : 0;
        $sex = !empty($_POST['sex']) ? $_POST['sex'] : 0;
        $bio = !empty($_POST['bio']) ? $_POST['bio'] : 0;
        $int_1 = !empty($_POST['interest_1']) ? $_POST['interest_1'] : 0;
        $int_2 = !empty($_POST['interest_2']) ? $_POST['interest_2'] : 0;
        $int_3 = !empty($_POST['interest_3']) ? $_POST['interest_3'] : 0;
        $int_4 = !empty($_POST['interest_4']) ? $_POST['interest_4'] : 0;
        $int_5 = !empty($_POST['interest_5']) ? $_POST['interest_5'] : 0;

        //print_r($_POST);

        if (isset($_SESSION['username']))
        {
            $uname = $_SESSION['username'];
            $object = new Dbh;
            $pdo = $object->connect();
            $object->updateAccAddInfo($pdo, $uname, $gender, $sex, $bio, $int_1, $int_2, $int_3, $int_4, $int_5);                           
        }
        else
            header('Location: ../additional_profile_info.php?login=not_logged_in');    
    }