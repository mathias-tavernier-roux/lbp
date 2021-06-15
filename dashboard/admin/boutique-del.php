<?php
$ID = $_POST['ID'];
$UID = $_POST['UID'];
if ($_POST['TYPE'] == "PRO")
{
    $request1 = "DELETE FROM `boutique_pro` WHERE `id` = $ID";
    $request2 = "UPDATE `user` SET `droit_id`= 1 WHERE `id` = $UID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);
    $query2 = mysqli_query($dbs, $request2);  
}
if ($_POST['TYPE'] == "PAR")
{
    $request1 = "DELETE FROM `boutique_particulier` WHERE `id` = $ID";
    $request2 = "UPDATE `user` SET `droit_id`= 1 WHERE `id` = $UID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);
    $query2 = mysqli_query($dbs, $request2); 
}
header("Location: users.php");