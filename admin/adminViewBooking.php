<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(getCheck): Yassir
* Security Check(hash): Yassir
* Security Check(sanitize): Kevin
*This page is used as the interface of the job booked page of the tutor side.
*
-->

<?php
session_start();


include("../shared/db.php");
//include("tutorHeadForAdmin.html");
include("../admin/adminauthentication.php");
$connect = connect();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Job Booking</title>
    <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />
</head>

<body class="oneColElsCtrHdr">
<div id="mainContent">

    <?php

    echo"<html>
	<title>Job Booking</title>
	</head>
	<body>
	<h1>Bookings</h1>
	<center>
	<table class='CSSTableGenerator'>
	<tr>
	<td><h5>Student Name</h5></td>
	<td><h5>Language</h5></td>
	<td><h5>Time</h5></td>
	<td><h5>Meeting Place</h5></td>
	<td><h5>Detail</h5></td>
	<tr>";

    //$tutorId= $_GET['value'];
    //$tutorId=sanitize($tutorId);

    $value = $_GET['value'];
    $value = getCheck($value);
    $value = sanitize($value);
    $tutorHash = $value;
    $tutorHash = sanitize($tutorHash);
    $value = hash_finder_do($value);
    $value = sanitize($value);
    $tutorId=$value;
    $tutorId = sanitize($tutorId);
    include("../shared/updateBooking.php");
    $tutorId = sanitize($tutorId);
    $query = mysql_query("SELECT * FROM `job-Booked` WHERE `tutor_Id` = '" .$tutorId. "'");
    echo "<SCRIPT language=javascript>
            opener.location= 'workHourManagement.php';
        </script>";
    if (mysql_num_rows($query) == 0)
    {
        echo "No records found";
    }

    else
    {
        while($row = mysql_fetch_object($query))
        {
            echo "<tr>";
            echo "<td>" .$row->stud_f_name ,' ', $row->stud_L_name."</td>";
            echo "<td>" .$row->language."</td>";
            echo "<td>" .$row->Time."</td>";
            echo "<td>" .$row->place."</td>";
            echo "<td>";

            $sql1 = "SELECT * FROM `tutors` WHERE  `tutor_Id` =  '" . $tutorId ."'";
            $query1 = mysql_query($sql1);
            $row1 = mysql_fetch_object($query1);

            echo "<a href='adminBookingDetail.php?bookingHash=".$row->get_hash."&tutorHash=".$row1->get_hash."'><img src='../image/detail.png' alt='Angry face' border=0/></img></a>";
            echo "</td>";
            echo"</tr>";
        }
    }
    echo"</table>";
    echo"</center>";
    mysql_close($connect);
    ?>
</html>