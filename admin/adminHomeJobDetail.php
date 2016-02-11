<?php
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.wLanguages99/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>language and courses control</title>

    <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />

</head>

<body >


<div id="mainContent">


    <?php

$connect = connect();

$detail_ID = $_GET['jobId'];

$sql = "SELECT * FROM `events` WHERE `event_Id` = $detail_ID";

$query = mysql_query($sql);




echo "<html>

		<h1 align = center>Job Details</h1>
		<center>
		<table class='CSSTableGenerator'>
		<tr>

		<td><h5>Student Name</h5></td>
		<td><h5>Job Subject</h5></td>
		<td><h5>Language</h5></td>
        <td><h5>Time</h5></td>
		<td><h5>Location</h5></td>
		<td><h5>Phone</h5></td>
		<td><h5>Email</h5></td>
		<td><h5>Dismiss</h5></td>
		<tr>";

if (mysql_num_rows($query) == 0)
{
    echo "No records found";
}
else
{
    while($row = mysql_fetch_object($query))
    {

        echo "</td><td>" . $row->StudFname;
        echo " " . $row->StudLname;
        echo "</td><td>" . $row->topic;
        echo "</td><td>" . $row->language;
        echo "</td><td>" . $row->date_time1;
        echo "</td><td>" . $row->location;
        echo "</td><td>" . $row->Studmobile;
        echo "</td><td>" . $row->Studemail;
        echo "</td><td><a href='dismiss_Job.php?value=".$detail_ID."' onclick=\"return confirm('Do you want to dismiss this job');\"'><img src='../image/b_drop.png' alt='Angry face' border=0/></img></a>";




    }
}
echo"</table>";
    echo"</center>";
    mysql_close($connect);
    ?>



















</body>
</html>