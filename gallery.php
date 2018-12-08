<?php
    require "header.php";
    include_once 'config/dbh.php';
    $uname = $_SESSION['username'];
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Gallery</h1>
<?php

$object = new Dbh;
$pdo = $object->connect();
$rows = $object->selectImgsFromDb($pdo);
$rows = $object->selectUserImgsFromDb($pdo, $uname);
$i = 0;
while (!empty($rows[$i]))
{
    $src = $rows[$i][1];
    $imgId = $rows[$i][0];
    $imgNmOwner = $rows[$i][2];
    $img_type = "data:image/png; base64, ";
    echo '<div><img alt="row" src="' . $img_type . $src .'"/><br/>';
        if (isset($_SESSION['username']) && $_SESSION['username'] == $imgNmOwner)
            echo '<input onclick="setProfPic(this.id)" id="' .$imgId. '"type="submit" value="Set As Profile Picture">';
            echo '<input onclick="delImg(this.id)" id="' .$imgId. '"type="submit" value="Delete"></div>';
    $i++;
}
?>
        </section>
    </div>
</main>
<script src="js/gallery.js"></script>
<?php
    require "footer.php"
?>
