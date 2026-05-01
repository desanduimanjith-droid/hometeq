<?php
include ("db.php"); //include db.php file to connect to DB
$pageName="A smart but for a smart home"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page
$prodId=$_GET['u_prod_id']; 
echo "<p>Selected product Id: ".$prodId."</p>";
$SQL="select prodId, prodName, prodPicNameLarge,prodDescripLong,prodPrice,prodQuentity from Product where prodId=".$prodId;     
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
    echo "<img src='image/".$arrayP['prodPicNameLarge']."' height=400 width=400>"; //display small image
    echo "</a>";

    echo "</td>";
    echo "<td style='border: 0px; padding: 30px; vertical-align: middle;'>";
    echo "<h3 style='color: #4A90E2; font-size: 24px; margin: 0;'>".$arrayP['prodName']."</h3>";
    echo "<p style='font-size: 16px; margin: 10px 0;'>".$arrayP['prodDescripLong']."</p>";
    echo "<p style='font-size: 18px; font-weight: bold; color: #333;'>£".$arrayP['prodPrice']."</p>";
    echo "<p style='font-size: 16px; margin: 10px 0;'>Available Quantity: ".$arrayP['prodQuentity']."</p>";
    
    //create HTML form made of one text field and one button for user to enter required quantity
    //the value entered in the form will be posted to the basket.php to be processed
    echo "<form action='basket.php' method='post'>"; //action is page to be called, method is POST
    
    echo "<p>Number to be purchased: ";
    echo "<select name='prodQuantity'>";
    for ($i = 1; $i <= $arrayP['prodQuentity']; $i++) {
    
    // --- STEP 3c: Display the <option> tag ---
    // We use the loop counter ($i) for both the value and the display text
    echo "<option value='" . $i . "'>" . $i . "</option>";
}
    echo "</select>";
    echo   "</p>";
    echo "<input type='submit' name='submitbtn' value='ADD TO BASKET' id='submitbtn'>";
    echo "<input type='hidden' name='h_prodid' value=".$prodId.">"; //pass product id to next page basket.php as hidden value
    echo "</p>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";  //display the value of the product id, for debugging purposes.
mysqli_close($conn); //close database connection

include("footfile.html"); //include head layout
echo "</body>";

?>