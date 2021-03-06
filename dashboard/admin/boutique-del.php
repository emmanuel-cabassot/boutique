<?php
$ID = $_POST['ID'];
if ($_POST['TYPE'] == "PRO")
{
    $request1 = "DELETE FROM `boutique_pro` WHERE `id` = $ID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);  
}
if ($_POST['TYPE'] == "PRO")
{
    $request1 = "DELETE FROM `boutique_particulier` WHERE `id` = $ID";
    $dbs = mysqli_connect("localhost", "root", "", "boutique");
    $query1 = mysqli_query($dbs, $request1);  
}
header("Location: users.php");