<?php


class Dbh
{
    public function connect()
    {
        include_once("database.php");
        try
        {            
            $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME");
            $pdo->exec("USE $DB_NAME");
            return $pdo;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " .$e->getMessage();
        }
    }

    public function createAccDetailsTb($pdo)
    {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `db_matcha`.`tb_accounts`(
            `id` INT NOT NULL AUTO_INCREMENT ,
            `user_name` VARCHAR(255) NULL DEFAULT NULL ,
            `first_name` VARCHAR(255) NULL DEFAULT NULL ,
            `last_name` VARCHAR(255) NULL DEFAULT NULL ,
            `email_addr` VARCHAR(255) NULL DEFAULT NULL ,
            `password` VARCHAR(255) NULL DEFAULT NULL ,
            `hash_key` VARCHAR(255) NULL DEFAULT NULL , 
            `active` BOOLEAN NULL DEFAULT FALSE,    
            `notifications` BOOLEAN NULL DEFAULT FALSE,
            `fame_rating` VARCHAR(255) NULL DEFAULT NULL , 
            `gender` VARCHAR(255) NULL DEFAULT NULL ,
            `sexual_preference` VARCHAR(255) NULL DEFAULT NULL ,  
            `biography` VARCHAR(255) NULL DEFAULT NULL , 
            `interest_1` VARCHAR(255) NULL DEFAULT NULL , 
            `interest_2` VARCHAR(255) NULL DEFAULT NULL , 
            `interest_3` VARCHAR(255) NULL DEFAULT NULL , 
            `interest_4` VARCHAR(255) NULL DEFAULT NULL , 
            `interest_5` VARCHAR(255) NULL DEFAULT NULL , 
            `location` VARCHAR(255) NULL DEFAULT NULL ,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    }

    public function checkNameIsTaken($pdo, $name)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_accounts` WHERE `user_name` = :username LIMIT 1");
        $statement->bindParam(":username", $name);
        $statement->execute();
        $rows = $statement->fetch();
        if($rows)
            return true;
        else
            return false;
    }

    public function insertAccDetails($pdo, $name, $fname, $lname, $mail, $pwd, $hashKey, $notif)
    {
        $statement = $pdo->prepare(
            "INSERT INTO `tb_accounts` (`id`, `user_name`, `first_name`, `last_name`, `email_addr`, `password`, `hash_key`, `active`, `notifications`)
            VALUES (NULL, :uname, :fname, :lname, :mail, :pwd, :hashkey, 0, :notif);");
        $statement->bindParam(":uname", $name);
        $statement->bindParam(":fname", $fname);
        $statement->bindParam(":lname", $lname);
        $statement->bindParam(":mail", $mail);
        $statement->bindParam(":pwd", $pwd);
        $statement->bindParam(":hashkey", $hashKey);
        $statement->bindParam(":notif", $notif);
        $statement->execute();
    }

    public function findKeyMatch($pdo, $hashKey)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_accounts` WHERE `hash_key` = :hashkey LIMIT 1");
        $statement->bindParam(":hashkey", $hashKey);
        $statement->execute();
        $row = $statement->fetch();
        return ($row);
    }

    public function activateAcc($pdo, $hashKey)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET `active` = '1' WHERE `tb_accounts`.`hash_key` = :hashkey");
        $statement->bindParam(":hashkey", $hashKey);
        $statement->execute();
    }

    public function findNameMatch($pdo, $name)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_accounts` WHERE `user_name` = :username LIMIT 1");
        $statement->bindParam(":username", $name);
        $statement->execute();
        $row = $statement->fetch();
        return ($row);
    }

    public function updateAccName($pdo, $currName, $newName)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET `user_name` = :nwname WHERE `tb_accounts`.`user_name` = :currname");
        $statement->bindParam(":nwname", $newName);
        $statement->bindParam(":currname", $currName);
        $statement->execute();
    }

    public function updateAccPwd($pdo, $uName, $pwdNew)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET `password` = :pwd WHERE `tb_accounts`.`user_name` = :uname");
        $statement->bindParam(":uname", $uName);
        $statement->bindParam(":pwd", $pwdNew);
        $statement->execute();
    }

    public function updateAccEmail($pdo, $uName, $email)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET `email_addr` = :email WHERE `tb_accounts`.`user_name` = :uname");
        $statement->bindParam(":uname", $uName);
        $statement->bindParam(":email", $email);
        $statement->execute();
    }
    public function updateAccNotif($pdo, $uName, $notif)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET `notifications` = :notif WHERE `tb_accounts`.`user_name` = :uname");
        $statement->bindParam(":uname", $uName);
        $statement->bindParam(":notif", $notif);
        $statement->execute();
    }

    public function updateResetAccPwd($pdo, $hashKey, $pwdNew)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET `password` = :pwd WHERE `tb_accounts`.`hash_key` = :hkey");
        $statement->bindParam(":hkey", $hashKey);
        $statement->bindParam(":pwd", $pwdNew);
        $statement->execute();
    }

    public function createImgStoreTb($pdo)
    {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `db_matcha`.`tb_images` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `image` LONGTEXT NULL DEFAULT NULL , 
            `user_name` VARCHAR(255) NULL DEFAULT NULL , 
            PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    }

    public function insertImgIntoDb($pdo, $img, $uname)
    {
        $statement = $pdo->prepare("INSERT INTO `tb_images` (`image`, `user_name`)VALUES (:img, :uname);");
        $statement->bindParam(":img", $img);
        $statement->bindParam(":uname", $uname);
        $statement->execute();
    }

    public function selectImgsFromDb($pdo)
    {
        $statement = $pdo->prepare("SELECT `image` FROM `tb_images` ORDER BY `id` DESC");
        $statement->execute();
        $rows = $statement->fetchAll();
        return ($rows);
    }

    public function selectLimitImgsFromDb($pdo, $this_page_first_result, $results_per_page)
    {
        $statement = $pdo->prepare("SELECT `id`,`image`,`user_name` FROM `tb_images` ORDER BY `id` DESC LIMIT $this_page_first_result , $results_per_page");
        $statement->execute();
        $rows = $statement->fetchAll();
        return ($rows);
    }
    public function createCommentsTb($pdo)
    {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `db_matcha`.`tb_comments` (
                `id` INT NOT NULL AUTO_INCREMENT , 
                `img_id` INT NULL DEFAULT NULL , 
                `img_owner` VARCHAR(255) NULL DEFAULT NULL , 
                `commentator` VARCHAR(255) NULL DEFAULT NULL , 
                `comment` TEXT NULL DEFAULT NULL , 
                PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    }
    public function insertComment($pdo, $img_id, $img_owner, $commentator, $comment)
    {
        $statement = $pdo->prepare("    INSERT INTO `tb_comments` (`img_id`, `img_owner`, `commentator`, `comment`)
                                        VALUES      (:imgid, :imgowner, :commentator, :comment);");
        $statement->bindParam(":imgid", $img_id);
        $statement->bindParam(":imgowner", $img_owner);
        $statement->bindParam(":commentator", $commentator);
        $statement->bindParam(":comment", $comment);
        $statement->execute();
    }
    public function selectCommentsFromDb($pdo, $imgId)
    {
        $statement = $pdo->prepare(
        "SELECT `id`,`img_id`,`img_owner`, `commentator`, `comment` 
        FROM `tb_comments` WHERE `img_id` = :img_id ORDER BY `id` DESC");
        $statement->bindParam(":img_id", $imgId);
        $statement->execute();
        $rows = $statement->fetchAll();
        return ($rows);
    }
    public function createLikesTb($pdo)
    {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `db_matcha`.`tb_likes` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `img_id` INT NULL DEFAULT NULL , 
            `liker` VARCHAR(255) NULL DEFAULT NULL , 
            `like` INT NULL DEFAULT NULL ,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    }

    public function checkIfAlreadyLikes($pdo, $imgId, $liker)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_likes` WHERE `liker` = :liker AND `img_id` = :imgid");
        $statement->bindParam(":liker", $liker);
        $statement->bindParam(":imgid", $imgId);
        $statement->execute();
        $row = $statement->fetchAll();
        return ($row);
    }

    public function insertLikes($pdo, $imgId, $liker)
    {
        $statement = $pdo->prepare("    INSERT INTO `tb_likes` (`img_id`, `liker`, `like`)
                                        VALUES      (:imgid , :liker, 1);");
        $statement->bindParam(":imgid", $imgId);
        $statement->bindParam(":liker", $liker);
        $statement->execute();
    }
    public function selectCommentatorNotifEmail($pdo, $commentator)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_accounts` WHERE `user_name` = :uname LIMIT 1");
        $statement->bindParam(":uname", $commentator);
        $statement->execute();
        $row = $statement->fetchAll();
        return ($row);
    }
    public function selectUserImgsFromDb($pdo, $uName)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_images` WHERE `user_name` = :uname");
        $statement->bindParam(":uname", $uName);
        $statement->execute();
        $row = $statement->fetchAll();
        return ($row);
    }

    public function selectUserImgsFromDbRecent($pdo, $uName)
    {
        $statement = $pdo->prepare("SELECT * FROM `tb_images` WHERE `user_name` = :uname ORDER BY `id` DESC LIMIT 5 ");
        $statement->bindParam(":uname", $uName);
        $statement->execute();
        $row = $statement->fetchAll();
        return ($row);
    }

    public function isDelImage($pdo, $imgId)
    {
        $statement = $pdo->prepare("DELETE FROM `tb_images` WHERE `tb_images`.`id` = :imgid");
        $statement->bindParam(":imgid", $imgId);
        $statement->execute();
        $row = $statement->rowCount();
        if ($row == 1)
            return true;
        else
            return false;
    }

    public function updateAccAddInfo($pdo, $uname, $gender, $sex, $bio, $int1, $int2, $int3, $int4, $int5)
    {
        $statement = $pdo->prepare("UPDATE `tb_accounts` SET 
        `gender` = :gender, 
        `sexual_preference` = :sex,
        `biography` = :bio,
        `interest_1` = :int1,
        `interest_2` = :int2,
        `interest_3` = :int3,
        `interest_4` = :int4,
        `interest_5` = :int5
        WHERE `tb_accounts`.`user_name` = :uname");

        $statement->bindParam(":uname", $uname);
        $statement->bindParam(":gender", $gender);
        $statement->bindParam(":sex", $sex);
        $statement->bindParam(":bio", $bio);
        $statement->bindParam(":int1", $int1);
        $statement->bindParam(":int2", $int2);
        $statement->bindParam(":int3", $int3);
        $statement->bindParam(":int4", $int4);
        $statement->bindParam(":int5", $int5);
        $statement->execute();
    }
}