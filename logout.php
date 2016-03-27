<?php
session_start();
unset($_SESSION["user"]);
header('Location: index.php'); // This will redirect back to index
?>
