<!--
*Author: Jiefu Yang
*Time: May 2015
* Security Check: Yassir
*
*This page is used as the function to add hours to a tutor.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$hoursAdded = isset($_POST['hoursAdded']) ? trim($_POST['hoursAdded']) : '';

if($hoursAdded == "") $error[]=urlencode("Please enter a Number.");

$tutorId = $_POST["tutorId"];
$tutorId = getCheck($tutorId);
$tutorId=sanitize($tutorId);

if($hoursAdded <= 0)
{
    echo"Error: You cannot add negative units!";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

$newHoursLeftBank = 0;

$sql = "SELECT * FROM semesterHours";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);

$newHoursLeftBank = $row->hours_left - $hoursAdded;

if($newHoursLeftBank < 0)
{
    echo"Error: There are not enough units left in the hour bank.";
    header("Refresh: 1; URL=workHourManagement.php");
    exit;
}

$sql = "SELECT * FROM hours";
$query = mysql_query($sql);

$flag = 0;
$counter = 0;

$sql = "SELECT * FROM hours";
$query = mysql_query($sql);
while($row = mysql_fetch_object($query))
{
    $counter++;
    if($row->tutor_Id == $tutorId)
    {
        $flag++;

        $totalHours = $row->total_H + $hoursAdded;
        $totalHours=sanitize($totalHours);
        $hoursLeft = $row->h_Left + $hoursAdded;
        $hoursLeft=sanitize($hoursLeft);

        if(!mysql_query("UPDATE hours SET total_H='$totalHours' where tutor_Id='$tutorId'"))
            die(mysql_error());

        if(!mysql_query("UPDATE hours SET h_Left='$hoursLeft' where tutor_Id='$tutorId'"))
            die(mysql_error());

        echo"units added";
        include("../shared/hoursLeft.php");
    }
}
mysql_close($connect);
?>