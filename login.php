<?php
session_start();
$pageName="login"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page
?>
<form action="loginProcess.php" method="post">
    <p>
        <label for="userName">Username:</label>
        <input type="text" id="userName" name="userName" required>
    </p>
    <p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </p>
    <input type="submit" value="Login">
</form>
<?php
include("footfile.html"); //include head layout
echo "</body>";
?>