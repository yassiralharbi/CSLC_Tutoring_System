<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(authentication): Yassir
* Security Check(sanitize): Kevin
*This page is used as the interface of the job page of the tutor side.
*
-->

<?php
session_start();

$username= $_SERVER["REMOTE_USER"];

//$username=sanitize($username);

include("../shared/db.php");
include("../header&footer/header.html");
include("../header&footer/head.html");
include("../tutors/userauthentication.php");
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
	<td><h5>Accept</h5></td>
	<tr>";

    $tutorId = $username;
    $tutorId=sanitize($tutorId);
    $result = mysql_query("SELECT language FROM teaching WHERE `tutor_Id` = '" . $tutorId."'");

    while (list($n) = mysql_fetch_row($result))
    {
        $languages[]=$n;
    }

    $len = count($languages);

    date_default_timezone_set('Australia/Adelaide');
    $localeTime = date('Y-m-d H:i:s',time());

    for($i = $len-1;$i >= 0;$i--)
    {
        $sql="SELECT * FROM events WHERE language =  '" . $languages[$i] ."'";
        $query = mysql_query($sql);

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
                $tutorId = $row->tutor_Id;
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
              ?>

                <form id='JobDetail' method='POST' action='JobDetail.php'>
                    <td>
                        <input type="hidden" name="jobId" value=<?php echo $row->event_Id?>>
                        <input type="hidden" name="tutorId" value=<?php echo $tutorId?>>
                        <input type="submit" name="JobDetail" value="View">
                    </td>
                </form>

                <form id='JobAccept' method='POST' action='JobAccept.php'>
                    <td>
                        <input type="hidden" name="jobId" value=<?php echo $row->event_Id?>>
                        <input type="hidden" name="tutorId" value=<?php echo $tutorId?>>
                        <input type="submit" name="JobAccept" value="Accept" onclick="alert('Do you want to accept this job')">
                    </td>
                </form>
    <?php
            }
        }
    }
    echo "</table>";
    echo"</center>";

    mysql_close($connect);
    ?>
    <html>
    </div>
    <div class="pageFooter">

        <span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>

    </div>
    <div id='banner'></div>
    </html>
</html>
<?php
include "../header&footer/footer.html";
?>