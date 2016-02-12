<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check(authentication): Yassir
*This page is used to update the hours used of Cheryl automatically.
*
-->

<?php
include("authentication.php");
$semesterHours = 0;
$counter = 0;
$hoursLeft = 0;
$sql = "SELECT * FROM semesterHours";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);

$semesterHours = $row->semester_hour;

$sql = "SELECT * FROM hours";
$query = mysql_query($sql);

while($row = mysql_fetch_object($query))
{
    $counter = $counter + $row->h_Left + $row->h_Used;
}

$hoursLeft = $semesterHours - $counter;
$hoursLeft=sanitize($hoursLeft);

mysql_query("UPDATE semesterHours SET hours_left = '$hoursLeft'");
$query = mysql_query($sql);

?>
