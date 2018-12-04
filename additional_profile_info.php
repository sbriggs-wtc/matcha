<?php
    require "header.php";
    require "config/dbh.php";

    $object = new Dbh;
    $pdo = $object->connect();
    $rows = $object->fetchAllInterests($pdo);

?>

<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Additional Profile Info</h1>
            <form autocomplete="off" action="includes/additional_profile_info.inc.php" method="post" autocomplete="off">

                <label>Your Gender</label><br/>
                <input class="input_field" type="radio" name="gender" value="Male">Male<br/>
                <input class="input_field" type="radio" name="gender" value="Female">Female<br/><br/>

                <label>Your Sexual Preference</label><br/>
                <input class="input_field" type="radio" name="sex" value="Male">Male<br/>
                <input class="input_field" type="radio" name="sex" value="Female">Female<br/>
                <input class="input_field" type="radio" name="sex" value="Both">Both<br/><br/>

                <label>Your Age</label><br/>
                <input class="input_field" type="number" name="age" style="width:500px;" value=""><br/><br/>

                <label>Short Biography</label><br/>
                <input type="text" name="bio" style="width:500px; height:200px;"><br/><br/>

                <label>Your Location (Nearest City)</label><br/>
                <input type="text" name="location" style="width:500px;"><br/><br/>
                
                <label>Some Of Your Interests</label><br/><br/>
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput1" type="text" name="int1" placeholder="Interest 1">
                </div>
                
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput2" type="text" name="int2" placeholder="Interest 2">
                </div>
                
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput3" type="text" name="int3" placeholder="Interest 3">
                </div>
                
<!--                 <div class="autocomplete" style="width:150px;">
                    <input id="myInput4" type="text" name="int4" placeholder="Interest 4">
                </div>
                
                <div class="autocomplete" style="width:150px;">
                    <input id="myInput5" type="text" name="int5" placeholder="Interest 5"> -->
                </div><br/><br/>

                <input type="submit" name="add_inf_submit" value="Submit">
            </form><br/>
        </section>        
    </div>
</main>
<script>

//////////////////////////////////////////////////////////////////
// vvv INTEREST #1 vvv
//////////////////////////////////////////////////////////////////

//var arr_interests = ["Afghanistan", "Albania", "Kekistan", "USSR"];

var arr_interests =
            <?php 
                echo '[';
                for ($i = 0; !empty($rows[$i][1]); $i++)
                {
                    echo '"' . $rows[$i][1] . '"';
                    if (!empty($rows[$i + 1][1]))
                        echo ',';
                }
                echo ']';
            ?>;

autocomplete(document.getElementById("myInput1"), arr_interests);
function autocomplete(inp, arr)
{
    /*the autocomplete function takes two arguments, 
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;

    /*execute the function when someone writes in the text field:*/
    inp.addEventListener("input", function(e)
    {
        var a, b, i, val = this.value;

        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val)
            return false;
        currentFocus = -1;

        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");

        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);

        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++)
        {
            /*check if the item starts with the same letters as the text field value*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase())
            {
                /* create a div element for each matching element */
                b = document.createElement("DIV");

                /* make the matching letters bold */
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);

                /*insert an input field that will hold the current array item's value*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

                /*execute a function when someone clicks on the item value (DIV element): */
                b.addEventListener("click", function(e)
                {
                    /*insert the value for the autocomplete text field*/
                    inp.value = this.getElementsByTagName("input")[0].value;

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values)*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });          

    /*execute a function presses a key on the keyboard*/
    inp.addEventListener("keydown", function(e)
    {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40)
        {
            /* if the arrow DOWN key is pressed, increase the current focus variable */
            currentFocus++;

            /* and make the current item more visible:*/
            addActive(x);
        }
        else if (e.keyCode == 38)
        {
            /* if the arrow UP key is pressed, decrease the current focus variable */
            currentFocus--;
        }
        else if (e.keyCode == 13)
        {
            /* if the ENTER key is pressed, prevent the form from being submitted, */
            e.preventDefault();
            if (currentFocus > -1)
            {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x)
    {
        /*a function to classify an item as "active":*/
        if (!x)
            return false;
        
        /* start by removing the active class on all items */
        removeActive(x);
        if (currentFocus >= x.length - 1)
            currentFocus = 0;
        
        if (currentFocus < 0)
            currentFocus = (x.length - 1);

        /* add class autocomplete-active */
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x)
    {
        /* a function to remove the "active" class from all autocomplete items */
        for (var i = 0; i < x.length; i++)
        {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt)
    {
        /* close all autocomplete lists in the document,
        except the one passed as an argument: */
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++)
        {
            if (elmnt != x[i] && elmnt != inp)
            {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /* execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e)
    {
        closeAllLists(e.target);
    });
}

//////////////////////////////////////////////////////////////////
// vvv INTEREST #2 vvv
//////////////////////////////////////////////////////////////////

autocomplete(document.getElementById("myInput2"), arr_interests);
function autocomplete(inp, arr)
{
    var currentFocus;
    inp.addEventListener("input", function(e)
    {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val)
            return false;
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++)
        {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase())
            {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e)
                {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });          
    inp.addEventListener("keydown", function(e)
    {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40)
        {
            currentFocus++;
            addActive(x);
        }
        else if (e.keyCode == 38)
            currentFocus--;
        else if (e.keyCode == 13)
        {
            e.preventDefault();
            if (currentFocus > -1)
                if (x) x[currentFocus].click();
        }
    });
    function addActive(x)
    {
        if (!x)
            return false;
        removeActive(x);
        if (currentFocus >= x.length - 1)
            currentFocus = 0;
        if (currentFocus < 0)
            currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x)
    {
        for (var i = 0; i < x.length; i++)
        {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt)
    {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++)
        {
            if (elmnt != x[i] && elmnt != inp)
                x[i].parentNode.removeChild(x[i]);
        }
    }
    document.addEventListener("click", function (e){closeAllLists(e.target);});
}

//////////////////////////////////////////////////////////////////
// vvv INTEREST #3 vvv
//////////////////////////////////////////////////////////////////

autocomplete(document.getElementById("myInput3"), arr_interests);
function autocomplete(inp, arr)
{
    var currentFocus;
    inp.addEventListener("input", function(e)
    {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val)
            return false;
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++)
        {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase())
            {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e)
                {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });          
    inp.addEventListener("keydown", function(e)
    {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40)
        {
            currentFocus++;
            addActive(x);
        }
        else if (e.keyCode == 38)
            currentFocus--;
        else if (e.keyCode == 13)
        {
            e.preventDefault();
            if (currentFocus > -1)
                if (x) x[currentFocus].click();
        }
    });
    function addActive(x)
    {
        if (!x)
            return false;
        removeActive(x);
        if (currentFocus >= x.length - 1)
            currentFocus = 0;
        if (currentFocus < 0)
            currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x)
    {
        for (var i = 0; i < x.length; i++)
        {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt)
    {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++)
        {
            if (elmnt != x[i] && elmnt != inp)
                x[i].parentNode.removeChild(x[i]);
        }
    }
    document.addEventListener("click", function (e){closeAllLists(e.target);});
}
/* 
//////////////////////////////////////////////////////////////////
// vvv INTEREST #4 vvv
//////////////////////////////////////////////////////////////////

autocomplete(document.getElementById("myInput4"), arr_interests);
function autocomplete(inp, arr)
{
    var currentFocus;
    inp.addEventListener("input", function(e)
    {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val)
            return false;
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++)
        {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase())
            {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e)
                {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });          
    inp.addEventListener("keydown", function(e)
    {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40)
        {
            currentFocus++;
            addActive(x);
        }
        else if (e.keyCode == 38)
            currentFocus--;
        else if (e.keyCode == 13)
        {
            e.preventDefault();
            if (currentFocus > -1)
                if (x) x[currentFocus].click();
        }
    });
    function addActive(x)
    {
        if (!x)
            return false;
        removeActive(x);
        if (currentFocus >= x.length - 1)
            currentFocus = 0;
        if (currentFocus < 0)
            currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x)
    {
        for (var i = 0; i < x.length; i++)
        {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt)
    {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++)
        {
            if (elmnt != x[i] && elmnt != inp)
                x[i].parentNode.removeChild(x[i]);
        }
    }
    document.addEventListener("click", function (e){closeAllLists(e.target);});
}


//////////////////////////////////////////////////////////////////
// vvv INTEREST #5 vvv
//////////////////////////////////////////////////////////////////

autocomplete(document.getElementById("myInput5"), arr_interests);

function autocomplete(inp, arr)
{
    var currentFocus;
    inp.addEventListener("input", function(e)
    {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val)
            return false;
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++)
        {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase())
            {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e)
                {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });

    inp.addEventListener("keydown", function(e)
    {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40)
        {
            currentFocus++;
            addActive(x);
        }
        else if (e.keyCode == 38)
            currentFocus--;
        else if (e.keyCode == 13)
        {
            e.preventDefault();
            if (currentFocus > -1)
                if (x) x[currentFocus].click();
        }
    });

    function addActive(x)
    {
        if (!x)
            return false;
        removeActive(x);
        if (currentFocus >= x.length - 1)
            currentFocus = 0;
        if (currentFocus < 0)
            currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x)
    {
        for (var i = 0; i < x.length; i++)
        {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt)
    {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++)
        {
            if (elmnt != x[i] && elmnt != inp)
                x[i].parentNode.removeChild(x[i]);
        }
    }

    document.addEventListener("click", function (e){closeAllLists(e.target);});
} */
</script>
<?php
    require "footer.php"
?>