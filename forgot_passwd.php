<?php
    require "header.php";
    
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Forgot Password?</h1>
            <form action="includes/forgot_passwd.inc.php" method="post" autocomplete="off">
                <input type="text"      name="loginName"   placeholder="Username..."><br/>
                <button type="submit" name="forgetPwdSubmit" value="forgetPwdSubmit1">
                Send unique link to my email address
                </button>
            </form>
        </section>
    </div>
</main>
<?php
    require "footer.php";
?>
