<?php
session_start();
 
$pageName="clear Smart Basket"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page
unset($_SESSION['basket']);

//display random text
echo"<p class='updateInfo'> Your basket has been cleared. </p>";


include("footfile.html"); //include head layout
echo "</body>";
?>