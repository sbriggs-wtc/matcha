<?php
    require "header.php";
    require "config/dbh.php";
    $user_being_checked_name = $_GET['userbeingchecked'];

    $object = new Dbh;
    $pdo = $object->connect();
    $row = $object->findNameMatch($pdo, $user_being_checked_name);
    $src = $object->selectImgById($pdo, $row['id_profile_pic']);
    
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Profile</h1>
            <?php
                $img_type = "data:image/png; base64, ";
                if (!empty($src))
                {
                    echo '<div><img alt="profile_pic" src="' . $img_type . $src[0][1] .'"/><br/>';
                }
                else
                {
                    echo '<p>Profile image not available</p>';
                }
            ?>
            <table>
                <tr><td>User Name: <?php echo $row['user_name'] ?></td></tr>
                <tr><td>First Name: <?php echo $row['first_name'] ?></td></tr>
                <tr><td>Last Name: <?php echo $row['last_name'] ?></td></tr>
                <tr><td>Fame Rating: <?php echo $row['fame_rating'] ?></td></tr>
                <tr><td>Gender: <?php echo $row['gender'] ?></td></tr>
                <tr><td>Sexual Preference: <?php echo $row['sexual_preference'] ?></td></tr>
                <tr><td>Biography: <?php echo $row['biography'] ?></td></tr>
                <tr><td>Age: <?php echo $row['age'] ?></td></tr>
                <tr><td>Interest 1: <?php echo $row['interest_1'] ?></td></tr>
                <tr><td>Interest 2: <?php echo $row['interest_2'] ?></td></tr>
                <tr><td>Interest 3: <?php echo $row['interest_3'] ?></td></tr>
                <tr><td>Location: <?php echo $row['location'] ?></td></tr>
                <tr><td>Currently Connected?: <?php echo $row['is_connected'] ?></td></tr>
                <tr><td>Last Connection: <?php echo $row['last_conn'] ?></td></tr>
            </table>
            <input type="button" value="Like">
            <input type="button" value="Unlike">
            <input type="button" value="Block">
        </section>        
    </div>
</main>
<script src="js/checkprof.js"></script>
<?php
    require "footer.php"
?>