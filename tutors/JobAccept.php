<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(authentication): Yassir
* Security Check(sanitize): Kevin
*This page is used as the function to accept a job for tutors.
*
-->

<?php
session_start();

include("../shared/db.php");
include("../tutors/userauthentication.php");
$connect = connect();

$accept_Id = $_POST['jobId'];
$accept_Id=sanitize($accept_Id);

$accept_Tutor = $_POST['tutorId'];
$accept_Tutor=sanitize($accept_Tutor);

$counter = 0;

$sql = "SELECT * FROM `events` WHERE `event_Id` = '" .$accept_Id. "' ";
$query = mysql_query($sql);
if(!mysql_query($sql,$connect))
{
    echo "<br/>";
    echo "<br/>";
    die('Error: ' . mysql_error());
    echo "<br/>";echo "<br/>";
}
if (mysql_num_rows($query) == 1)
{
    $sql = "SELECT * FROM hours WHERE tutor_Id  = '" . $accept_Tutor . "'";
    $query = mysql_query($sql);

    if (mysql_num_rows($query) == 1)
    {
        $row = mysql_fetch_object($query);
        if($row->h_Left < 1)
        {
            echo"<script>alert('Error: No enough hours left, cannot accept this job');
    		window.top.location.href='ViewJob.php'</script>";
            exit;
        }

        else
        {
            $sql = "SELECT * FROM events WHERE event_Id = '" . $accept_Id . "'";
            $query = mysql_query($sql);
            $row = mysql_fetch_object($query);
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
            $hash = $row->get_hash;
            $sql = "INSERT INTO `job-Booked`(event_Id,stud_f_name,stud_L_name,Studemail,Studmobile,language,Time,other_class,topic,place,class,comments,tutor_Id,get_hash)VALUES ('$eventId','$firstName','$lastName','$email','$mobile','$language','$time','$otherClass','$topic','$place','$class','$comment','$accept_Tutor','$hash')";
            $query = mysql_query($sql);

            $sql = "DELETE FROM `events` WHERE `date_time1`  = '" .  $time  . "' and `StudFname` = '" . $firstName . "' and `StudLname` = '" . $lastName . "' and `language` = '" . $language . "'";
            $query = mysql_query($sql);

            $sql = "SELECT * FROM tutors WHERE tutor_Id = '" . $accept_Tutor . "'";
            $query = mysql_query($sql);

            $row = mysql_fetch_object($query);
            $fName = $row->FirstName;
            $lName = $row->LastName;
            include("jobAcceptMailer.php");

            include("acceptHours.php");
            echo " Job Accepted";
            echo "<script type='text/javascript'>window.location.href='ViewBooking.php';</script>";
        }
    }
}

else
{
    echo"<script>alert('Error, two or more jobs contain the same job ID');
	window.top.location.href='ViewJob.php'</script>";
}

mysql_close($connect);
?>