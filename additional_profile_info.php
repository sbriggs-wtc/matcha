<?php
    require "header.php";
    require "config/dbh.php";

    $object = new Dbh;
    $pdo = $object->connect();
    $rows = $object->fetchAllInterests($pdo);

?>

<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Additional Profile Info</h1>
            <form autocomplete="off" action="includes/additional_profile_info.inc.php" method="post" autocomplete="off">

                <label>Your Gender</label><br/>
                <input class="input_field" type="radio" name="gender" value="Male">Male<br/>
                <input class="input_field" type="radio" name="gender" value="Female">Female<br/><br/>

                <label>Your Sexual Preference</label><br/>
                <input class="input_field" type="radio" name="sex" value="Male">Male<br/>
                <input class="input_field" type="radio" name="sex" value="Female">Female<br/>
                <input class="input_field" type="radio" name="sex" value="Both">Both<br/><br/>

                <label>Your Age</label><br/>
                <input class="input_field" type="number" name="age" style="width:500px;" value=""><br/><br/>

                <label>Short Biography</label><br/>
                <input type="text" name="bio" style="width:500px; height:200px;"><br/><br/>

                <label>Your Location (Nearest City)</label><br/>
                <input type="text" name="location" style="width:500px;"><br/><br/>
                
                <label>Some Of Your Interests</label><br/><br/>
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput1" type="text" name="int1" placeholder="Interest 1">
                </div>
                
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput2" type="text" name="int2" placeholder="Interest 2">
                </div>
                
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput3" type="text" name="int3" placeholder="Interest 3">
                </div>
                
                </div><br/><br/>

                <input type="submit" name="add_inf_submit" value="Submit">
            </form><br/>

            <h3>Some suggested interests</h3>
            <?php
                
            
            echo '<table>';
            for ($i = 0; !empty($rows[$i][1]); $i++)
            {
                echo '<tr><td>' . $rows[$i][1] . '</td></tr>';
            }
            echo '</table>';
            ?>
        </section>        
    </div>
</main>
<?php
    require "footer.php"
?>