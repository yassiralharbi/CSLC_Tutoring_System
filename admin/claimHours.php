<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(authentication): Yassir
* Security Check(sanitize): Kevin
*This page is the script for Cheryl to claim hours for tutors.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$tutorId = $_POST['tutorId'];
$tutorId=sanitize($tutorId);

$Hours = isset($_POST['hoursClaimed']) ? trim($_POST['hoursClaimed']) : '';
$Hours=sanitize($Hours);

$sql = "SELECT * FROM hours WHERE tutor_Id  = '" . $tutorId . "'";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);

if($Hours > $row->h_Used)
{
    echo"Error: Units Claimed should not be greater than Units Used!";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

if($Hours <= 0)
{
    echo"Error: Units Claimed should be nonnegative.";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

if($Hours > $row->h_unclaimed)
{
    echo"Error: There are not enough units to claim!";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

if(!mysql_query($sql,$connect))
{
    echo "<br/>";
    echo "<br/>";
    die('Error: ' . mysql_error());
    echo "<br/>";echo "<br/>";
}
else
{
    $row->h_claimed += $Hours;
    $sql= "update hours set h_claimed='$row->h_claimed' where tutor_Id='$tutorId'";
    mysql_query($sql) or die(mysql_error());

    $hoursUnclaimed = $row->h_unclaimed - $Hours;
    $sql= "update hours set h_unclaimed='$hoursUnclaimed' where tutor_Id='$tutorId'";
    mysql_query($sql) or die(mysql_error());

    echo"Units claimed for this tutor.";

    header("Refresh: 1; URL=workHourManagement.php");
}
mysql_close($connect);
?>
