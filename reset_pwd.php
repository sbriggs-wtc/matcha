<?php
?>
 
<main>
    <div class="wrapper_main">
    <section class="section_default">
        <h1>Reset Password</h1>
        <form  method="post" action="includes/reset_pwd.inc.php?hashKey=<?php echo $_GET['hashKey'];?>">
            <input type="password"      name="pwdNew"   placeholder="New Password"><br/>
            <input type="password"      name="pwdNewRe"   placeholder="Repeat Password"><br/>
            <button type="submit" name="resetPwdSubmit" value="resetPwdSubmit1">
            Reset my password
            </button>
        </form>
    </section>
</div>
</main>


<?php
?>
