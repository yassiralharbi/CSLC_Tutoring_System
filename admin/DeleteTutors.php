<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to delete tutors from the system
 */
session_start();
include("../shared/db.php");
include("../admin/adminauthentication.php");

$connect = connect();
$value = $_GET['value'];
$value = hash_finder_do($value);
$id=$value;
$id = sanitize($id);

//include("unhireEmail.php");
$sql = "DELETE FROM `tutors` WHERE tutor_Id  = '" . $value . "'";
$query = mysql_query($sql);
$sql = "DELETE FROM `logins` WHERE ID  = '" . $value . "'";
$query = mysql_query($sql);

header("Refresh: 1; URL=tutor_control.php");
if(mysql_affected_rows($connect) == 1)
{
    $sql = "DELETE FROM `hours` WHERE tutor_Id  = '" .$value. "'";
    $query = mysql_query($sql);
    include("../shared/hoursLeft.php");
}
else
    echo "<h1>Error: tutor not Deleted</h1>";

mysql_close($connect);
?>