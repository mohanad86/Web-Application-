<?php
#var_dump($_POST);
include "config.php";
session_start();
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters
$statement = $conn->prepare(
"SELECT * FROM mohanad_users 
WHERE email = ? AND password = PASSWORD(?)");
$statement->bind_param("ss", $_POST["user"], $_POST["password"]);
$statement->execute();
$results = $statement->get_result();
$row = $results->fetch_assoc();

if($row) {
    echo "Login successful, Welcome Back " . $row["first_name"];
    $_SESSION["user"] = $row["id"];
    header('Location: index.php');
} else {
    echo "Login failed";
}
?>
