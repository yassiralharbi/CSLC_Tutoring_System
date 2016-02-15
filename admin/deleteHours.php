<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(getCheck): Yassir
* Security Check(authentication): Yassir
* Security Check(sanitize): Kevin
*This page is used as the function to delete hours of a tutor.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$hoursToDelete = isset($_POST['hoursDeleted']) ? trim($_POST['hoursDeleted']) : '';

if($hoursToDelete == "")
{
    $error[]=urlencode("Please enter a Number.");
}

$tutorId = sanitize(getCheck($_POST["tutorId"]));

if($hoursToDelete <= 0)
{
    echo"Error: Units Deleted should be nonnegative!";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

$newHoursLeft = 0;

$sql = "SELECT * FROM hours WHERE tutor_Id =  '" . $tutorId ."'";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);

$newHoursLeft = $row->h_Left - $hoursToDelete;

if($newHoursLeft < 0)
{
    echo"Error:You cannot delete units from this tutor; there are not enough units left!";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

$totalHours = sanitize($row->total_H - $hoursToDelete);
$hoursLeft = sanitize($row->h_Left - $hoursToDelete);

if(!mysql_query("UPDATE hours SET total_H='$totalHours' where tutor_Id='$tutorId'"))
    die(mysql_error());

if(!mysql_query("UPDATE hours SET h_Left='$hoursLeft' where tutor_Id='$tutorId'"))
    die(mysql_error());

echo $hoursToDelete." Units deleted";
include("../shared/hoursLeft.php");
?>