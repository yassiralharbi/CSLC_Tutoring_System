<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check(userauthentication): Yassir
*This page is used as the function to modify the hourbank when a tutor cancels a job.
*
-->

<?php

//$cancel_ID = $_GET['value'];
session_start();
include("userauthentication.php");
$connect = connect();
$sql = "SELECT * FROM hours WHERE tutor_Id  = '" . $delete_Tutor . "'";
$query = mysql_query($sql);

$row = mysql_fetch_object($query);

$hoursUsed = $row->h_Used - 1;
$hoursLeft = $row->h_Left + 1;
$hoursUnclaimed = $row->h_unclaimed - 1;

$sql= "update hours set h_Used='$hoursUsed' where tutor_Id='$delete_Tutor'";
mysql_query($sql) or die(mysql_error());
$sql= "update hours set h_Left='$hoursLeft' where tutor_Id='$delete_Tutor'";
mysql_query($sql) or die(mysql_error());
$sql= "update hours set h_unclaimed='$hoursUnclaimed' where tutor_Id='$delete_Tutor'";
mysql_query($sql) or die(mysql_error());
//echo"Job cancelled.";
include("../shared/hoursLeft.php");
header("Refresh: 1; URL=ViewBooking.php");

?>