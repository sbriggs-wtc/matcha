<?php

//include_once("database.php");
include_once("dbh.php");

$object = new Dbh;
$pdo = $object->connect();
$object->createAccDetailsTb($pdo);
$object->createImgStoreTb($pdo);
$object->createCommentsTb($pdo);
$object->createLikesTb($pdo);
