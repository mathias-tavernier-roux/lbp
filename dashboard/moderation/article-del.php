<?php
$ID = $_POST['ID'];
$request1 = "DELETE FROM `annonce` WHERE `annonce`.`id` = $ID";
$dbs = mysqli_connect("localhost", "root", "", "boutique");
$query1 = mysqli_query($dbs, $request1);  
header("Location: users.php");