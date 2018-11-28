<?php
    include_once '../config/dbh.php';  
    session_start();       
    if (!empty($_SESSION['username']))
    {   
        $uname = $_SESSION['username'];
        if (isset($_POST['file']))
        {
            $img = $_POST['file'];
            $img = str_replace(" ", "+", $img);
            $img = str_replace("data:image/png;base64,", "", $img);
            $img = base64_decode($img);
            $img = imagecreatefromstring($img);
            unlink('save.png');
            imagepng($img, 'save.png');
    
            $opt = explode(",", $_POST['options']);
            foreach($opt as $value)
            {
                switch($value)
                {
                    case "joint":
                        $sticker = imagecreatefrompng("../stickers/joint.png");
                        $img = imagecreatefrompng('save.png');
                        imagealphablending($img, TRUE);
                        imagesavealpha($img, TRUE);
                        $sticker = imagescale($sticker, 90, 90);
                        imagesavealpha($sticker, TRUE);
                        imagecopy($img, $sticker, 210, 290, 0, 0, 90, 90);
                        imagepng($img, 'save.png');
                        break;
                    case "shades":
                        $sticker = imagecreatefrompng("../stickers/shades_front.png");
                        $img = imagecreatefrompng('save.png');
                        imagealphablending($img, TRUE);
                        imagesavealpha($img, TRUE);
                        $sticker = imagescale($sticker, 170, 170);
                        imagesavealpha($sticker, TRUE);
                        imagecopy($img, $sticker, 230, 140, 0, 0, 170, 170);
                        imagepng($img, 'save.png');
                        break;
                    case "text":
                        $sticker = imagecreatefrompng("../stickers/thug_life_text.png");
                        $img = imagecreatefrompng('save.png');
                        imagealphablending($img, TRUE);
                        imagesavealpha($img, TRUE);
                        $sticker = imagescale($sticker, 200, 200);
                        imagesavealpha($sticker, TRUE);
                        imagecopy($img, $sticker, 20, 10, 0, 0, 200, 200);
                        imagepng($img, 'save.png');
                        break;
                }
            }

            $object = new Dbh;
            $pdo = $object->connect();
            $object->createImgStoreTb($pdo);
            $img = base64_encode(file_get_contents('save.png'));
            //$object->insertImgIntoDb($pdo, $img[1], $uname);
            $object->insertImgIntoDb($pdo, $img, $uname);
            echo "Your image was uploaded";
            unlink('save.png');
        }
        else
            echo "file not set";
    }
    else
        echo "not logged in";

    // BEFORE THERE WAS AJAX THERE WAS THIS
    //
    // if (isset($_POST['nm-submit-preex']))
    // {   
    //     if (!empty($_FILES['img-upload']['name']))
    //     {
    //         $target_dir = "uploads/";   
    //         $target_file = $target_dir . basename($_FILES['img-upload']['name']);

    //         $object = new Dbh;
    //         $pdo = $object->connect();
    //         $object->createImgStoreTb($pdo);

    //         $img = $_FILES['img-upload']['name'];
    //         session_start();
    //         $uname = $_SESSION['username'];
    //         $object->insertImgIntoDb($pdo, $img, $uname);

    //         header('Location: ../gallery.php?image=preex_successfully_saved_to_database');
    //     }
    //     else
    //     header('Location: ../upload_img.php?image=no_file_selected');    
    // }
    // else if (isset($_POST['submit-img-button']))
    // {
    //     $imgString = $_POST['submit-img-button'];
    //     //echo $imgString;

    //     if (!empty($imgString))
    //     {
    //         $object = new Dbh;
    //         $pdo = $object->connect();
    //         $object->createImgStoreTb($pdo);
    //         session_start();
    //         $uname = $_SESSION['username'];
    //         $object->insertImgIntoDb($pdo, $imgString, $uname);
            
    //         header('Location: ../gallery.php?image=wci_successfully_saved_to_database');
    //         //print_r($_POST);
    //     }
    //     else
    //         header('Location: ../upload_img.php?image=not_img_selected');    
    // }
    // else
    //     header('Location: ../upload_img.php?image=not_saved_to_database');
