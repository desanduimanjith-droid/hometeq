<?php
include ("db.php"); //include db.php file to connect to DB
$pageName="make your home smart"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>make your home smart</title>";
echo "<body>";
include ("headfile.html"); //include header layout file

// Add hero section
echo "<div style='text-align: center; padding: 40px 20px; background-color: #f5f5f5;'>";
echo "<h1 style='font-size: 48px; color: #333; font-weight: 300; letter-spacing: 2px; margin: 0;'>MAKE YOUR HOME SMART</h1>";
echo "</div>";

//create a $SQL variable and assign to it a SQL statement that retrieves product details
$SQL="select prodId, prodName, prodPicNameSmall,prodDescripLong,prodPrice from Product";     
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

echo "<div style='max-width: 1200px; margin: 40px auto; padding: 0 20px;'>"; //container
echo "<table style='border: 0px; width: 100%;'>"; //create HTML table

//iterate through the array
while ($arrayP=mysqli_fetch_assoc($exeSQL))
{
    echo "<tr>";
    echo "<td style='border: 0px; padding: 30px; vertical-align: middle; width: 300px;'>";
    echo "<a href=prodbuy.php?u_prod_id=".$arrayP['prodId'].">"; //make image into an anchor to prodbuy.php, pass product id by URL
    echo "<img src='image/".$arrayP['prodPicNameSmall']."' height=200 width=200>"; //display small image
    echo "</a>";

    echo "</td>";
    echo "<td style='border: 0px; padding: 30px; vertical-align: middle;'>";
    echo "<h3 style='color: #4A90E2; font-size: 24px; margin: 0;'>".$arrayP['prodName']."</h3>";
    echo "<p style='font-size: 16px; margin: 10px 0;'>".$arrayP['prodDescripLong']."</p>";
    echo "<p style='font-size: 18px; font-weight: bold; color: #333;'>£".$arrayP['prodPrice']."</p>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>"; //close HTML table
echo "</div>"; //close container

mysqli_close($conn); //close database connection
include("footfile.html"); //include footer layout
echo "</body>";
?>