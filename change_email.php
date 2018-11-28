<?php
    require "header.php";
?>
<main>
    <div class="wrapper_main">
    <section class="section_default">
        <h1>Change E-mail Address</h1>
        <form action="includes/change_email.inc.php" method="post" autocomplete="off">
            <input class="input_field" type="email"    name="newEmail" placeholder="New email address"><br/>
            <input class="input_field" type="password"    name="pwd" placeholder="Password"><br/>
            <button type="submit"   name="changeEmailSubmit" value="changeEmailSubmit1">Change E-mail Address</button>
        </form>            
    </section>
    </div>
</main>
<?php
    require "footer.php"
?>