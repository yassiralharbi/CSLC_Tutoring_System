<!--
*Author: Jiefu Yang
*Time: May 2015
* Security Check(getCheck): Yassir
* Security Check(hash): Yassir
* Security Check(sanitize): Kevin
*
*This page is used as the interface of the job page of the tutor side.
*
-->

<?php
session_start();
include("../shared/db.php");
//include("tutorHeadForAdmin.html");
include("../admin/adminauthentication.php");
$connect = connect();
$username= $_SERVER["REMOTE_USER"];
$username=sanitize($username);
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
    $connect = connect();

    echo"<html>
	<title>Jobs</title>

	</head>
	<body>
	<h1>Jobs</h1>
	<center>
	<table class='CSSTableGenerator'>
	<tr>
	<td><h5>Student Name</h5></td>
	<td><h5>Language</h5></td>
	<td><h5>Time</h5></td>
	<td><h5>Meeting Place</h5></td>
	<td><h5>Details</h5></td>
	<tr>";

    //$tutorId = $_GET['value'];
    //$tutorId=sanitize($tutorId);

    $value = $_GET['value'];
    $value = getCheck($value);
    $tutorHash = $value;
    $value = hash_finder_do($value);
    $tutorId=$value;
    $tutorId = sanitize($tutorId);

    $result = mysql_query("SELECT language FROM teaching WHERE `tutor_Id` = '" .$tutorId ."'");
    echo "<SCRIPT language=javascript>
            opener.location= 'workHourManagement.php';
        </script>";
    while (list($n) = mysql_fetch_row($result))
    {
        $languages[]=$n;
    }

    $len = count($languages);

    date_default_timezone_set('Australia/Adelaide');
    $localeTime = date('Y-m-d H:i:s',time());

    for($i = $len-1;$i >= 0;$i--)
    {
        $lang = $languages[$i];
        $lang = sanitize($lang);
        $query = mysql_query("SELECT * FROM `events` WHERE  `language` =  '" . $lang ."'");

        while($row = mysql_fetch_object($query))
        {
            $time = $row->date_time1;

            if(strtotime($time)<=strtotime($localeTime))
            {
                $eventId = $row->event_Id;
                $firstName = $row->StudFname;
                $lastName = $row->StudLname;
                $email = $row->Studemail;
                $mobile = $row->Studmobile;
                $time = $row->date_time1;
                $otherClass = $row->other_class;
                $topic = $row->topic;
                $place = $row->location;
                $class = $row->class;
                $language = $row->language;

                $comment = $row->comments;

                $sql = "INSERT INTO `booking-history` (`stud_f_name`, `stud_L_name`,`Studemail`,`Studmobile`,`language`,`Time`,`other_class`,`topic`,`place`,`class`,`comments`,`tutor_Id`) VALUES ('$firstName','$lastName','$email','$mobile','$language','$time','$otherClass','$topic','$place','$class','$comment','$tutorId')";
                $query = mysql_query($sql);

                $sql = "DELETE FROM `events` WHERE `event_Id`  = '" .$eventId . "'";
                $query = mysql_query($sql);
            }
            else
            {
                echo "<tr>";
                echo "<td>" .$row->StudFname ,' ', $row->StudLname."</td>";
                echo "<td>" .$row->language."</td>";
                echo "<td>" .$row->date_time1."</td>";
                echo "<td>" .$row->location."</td>";
                //echo "<td>" .$row->get_hash."</td>";
                echo "<td>";

                $sql1 = "SELECT * FROM `tutors` WHERE  `tutor_Id` =  '" . $tutorId ."'";
                $query1 = mysql_query($sql1);
                $row1 = mysql_fetch_object($query1);
                
                echo "<a href='adminJobDetail.php?tutorHash=".$row1->get_hash."&jobHash=".$row->get_hash."'><img src='../image/detail.png' alt='Angry face' border=0/></img></a>";
                echo "</td>";
                echo"</tr>";
            }
        }
    }
    echo "</table>";
    echo"</center>";
    mysql_close($connect);
    ?>
</html>