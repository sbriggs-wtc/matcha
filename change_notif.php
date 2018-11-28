<?php
require "header.php";
?>
<main>
<div class="wrapper_main">
    <section class="section_default">
        <h1>Sign Up</h1>
        <form action="includes/change_notif.inc.php" method="post" autocomplete="off"><br>
            <section id="checkbox1"><input class="input_field" type="checkbox" name="notif">Receive notifications</section><br>
            <input class="input_field" type="password"    name="pwd" placeholder="Password"><br/>
            <button type="submit"   name="changeNotifSubmit" value="changeNotifSubmit1">Change</button>
        </form>
    </section>
</div>
</main>
<?php
require "footer.php"
?>