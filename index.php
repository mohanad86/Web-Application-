<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); 
if (!array_key_exists("timestamp", $_SESSION)) {
  $_SESSION["timestamp"] = date('l jS \of F Y h:i:s A');
}
if (array_key_exists("user", $_SESSION)) {
   echo "Hello" . $_SESSION["user"];
   ?> <a href="logout.php"> Log out</a><?php
} else { ?>
  <form action="login.php" method="post">
    <input type="text" name="user"/>
    <input type="password" name="password"/>
    <input type="submit" value="Log in"/>
  </form> <?php
} 
?>





<a href="registration.php">Sign up</a> 
<div class="Container"></div>
<div class="learn more"></div>
<div class="Container"></div>
<a href="cart.php">Go to shopping cart</a>

<?php
// Create connection
//Check connection
$results = $conn->query(
 "SELECT id, name, price FROM mohanad_products;");
    while($row = $results->fetch_assoc()) {
 	?>
          <a href="description.php?id=<?=$row['id']?>">
            <?=$row["name"]?></a>
            <?=$row["price"]?>EUR
      <?php
}
$conn->close();
include "footer.php";
?>
