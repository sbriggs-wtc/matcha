<?php
    require "header.php";
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Sign Up</h1>
            <form action="includes/signup.inc.php" method="post" autocomplete="off"><br>
                <input type="text" name="name" placeholder="Username"><br>

                <input type="text" name="fname" placeholder="First Name"><br>
                <input type="text" name="lname" placeholder="Last Name"><br>

                <input type="email" name="mail" placeholder="E-mail"><br>
                <input type="password" name="pwd" placeholder="Password"><br>
                <input type="password" name="pwd_repeat" placeholder="Repeat password"><br>
                <section id="checkbox1"><input type="checkbox" name="notif" placeholder="Notif">Receive notifications</section><br>
                <button type="submit" name="signup_submit" value="signup_submit1">Sign Up</button>
            </form>
        </section>
    </div>
</main>
<?php
    require "footer.php"
?>