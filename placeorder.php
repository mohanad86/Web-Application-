<?php
//placeoder.php will move cart to database
require_once "config.php";
include "header.php";
$_SESSION["cart"] or die("There is no items in the shopping cart!");

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); //Umlaut characters are welcome

//row to orders table
$statement = $conn->prepare("INSERT INTO `mohanad_orders` (`user_id`) VALUES (?)");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
$statement->bind_param("i", $_SESSION["user"]); //User ID
if (!$statement->execute()) {
    die("Execute failed: (" . $statement->errno . ") " . $statement->error);
}
$order_id = $conn->insert_id; //ID of the order

$statement = $conn->prepare(
    "INSERT INTO `mohanad_order_products` (`order_id`, `product_id`, `count`) VALUES (?,?,?)");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
foreach ($_SESSION["cart"] as $count => $product_id) {
    $statement->bind_param("iii", $order_id, $product_id, $count);
	if (!$statement->execute()) {
		die("Execute failed: (" . $statement->errno . ") " . $statement->error);
	}
}

//RESERT DA POWER OF CART!!!
$_SESSION["cart"] = array();
//<META http-equiv="refresh" content="5;URL=http://enos.itcollege.ee/~aovtsinn/index.php"> 
header('Location: cart.php');

?>
