<?php
require_once "config.php";
include "header.php" ?>
<a href="index.php">Back to product listing</a>
<?php

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters
$statement = $conn->prepare(
"SELECT
  `mohanad_products`.`id` AS `order_product_id`,
  `mohanad_order_products`.`product_id` AS `product_id`,
  `mohanad_products`.`name` AS `product_name`,
  `mohanad_order_products`.`unit_price` AS `order_product_unit_price`,
  `mohanad_order_products`.`count` AS `order_product_count`,
  `mohanad_order_products`.`unit_price` * `mohanad_order_products`.`count` AS `subtotal`
FROM
  `mohanad_order_products`
JOIN
  `mohanad_products`
ON
  `mohanad_order_products`.`product_id` = `mohanad_products`.`id`
WHERE
  `mohanad_order_products`.`order_id` = ?
");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
$statement->bind_param("i", $_GET["id"]);
$statement->execute();
$results = $statement->get_result();
?>
<h1>Order details</h1>
<ul>
<?php
  while ($row = $results->fetch_assoc()) { ?>
    <li>
      <?= $row["product_name"]; ?>
      <?= $row["order_product_count"]; ?>x
      <?= $row["order_product_unit_price"]; ?>EUR
    </li><?php
  }
?>

