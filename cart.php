<?php
//var_dump($_POST);
require_once "config.php";
include "header.php"; 
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$conn or die("Database connection failed:" . $conn->error);
$conn->query("set names utf8"); 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id = intval($_POST["id"]);
    if (array_key_exists($product_id, $_SESSION["cart"])) {
        $_SESSION["cart"][$product_id] += intval($_POST["count"]);
    } else {
        $_SESSION["cart"][$product_id] = intval($_POST["count"]);
    }
    if ($_SESSION["cart"][$product_id] <= 0) {
        unset($_SESSION["cart"][$product_id]);
    }
}
?>

<h2>Products in shopping cart</h2>


<p>

<ul>
<?php
$results = $conn->query(
"SELECT id,name,price FROM mohanad_products;");
$results or die("Database query failed:" . $conn->error);
while ($row = $results->fetch_assoc()) {
  $product_id = $row['id'];
  if (array_key_exists($product_id, $_SESSION["cart"])) {
    $count = $_SESSION["cart"][$product_id];
    ?>
      <li>
        <?=$count;?> items of
        <a href="description.php?id=<?=$product_id;?>">
          <?=$row['name'];?></a>
          <?=$row['price'];?>EUR totals in <?= $row['price'] * $count; ?> EUR
        <form method="post">
          <input type="hidden" name="id" value="<?=$product_id;?>"/>
          <input type="hidden" name="count" value="-1"/>
          <input type="submit" value="Remove"/>
        </form>
      </li>
    <?php
  }
}
$conn->close();
?>
<button onclick="window.location.href='placeorder.php'">BUY IT NOW FOR 999</button> 
</ul>
<a href="index.php">Back to product listing</a>
