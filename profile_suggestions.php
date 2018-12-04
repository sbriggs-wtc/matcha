<?php
    require "header.php";
    include_once 'config/dbh.php';
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Gallery</h1>
            <?php

            $object = new Dbh;
            $pdo = $object->connect();
            $rows = $object->selectImgsFromDb($pdo);

            //VARS FOR PAGINATION
            $results_per_page = 100;
            $number_of_results = count($rows);
            $number_of_pages = ceil($number_of_results / $results_per_page);
            if (!isset($_GET['page']))
                $page = 1;
            else
                $page = $_GET['page'];
            $this_page_first_result = ($page - 1) * $results_per_page;

            $rows = $object->selectLimitUserProfiles($pdo, $this_page_first_result, $results_per_page);

            //print_r($rows);
            print_r($_SESSION);
            echo '<table>';
            echo '<tr>';
            //echo '<th>Id</th>';
            echo '<th>User Name</th>';
            //echo '<th>F Name</th>';
            //echo '<th>L Name</th>';
            //echo '<th>Email</th>';
            //echo '<th>Password</th>';
            //echo '<th>Hashkey</th>';
            //echo '<th>active</th>';
            //echo '<th>notifications</th>';
            echo '<th>fame rating</th>';
            echo '<th>gender</th>';
            echo '<th>sexual pref</th>';
            //echo '<th>biography</th>';
            echo '<th>age</th>';
            echo '<th>Interest 1</th>';
            echo '<th>Interest 2</th>';
            echo '<th>Interest 3</th>';
            echo '<th>Interest 4</th>';
            echo '<th>Interest 5</th>';
            echo '<th>Location</th>';
            echo '<th>Check out profile</th>';
            echo '</tr>';
                    for($i = 0; !empty($rows[$i]); $i++)
                    {
            
            
                        if ($_SESSION['location'] == $rows[$i]['location'])
                        {
                            // if ($_SESSION['sexual_preference'] === 'Both')
                            // {
                            //     echo '<tr>';
                            //         echo '<td>' . $rows[$i]['user_name'] . '</td>';
                            //         // echo '<td>' . $rows[$i][2] . '</td>';
                            //         // echo '<td>' . $rows[$i][3] . '</td>';
                            //         // echo '<td>' . $rows[$i][4] . '</td>';
                            //         // echo '<td>' . $rows[$i][5] . '</td>';
                            //         // echo '<td>' . $rows[$i][6] . '</td>';
                            //         // echo '<td>' . $rows[$i][7] . '</td>';
                            //         // echo '<td>' . $rows[$i][8] . '</td>';
                            //         echo '<td>' . $rows[$i]['fame_rating'] . '</td>';
                            //         echo '<td>' . $rows[$i]['gender'] . '</td>';
                            //         echo '<td>' . $rows[$i]['sexual_preference'] . '</td>';
                            //         // echo '<td>' . $rows[$i][12] . '</td>';
                            //         echo '<td>' . $rows[$i]['age'] . '</td>';
                            //         echo '<td>' . $rows[$i]['interest_1'] . '</td>';
                            //         echo '<td>' . $rows[$i]['interest_2'] . '</td>';
                            //         echo '<td>' . $rows[$i]['interest_3'] . '</td>';
                            //         echo '<td>' . $rows[$i]['interest_4'] . '</td>';
                            //         echo '<td>' . $rows[$i]['interest_5'] . '</td>';
                            //         echo '<td>' . $rows[$i]['location'] . '</td>';
                            //         // echo '<td>' . $rows[$i][20] . '</td>';
                            //         echo '<td>' . '<a href="checkoutprofile.php?' . $rows[$i][0] . '">Check Out Profile</a>' . '</td>';
                            //     echo '</tr>';
                            // }                            
                            //else
                            if ($_SESSION['sexual_preference'] == $rows[$i]['gender'] || $_SESSION['sexual_preference'] === 'Both')
                            {
                                echo '<tr>';
                                    echo '<td>' . $rows[$i]['user_name'] . '</td>';
                                    // echo '<td>' . $rows[$i][2] . '</td>';
                                    // echo '<td>' . $rows[$i][3] . '</td>';
                                    // echo '<td>' . $rows[$i][4] . '</td>';
                                    // echo '<td>' . $rows[$i][5] . '</td>';
                                    // echo '<td>' . $rows[$i][6] . '</td>';
                                    // echo '<td>' . $rows[$i][7] . '</td>';
                                    // echo '<td>' . $rows[$i][8] . '</td>';
                                    echo '<td>' . $rows[$i]['fame_rating'] . '</td>';
                                    echo '<td>' . $rows[$i]['gender'] . '</td>';
                                    echo '<td>' . $rows[$i]['sexual_preference'] . '</td>';
                                    // echo '<td>' . $rows[$i][12] . '</td>';
                                    echo '<td>' . $rows[$i]['age'] . '</td>';
                                    echo '<td>' . $rows[$i]['interest_1'] . '</td>';
                                    echo '<td>' . $rows[$i]['interest_2'] . '</td>';
                                    echo '<td>' . $rows[$i]['interest_3'] . '</td>';
                                    echo '<td>' . $rows[$i]['interest_4'] . '</td>';
                                    echo '<td>' . $rows[$i]['interest_5'] . '</td>';
                                    echo '<td>' . $rows[$i]['location'] . '</td>';
                                    // echo '<td>' . $rows[$i][20] . '</td>';
                                    echo '<td>' . '<a href="checkoutprofile.php?userbeingchecked=' . $rows[$i]['user_name'] . '">Check Out Profile</a>' . '</td>';
                                echo '</tr>';
                            }
                        }
                    }
            echo '</table>';




            //$imgSrc = $object->selectUserProfPic($pdo, $this_page_first_result, $results_per_page);


            //LOOP ECHOING IMG DIVS
            // $i = 0;
            // while (!empty($rows[$i]))
            // {
            //     // $src = $rows[$i][1];
            //     // $imgId = $rows[$i][0];
            //     // $imgNmOwner = $rows[$i][2];
            //     // $img_type = "data:image/png; base64, ";
            //     // echo '<div><img alt="row" src="' . $img_type . $src .'"/><br/>';
            //     // $rowsComments = $object->selectCommentsFromDb($pdo, $imgId);

            //     // echo'</div class="sugg_profile">
            //     //         <input id="id-img-id" type="hidden" value="" name="img-id">
            //     //         <input id="id-img-owner" type="hidden" value="" name="img-owner">
            //     //         <input onclick="saveComment(this.id, \''.$imgNmOwner.'\')" id="' .$imgId. '" type="submit" value="Submit Comment">
            //     //         <input onclick="like(this.id)" id="' .$imgId. '"type="submit" value="Like">
            //     //         <input onclick="unLike(this.id)" id="' .$imgId. '"type="submit" value="Unlike">';
            //     // echo'</div>';
                
            //     $i++;
            // }

            //LOOP ECHOING PAGINATION
            // $page = 1;
            // while ($page <= $number_of_pages)
            // {
            //     echo '<a href="gallery.php?page=' .$page. '">' .$page. '</a> ';
            //     $page++;
            // }
            ?>
        </section>
    </div>
</main>
<script src="js/gallery.js"></script>
<?php
    require "footer.php"
?>
