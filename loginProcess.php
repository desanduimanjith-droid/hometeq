<?php
session_start();
include("db.php"); //include db.php file to connect to DB
$pageName="login_outcome"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page

$userName = $_POST['userEmail'];
$password = $_POST['password'];

echo'<p>gmail: '.$userName.'</p>';
echo'<p>Password: '.$password.'</p>';

if(empty($email) || empty($password)){
    echo '<p><b>login failed</b>';
    echo'<br> login form is not complete, please fill in all the fields</p>';
    echo '<br><p><a href="login.php">Go back to login page</a></p> ';
}else{
    $sql ="SELECT * FROM users WHERE userEmail ='". $email ."'";
    $exeSQL = mysqli_query($conn,$sql);
    $loginArry=mysqli_fetch_array($exeSQL);
    echo "printed by" . $loginArry["userEmail"] ."<br>";

    if(mysqli_num_rows($exeSQL) == 1){
        $_SESSION['userName'] = $userName;
        echo '<p><b>login failed</b>';
        echo '<br><p><a href="index.php">Go back to home page</a></p> ';
    }else{
        $arryuser = mysqli_fetch_array($exeSQL);

        if($arryuser['userPassword'] <> $password){
            echo "<p><b>Login failed</b></p>";
            echo "password invalied";
            echo"<br><p><a href='login.php'>Go back to login page</a></p>";

        }else{
            echo "<p><b>Login successful</b></p>";
            $_SESSION["userId"] = $arryuser["userId"]  ;
            $_SESSION["fName"]= $arryuser["userFName"];
            $_SESSION["Sname"]= $arryuser["userSName"];
            $_SESSION["usertype"]= $arryuser["userType"];
            echo"<p> welcome, ".$_SESSION["fName"] . " ".$_SESSION["SName"]. "</p>";

            // if the user is admin, display admin page link
            if($_SESSION ["usertype"] == "admin"){
                echo "<p><a href='admin.php'>Admin Page</a></p>";
            }else{}

        }
    }    



}

include("footfile.html"); //include head layout
echo "</body>";
?>

