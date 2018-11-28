<?php
    require "header.php";
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Change Password</h1>
            <form action="includes/change_pwd.inc.php" method="post" autocomplete="off">
                <input class="input_field" type="password"      name="pwd_old"   placeholder="Old password"><br/>
                <input class="input_field" type="password"    name="pwd_new" placeholder="New Password"><br/>
                <input class="input_field" type="password"    name="pwd_new_re" placeholder="Repeat New Password"><br/>
                <button type="submit"   name="ch_pwd_submit" value="ch_pwd_submit1">Change Password</button>
            </form>            
        </section>
    </div>
</main>
<?php
    require "footer.php"
?>