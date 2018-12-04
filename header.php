<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Matcha</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                <?php
                if (isset($_SESSION['username']))
                {
                    echo    '<li><a href="gallery.php">My Gallery</a></li>
                            <li><a href="upload_img.php">Upload An Image</a></li>
                            <li><a href="preferences.php">Preferences</a></li>
                            <li><a href="profile_suggestions.php">Profile Suggestions</a></li>
                            <li><a href="DELETEME.html">TB</a></li>';
                }
                ?>
                </ul>
                
                <?php
                if (isset($_SESSION['username']))
                {
                    echo    '<form action="includes/logout.inc.php " method="post">
                            <button type="submit" name="logout_submit">Logout</button>
                            </form>';
                }
                else
                    echo    '<form action="includes/login.inc.php " method="post" autocomplete="off">
                                <input class="input_field" type="text" style="width:150px;" name="login_name"   placeholder="Username...">
                                <input class="input_field" type="password" style="width:150px;" name="login_hashPwd" placeholder="Password...">
                                <button type="submit"   name="login_submit" value="login_submit1">Login</button>
                                <a href="forgot_passwd.php">Forgot Password?</a>
                            </form>
                            <a href="signup.php">Signup</a>';
            ?>
            <?php
                if (isset($_SESSION['username']))
                    echo '<p>You are logged in as '.$_SESSION['username'].' </p>';
                else
                    echo '<p>You are logged out</p>';
            ?>    
            </nav>
        </header>