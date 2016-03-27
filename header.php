<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="Introduction to this website">
    <title>Mohanad shopy shop</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <script type="text/javascript" src="js/main.js"></script>
  </head>
<body>

<div id="header">

<h1>Shopy shop</h1>
</div>
<div id="nav">
Estonia<br>
Tallinn<br>
</div>
<div id="section">
</div>
<h2>What is Shopy shop</h2>
<p>The place you will find everything you want from phone to boots,
with over 13 million products.</p>
<p>Don't waste your time for looking into other websites,
You will find everything you need here.</p>
<?php
session_start();
if (!array_key_exists("cart", $_SESSION)) {
    $_SESSION["cart"] = array();
}
?>
