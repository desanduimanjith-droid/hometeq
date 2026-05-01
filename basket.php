<?php
include("db.php");
session_start();

$pageName = "Smart basket";
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>".$pageName."</title>";

echo "<body>";
include("headfile.html");
echo "<h4>".$pageName."</h4>";

// --- ADD TO BASKET LOGIC ---
if (isset($_POST["h_prodid"])) {
    $newprodId = $_POST['h_prodid'];
    $reqQuantity = $_POST['prodQuantity'];

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array();
    }

    $_SESSION['basket'][$newprodId] = $reqQuantity;
    echo "<p>1 item added to the basket.</p>";
}

// --- REMOVE FROM BASKET LOGIC ---
// Check if the hidden ID to be removed is set
if (isset($_POST["del_prodid"])) {
    // Retrieve the ID of the product to be removed
    $delId = $_POST["del_prodid"];
    
    // Unset the column of the session array
    unset($_SESSION['basket'][$delId]);
    
    // Display message
    echo "<p>1 item removed from the basket</p>";
}

$total = 0;

echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>&nbsp;</th> </tr>";

// --- DISPLAY BASKET ---
if (isset($_SESSION["basket"]) && count($_SESSION["basket"]) > 0) {

    foreach ($_SESSION["basket"] as $index => $value) {
        
        $SQL = "SELECT prodName, prodPrice FROM Product WHERE prodId=" . $index;
        $result = mysqli_query($conn, $SQL);

        if ($result && mysqli_num_rows($result) > 0) {
            $arrayProd = mysqli_fetch_array($result);

            $prodName = $arrayProd['prodName'];
            $prodPrice = $arrayProd['prodPrice'];
            $subtotal = $prodPrice * $value;

            echo "<tr>";
            echo "<td>" . $prodName . "</td>";
            echo "<td>&pound;" . number_format($prodPrice, 2) . "</td>";
            echo "<td>" . $value . "</td>";
            echo "<td>&pound;" . number_format($subtotal, 2) . "</td>";
            
            // --- REMOVE BUTTON FORM ---
            echo "<td>";
            echo "<form action='basket.php' method='post'>";
            echo "<input type='submit' value='Remove'>";
            echo "<input type='hidden' name='del_prodid' value='" . $index . "'>";
            echo "</form>";
            echo "</td>";
            
            echo "</tr>";
            

            $total += $subtotal;
        }
    }
} else {
    echo "<tr><td colspan='5'>Empty basket</td></tr>";
}

// --- DISPLAY TOTAL ---
echo "<tr>";
echo "<td colspan='3' style='text-align: right;'><b>Total:</b></td>";
echo "<td><b>&pound;" . number_format($total, 2) . "</b></td>";
echo "<td>&nbsp;</td>"; // Extra cell for footer
echo "</tr>";

echo "</table>";

mysqli_close($conn);

echo "<br><br>";
echo "<a href='clearbasket.php'>CLEAR BASKET</a>";

echo "<br><br>";
echo "New homteq customers: <a href='signup.php'>Sign Up</a>";
echo "<br><br>";
echo "Returning homteq customers: <a href='login.php'>Log In</a>";

include("footfile.html");
echo "</body>";
?>