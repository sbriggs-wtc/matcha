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
    $loginAccInfo = $object->selectUserProfile($pdo, $_SESSION['username']);

    $j = 0;
    for($i = 0; !empty($rows[$i]); $i++)
    {
        if($rows[$i]['is_blocked'] != 1)
        {
            if ($_SESSION['username'] != $rows[$i]['user_name'])
            {
                if ($_SESSION['location'] == $rows[$i]['location'])
                {
                    if ($_SESSION['sexual_preference'] == $rows[$i]['gender'] || $_SESSION['sexual_preference'] === 'Both')
                    {
                        $fame_rating = count($object->fetchUserLikes($pdo, $rows[$i]['user_name']));

                        $newArr[$j]['user_name'] = $rows[$i]['user_name'];
                        $newArr[$j]['fame_rating'] = $fame_rating;
                        $newArr[$j]['gender'] = $rows[$i]['gender'];
                        $newArr[$j]['sexual_preference'] = $rows[$i]['sexual_preference'];
                        $newArr[$j]['age'] = $rows[$i]['age'];
                        $newArr[$j]['interest_1'] = $rows[$i]['interest_1'];
                        $newArr[$j]['interest_2'] = $rows[$i]['interest_2'];
                        $newArr[$j]['interest_3'] = $rows[$i]['interest_3'];
                        $newArr[$j]['location'] = $rows[$i]['location'];

                        $compIndex = 0;

                        if ($newArr[$j]['interest_1'] == $loginAccInfo[0]['interest_1'] || 
                            $newArr[$j]['interest_1'] == $loginAccInfo[0]['interest_2'] ||
                            $newArr[$j]['interest_1'] == $loginAccInfo[0]['interest_3'])
                        {
                            $compIndex++;
                        }

                        if ($newArr[$j]['interest_2'] == $loginAccInfo[0]['interest_1'] || 
                            $newArr[$j]['interest_2'] == $loginAccInfo[0]['interest_2'] ||
                            $newArr[$j]['interest_2'] == $loginAccInfo[0]['interest_3'])
                        {
                            $compIndex++;
                        }

                        if ($newArr[$j]['interest_3'] == $loginAccInfo[0]['interest_1'] || 
                            $newArr[$j]['interest_3'] == $loginAccInfo[0]['interest_2'] ||
                            $newArr[$j]['interest_3'] == $loginAccInfo[0]['interest_3'])
                        {
                            $compIndex++;
                        }

                        $newArr[$j]['compatibility_index'] = $compIndex;
                        $j++;
                    }
                }
            }
        }
    }
    echo '</table>';

    $col_uname = array_column($newArr, 'user_name');
    $col_fame_rating = array_column($newArr, 'fame_rating');
    $col_gender = array_column($newArr, 'gender');
    $col_sex_pref = array_column($newArr, 'sexual_preference');
    $col_age = array_column($newArr, 'age');
    $col_int1 = array_column($newArr, 'interest_1');
    $col_int2 = array_column($newArr, 'interest_2');
    $col_int3 = array_column($newArr, 'inrerest_3');
    $col_loc = array_column($newArr, 'location');
    $col_comp_ind = array_column($newArr, 'compatibility_index');


    array_multisort($col_comp_ind, SORT_DESC, $col_fame_rating, SORT_DESC, $newArr);

    echo '<table>';
    echo '<tr>';
    echo '<th>User Name</th>';
    echo '<th>fame rating</th>';
    echo '<th>gender</th>';
    echo '<th>sexual pref</th>';
    echo '<th>age</th>';
    echo '<th>Interest 1</th>';
    echo '<th>Interest 2</th>';
    echo '<th>Interest 3</th>';
    echo '<th>Location</th>';
    echo '<th>Compatibility Index</th>';
    echo '<th>Check out profile</th>';
    echo '</tr>';

    for ($j = 0; $j < count($newArr); $j++)
    {
        echo '<tr>';
        echo '<td>' . $newArr[$j]['user_name'] . '</td>';
        echo '<td>' . $newArr[$j]['fame_rating'] . '</td>';
        echo '<td>' . $newArr[$j]['gender'] . '</td>';
        echo '<td>' . $newArr[$j]['sexual_preference'] . '</td>';
        echo '<td>' . $newArr[$j]['age'] . '</td>';
        echo '<td>' . $newArr[$j]['interest_1'] . '</td>';
        echo '<td>' . $newArr[$j]['interest_2'] . '</td>';
        echo '<td>' . $newArr[$j]['interest_3'] . '</td>';
        echo '<td>' . $newArr[$j]['location'] . '</td>';
        echo '<td>' . $newArr[$j]['compatibility_index'] . '</td>';
        echo '<td>' . '<a href="checkoutprofile.php?userbeingchecked=' . $newArr[$j]['user_name'] . '">Check Out Profile</a>' . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    //LOOP ECHOING PAGINATION
    $page = 1;
    while ($page <= $number_of_pages)
    {
        echo '<a href="profile_suggestions.php?page=' .$page. '">' .$page. '</a> ';
        $page++;
    }
?>
        </section>
    </div>
</main>
<script src="js/gallery.js"></script>
<?php
    require "footer.php"
?>
