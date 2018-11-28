<?php
    require "header.php";
?>
<main>
    <div class="wrapper_main">
    <section class="section_default">
        <h1>Change Name</h1>
        <form action="includes/change_name.inc.php" method="post" autocomplete="off">
            <input class="input_field" type="text"    name="newName" placeholder="New name"><br/>
            <input class="input_field" type="password"    name="pwd" placeholder="Password"><br/>
            <button type="submit"   name="changeNameSubmit" value="changeNameSubmit">Change Name</button>
        </form>
    </section>
    </div>
</main>
<?php
    require "footer.php"
?>