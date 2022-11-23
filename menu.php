<?php
// if user presses log out button
if(isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location:index.php");
}

echo "<div class=\"banner\">";
echo "<div class=\"largeMenu\">";
echo "<h1 class=\"title\">Techbit</h1>";
echo "<table>";
echo "<tr>";
echo "<td><a href=\"index.php\" class=\"navigation\">Home</a></td>";

if(isset($_SESSION["id"])){
    echo "<td><a href=\"create.php\" class=\"navigation\">Create Post</a></td>";
    echo "<td><a href=\"archive.php\" class=\"navigation\">Archive</a></td>";
}

echo "<td><a href=\"about.php\" class=\"navigation\">About</a></td>";

if(!isset($_SESSION["id"])){ // use session data to see if logged in 
    echo "<td><a href=\"login.php\" class=\"navigation\">Log In</a></td>";
    echo "<td><a href=\"register.php\" class=\"navigation\">Register</a></td>";
}
else{
    echo "<form action=\"menu.php\" method=\"post\">";
    echo "<td><button type=\"submit\" name=\"logout\" class=\"logoutbtn\">Log Out</button></td>";
    echo "</form>";
}

echo "</tr>";
echo "</table>";
echo "</div>";
echo "<select class=\"dropDownMenu\" onchange=\"window.open(this.value,'_self');\">";
echo "<option value=\"#\">Techbit - Menu</option>";
echo "<option value=\"index.php\">Home</option>";
echo "<option value=\"create.php\">Create Post</option>";
echo "<option value=\"archive.php\">Archive</option>";
echo "<option value=\"about.php\">About</option>";
echo "<option value=\"login.php\">Log In</option>";
echo "<option value=\"register.php\">Register</option>";
echo "</select>";
echo "</div>";
