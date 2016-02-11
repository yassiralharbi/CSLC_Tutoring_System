<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check(authentication): Yassir
*This page is used as the function to reset the semester hours.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$sql = "SELECT * FROM semesterHours";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);

if(mysql_affected_rows($connect) == 0)
{
    echo"Error: You have not entered semester hours.";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

else if(mysql_affected_rows($connect) != 1)
{
    echo"Error: Duplicate inputs.";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

else
{
    $sql = "DELETE FROM `semesterHours`";
    $query = mysql_query($sql);
    echo"Reset done.";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

?>
