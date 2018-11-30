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
            $results_per_page = 5;
            $number_of_results = count($rows);
            $number_of_pages = ceil($number_of_results / $results_per_page);
            if (!isset($_GET['page']))
                $page = 1;
            else
                $page = $_GET['page'];
            $this_page_first_result = ($page - 1) * $results_per_page;




            $rows = $object->selectLimitImgsFromDb($pdo, $this_page_first_result, $results_per_page);




            //LOOP ECHOING IMG DIVS
            $i = 0;
            while (!empty($rows[$i]))
            {
                $src = $rows[$i][1];
                $imgId = $rows[$i][0];
                $imgNmOwner = $rows[$i][2];
                $img_type = "data:image/png; base64, ";
                echo '<div><img alt="row" src="' . $img_type . $src .'"/><br/>';//<div><h3>Comments:</h3>';
                $rowsComments = $object->selectCommentsFromDb($pdo, $imgId);

                //LOOP ECHOING COMMENTS
                // $j = 0;
                // while (!empty($rowsComments[$j]))
                // {
                //     echo '<pre>'.$rowsComments[$j]['commentator'].":  ".$rowsComments[$j][4].'</pre>';
                //     $j++; 
                // }

                // echo'</div><input id="id-img-id" type="hidden" value="" name="img-id">
                //     <input id="id-img-owner" type="hidden" value="" name="img-owner">
                //     <textarea id="' .$imgId. '" name="comment" cols="40" rows="4" placehoder="leave a comment"></textarea><br/>
                //     <input onclick="saveComment(this.id, \''.$imgNmOwner.'\')" id="' .$imgId. '" type="submit" value="Submit Comment">
                //     <input onclick="like(this.id)" id="' .$imgId. '"type="submit" value="Like">';
                //echo'</div>';
                
                    if (isset($_SESSION['username']) && $_SESSION['username'] == $imgNmOwner)
                        echo '<input onclick="setProfPic(this.id)" id="' .$imgId. '"type="submit" value="Set As Profile Picture">';
                        echo '<input onclick="delImg(this.id)" id="' .$imgId. '"type="submit" value="Delete"></div>';
                $i++;
            }

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
