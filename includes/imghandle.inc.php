<?php
    include_once '../config/dbh.php';  
    session_start();

    if (!empty($_SESSION['username']))
    {   
        $uname = $_SESSION['username'];

        $object = new Dbh;
        $pdo = $object->connect();
        $rows = $object->selectUserImgsFromDb($pdo, $uname);
    
        if (count($rows) < 5)
        {
            if (isset($_POST['file']))
            {
                $img = $_POST['file'];
                $img = str_replace(" ", "+", $img);
                $img = str_replace("data:image/png;base64,", "", $img);
                $img = base64_decode($img);
                $img = imagecreatefromstring($img);
                imagepng($img, 'save.png');
                $object->createImgStoreTb($pdo);
                $img = base64_encode(file_get_contents('save.png'));
                $object->insertImgIntoDb($pdo, $img, $uname);
                echo "Your image was uploaded";
                unlink('save.png');
            }
            else
                echo "file not set";
        }
        else
            echo "you already have too many images";
    }
    else
        echo "not logged in";