<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to change tutor status
 */
session_start();
include("../shared/db.php");

include("../admin/adminauthentication.php");


$connect = connect();

$value = $_GET['value'];
$value = hash_finder_do($value);
$id=$value;
$id = sanitize($id);

$sql = "UPDATE tutors SET status=(SELECT CASE status WHEN 'Enabled' THEN 'Disabled' ELSE 'Enabled' END) WHERE tutor_Id='" . $id. "'";


$query = mysql_query($sql);

header("Refresh: 0; URL=tutor_control.php");
if(mysql_affected_rows($connect) == 1)
{
    include("../admin/statusEmail.php");
    echo "";
}
else
    echo "<h1>Error: Status not updated</h1>";

mysql_close($connect);
?>