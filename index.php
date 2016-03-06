<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters
if (!array_key_exists("timestamp", $_SESSION)) {
  $_SESSION["timestamp"] = date('l jS \of F Y h:i:s A');
}
?>



<!DOCTYPE html>
<html>
<body>
<?php// phpinfo();?>
<ul>
<a href="action_page.php" />
<img src="login-button.jpg" alt="Mohanad.php" width="140" height="142">
</ul>


<h3>Get more about my shopy shop visit us</h3>
<div class="scd-content-social">
<li class="fb"><a href="https://www.facebook.com/Shopy-shop-1742584925970334/"target="_blank"><span></span><strong>Facebook <em>›</em><strong></a></li>
</ul>
<li>
 <a href="https://www.facebook.com/Shopy-shop-1742584925970334/" target="_blank">Facebook</a>
        </li>
<div class="Container">
<h1></h1>
</div>
</div>

<p>
<a href="#">Top</a>
</p>
</div>

<div class="Container">

<div class="learn more">
<div class="Container">
<div>
</div>
<?php
// Create connection
//Check connection
$results = $conn->query(
 "SELECT id, name, price FROM mohanad_products;");
    while($row = $results->fetch_assoc()) {
 	?>
        <li>
          <a href="description.php?id=<?=$row['id']?>">
            <?=$row["name"]?></a>
            <?=$row["price"]?>EUR
        </li>
      <?php
}
$conn->close();
?> 
 </ul>
    </p>
<? include "footer.php" ?>
