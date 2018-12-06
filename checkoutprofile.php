<?php
    require "header.php";
    require "config/dbh.php";
    $visitee = $_GET['userbeingchecked'];

    if (!empty($_SESSION['username']))
    {
        $visitor = $_SESSION['username'];
    }
    else
    {
        echo "login not set";
    }

    $object = new Dbh;
    $pdo = $object->connect();
    $row = $object->findNameMatch($pdo, $visitee);
    $src = $object->selectImgById($pdo, $row['id_profile_pic']);
    $fame_rating = count($object->fetchUserLikes($pdo, $visitee));
    $object->newVisit($pdo, $visitor, $row['user_name']);
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Profile</h1>
            <?php
            if(!empty($_SESSION['id_profile_pic']))
            {
                $img_type = "data:image/png; base64, ";
                if (!empty($src))
                {
                    echo '<div><img alt="profile_pic" src="' . $img_type . $src[0][1] .'"/><br/>';
                }
                else
                {
                    echo '<p>Profile image not available</p>';
                }
                    echo '<table>';
                    echo '<tr><td>User Name:' . $row['user_name'] . '</td></tr>';
                    echo '<tr><td>First Name:' . $row['first_name'] . '</td></tr>';
                    echo '<tr><td>Last Name:' . $row['last_name'] . '</td></tr>';
                    echo '<tr><td>Fame Rating:' . $fame_rating . '</td></tr>';
                    echo '<tr><td>Gender:' . $row['gender'] . '</td></tr>';
                    echo '<tr><td>Sexual Preference:' . $row['sexual_preference'] . '</td></tr>';
                    echo '<tr><td>Biography:' . $row['biography'] . '</td></tr>';
                    echo '<tr><td>Age:' . $row['age'] . '</td></tr>';
                    echo '<tr><td>Interest 1:' . $row['interest_1'] . '</td></tr>';
                    echo '<tr><td>Interest 2:' . $row['interest_2'] . '</td></tr>';
                    echo '<tr><td>Interest 3:' . $row['interest_3'] . '</td></tr>';
                    echo '<tr><td>Location:' . $row['location'] . '</td></tr>';
                    echo '<tr><td>Currently Online?:' . $row['is_connected'] . '</td></tr>';
                    echo '<tr><td>Last Seen:' . $row['last_conn'] . '</td></tr>';

                    $rowVisitorLike = $object->findLikeRow($pdo, $visitor, $visitee);
                    $rowVisiteeLike = $object->findLikeRow($pdo, $visitee, $visitor);
                    if (!empty($rowVisitorLike) && !empty($rowVisiteeLike))
                    echo "<tr><td>You are connected to this person</td></tr>";
                    else
                    echo "<tr><td>You are not connected to this person</td></tr>";

                    echo '</table>';
                    echo '<br/>';
                    echo '<form action="includes/matcha_like_block_handle.inc.php" method="post">';

                    if (!empty($rowVisitorLike))
                    {
                        echo "<p>You like this person</p>";
                        echo "<h3>Gallery Images:</h3>";
                        $rowsVisiteeImgs = $object->selectUserImgsFromDb($pdo, $visitee);
                        $i = 0;
                        while (!empty($rowsVisiteeImgs[$i]))
                        {
                            $srcVisiteeImgs = $rowsVisiteeImgs[$i][1];
                            $imgIdVisiteeImgs = $rowsVisiteeImgs[$i][0];
                            $imgNmOwnerVisiteeImgs = $rowsVisiteeImgs[$i][2];
                            $img_typeVisiteeImgs = "data:image/png; base64, ";
                            echo '<div><img alt="row" src="' . $img_typeVisiteeImgs . $srcVisiteeImgs .'"/><br/>';
                            $i++;
                        }
                    }
                    
                    echo '<input type="hidden" name="likee_name" value="' . $row['user_name'] . '">';
                    echo '<input type="submit" name="like" value="Like">';
                    echo '<input type="submit" name="unlike" value="Unlike">';
                    echo '<input type="submit" name="block" value="Report Fake Account / Block">';
                    echo '</form>';
                    echo '<br/>';
            }
            else
            {
                echo "You cannot view this content, please upload a profile pic.";
            }
            ?>
        </section>        
    </div>
</main>
<script src="js/checkprof.js"></script>
<?php
    require "footer.php"
?>