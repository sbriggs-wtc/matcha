<?php
    require "header.php";
    include "config/dbh.php";

?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
        <h1>Consultations</h1>
        
<?php
    if (!empty($_SESSION['username']))
    {
        $curr_user = $_SESSION['username'];
        $object = new Dbh;
        $pdo = $object->connect();
        $rows = $object->fetchVisits($pdo, $curr_user);

        echo '<h3>History of Visits</h3>';
        echo '<table>';
        echo '<tr>';
        echo '<th>Visitor Name</th>';

        for($i = 0; !empty($rows[$i]); $i++)
        {
            echo '<tr>';
                echo '<td>' . $rows[$i]['visitor'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '<br/>';
        echo '<br/>';

        $rows = $object->fetchUserLikes($pdo, $curr_user);

        echo '<h3>History of Likes</h3>';
        echo '<table>';
        echo '<tr>';
        echo '<th>Liker Name</th>';

        for($i = 0; !empty($rows[$i]); $i++)
        {
            echo '<tr>';
                echo '<td>' . $rows[$i]['liker'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    }
?>
        </section>
        </div>
    </main>
    <?php
        require "footer.php"
    ?>