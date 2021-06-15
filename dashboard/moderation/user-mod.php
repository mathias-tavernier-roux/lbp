<?php
$ID = $_POST['ID'];
if ($_POST['CMD'] == "MOD")
{
    $request1 = "UPDATE `user` SET `droit_id`= 43 WHERE `id` = $ID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);
}
if ($_POST['CMD'] == "UNMOD")
{
    $request1 = "UPDATE `user` SET `droit_id`= 1 WHERE `id` = $ID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);   
}
if ($_POST['CMD'] == "BAN")
{
    $request1 = "DELETE FROM `user` WHERE `id` = $ID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);  
}
header("Location: users.php");
