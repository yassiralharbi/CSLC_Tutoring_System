<!--
*Author: Jiefu Yang
*Time: May 2015
*
*This page is used as the function to reset the semester hours.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$sql = "DELETE FROM `semesterHours`";
$query = mysql_query($sql);

$sql= "update hours set total_H='0',h_Left='0',h_Used='0',h_claimed='0',h_unclaimed='0'";
mysql_query($sql) or die(mysql_error());

echo"Hour bank reset.";
header("Refresh: 1; URL=workHourManagement.php");

?>
