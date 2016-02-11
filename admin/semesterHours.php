<!--
*Author: Jiefu Yang
*Time: April 2015
*
*This page is the script for Cheryl to enter the total hours of a semester.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$Hours = $_POST["semesterHours"];
$Hours=sanitize($Hours);

if($Hours <= 0)
{
    echo"Error: Semester hour should be nonnegative!";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

$sql = "SELECT * FROM semesterHours";

if(!mysql_query($sql,$connect))
{
    echo "<br/>";
    echo "<br/>";
    die('Error: ' . mysql_error());
    echo "<br/>";echo "<br/>";
}

if(mysql_affected_rows($connect) != 0)
{
    echo"Error: You have already reset the semester hours.";
    header("Refresh: 2; URL=workHourManagement.php");
    exit;
}

else
{
    mysql_query("INSERT INTO `semesterHours` (`semester_hour`, `hours_left`) VALUES ('$Hours', '$Hours')");

    echo"Semester hours updated: ";
    echo"$Hours work hours are added to your bank.";

    include("../shared/hoursLeft.php");

    header("Refresh: 2; URL=workHourManagement.php");
}

mysql_close($connect);
?>
