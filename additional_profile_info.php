<?php
    require "header.php";
?>

<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Additional Profile Info</h1>
            <form action="includes/additional_profile_info.inc.php" method="post" autocomplete="off">
                <label>Your Gender</label><br/>
                <input class="input_field" type="radio" name="gender" value="Male">Male<br/>
                <input class="input_field" type="radio" name="gender" value="Female">Female<br/><br/>

                <label>Your Sexual Preference</label><br/>
                <input class="input_field" type="radio" name="sex" value="Male">Male<br/>
                <input class="input_field" type="radio" name="sex" value="Female">Female<br/>
                <input class="input_field" type="radio" name="sex" value="Both">Both<br/><br/>

                <label>Short Biography</label><br/>
                <input type="text" name="bio"><br/><br/>

                <label>Some Stuff You Are Interested In</label><br/>
                <!--<input type="text" name="interest_1"><br/>
                <input type="text" name="interest_2"><br/>
                <input type="text" name="interest_3"><br/>
                <input type="text" name="interest_4"><br/>
                <input type="text" name="interest_5"><br/><br/>-->

                <select name="interest_1">
                    <option value="none">None</option>
                    <option value="cats">#cats</option>
                    <option value="dogs">#dogs</option>
                    <option value="elephants">#elephants</option>
                    <option value="alligators">#alligators</option>
                    <option value="meerkats">#meerkats</option>
                    <option value="none">#llamas</option>
                    <option value="cats">#sloths</option>
                    <option value="dogs">#gorillas</option>
                    <option value="elephants">#killer_whales</option>
                    <option value="alligators">#insects</option>
                    <option value="meerkats">#gold_fish</option>
                </select><br/>
                <select name="interest_2">
                    <option value="none">None</option>
                    <option value="cats">#cats</option>
                    <option value="dogs">#dogs</option>
                    <option value="elephants">#elephants</option>
                    <option value="alligators">#alligators</option>
                    <option value="meerkats">#meerkats</option>
                    <option value="none">#llamas</option>
                    <option value="cats">#sloths</option>
                    <option value="dogs">#gorillas</option>
                    <option value="elephants">#killer_whales</option>
                    <option value="alligators">#insects</option>
                    <option value="meerkats">#gold_fish</option>
                </select><br/>
                <select name="interest_3">
                    <option value="none">None</option>
                    <option value="cats">#cats</option>
                    <option value="dogs">#dogs</option>
                    <option value="elephants">#elephants</option>
                    <option value="alligators">#alligators</option>
                    <option value="meerkats">#meerkats</option>
                    <option value="none">#llamas</option>
                    <option value="cats">#sloths</option>
                    <option value="dogs">#gorillas</option>
                    <option value="elephants">#killer_whales</option>
                    <option value="alligators">#insects</option>
                    <option value="meerkats">#gold_fish</option>
                </select><br/>
                <select name="interest_4">
                    <option value="none">None</option>
                    <option value="cats">#cats</option>
                    <option value="dogs">#dogs</option>
                    <option value="elephants">#elephants</option>
                    <option value="alligators">#alligators</option>
                    <option value="meerkats">#meerkats</option>
                    <option value="none">#llamas</option>
                    <option value="cats">#sloths</option>
                    <option value="dogs">#gorillas</option>
                    <option value="elephants">#killer_whales</option>
                    <option value="alligators">#insects</option>
                    <option value="meerkats">#gold_fish</option>
                </select><br/>
                <select name="interest_5">
                    <option value="none">None</option>
                    <option value="cats">#cats</option>
                    <option value="dogs">#dogs</option>
                    <option value="elephants">#elephants</option>
                    <option value="alligators">#alligators</option>
                    <option value="meerkats">#meerkats</option>
                    <option value="none">#llamas</option>
                    <option value="cats">#sloths</option>
                    <option value="dogs">#gorillas</option>
                    <option value="elephants">#killer_whales</option>
                    <option value="alligators">#insects</option>
                    <option value="meerkats">#gold_fish</option>
                </select><br/><br/>

                <label>Your Location</label><br/>
                <input type="text" name="location"><br/>

                <button type="submit"   name="add_inf_submit" value="changeNameSubmit">Submit</button>
            </form>         
        </section>        
    </div>
</main>

<?php
    require "footer.php"
?>