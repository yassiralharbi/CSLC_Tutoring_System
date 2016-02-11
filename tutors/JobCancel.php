<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check(getCheck): Yassir
* Security Check(sanitize): Kevin
*This page is used as the function to delete a job for tutors.
*
-->

<?php
session_start();
include("../shared/db.php");
include("../tutors/userauthentication.php");

$connect = connect();

$delete_Id = $_POST['bookingId'];
$delete_Id=sanitize($delete_Id);

$delete_Tutor = $_POST['tutorId'];
$delete_Tutor=sanitize($delete_Tutor);

$counter = 0;

$sql = "SELECT * FROM `hours` WHERE `tutor_Id` =  '" .$delete_Tutor. "'";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);
if($row->h_unclaimed <= 0)
{
    echo"Error: You have no hours unclaimed, so you can't cancel this job.";
    header("Refresh: 1; URL=ViewBooking.php");
    exit;

}

$sql = "SELECT * FROM `job-Booked` WHERE `book_Id` = '" .$delete_Id. "'";
$query = mysql_query($sql);

if (mysql_num_rows($query) == 1)
{
    $sql = "SELECT * FROM hours WHERE tutor_Id  = '" . $delete_Tutor . "'";
    $query = mysql_query($sql);

    if (mysql_num_rows($query) == 1)
    {
        $row = mysql_fetch_object($query);


        if($row->h_Used < 1)
        {
            echo"<script>alert('Error: No enough hours used, cannot delete this job');
    		window.top.location.href='ViewBooking.php'</script>";
            exit;
        }

        else
        {
            $sql = "SELECT * FROM `job-Booked` WHERE `book_Id` = '" .$delete_Id. "'";
            $query = mysql_query($sql);
            $row = mysql_fetch_object($query);

            $eventId = $row->event_Id;
            $firstName = $row->stud_f_name;
            $lastName = $row->stud_L_name;
            $email = $row->Studemail;
            $mobile = $row->Studmobile;
            $time = $row->Time;
            $otherClass = $row->other_class;
            $topic = $row->topic;
            $place = $row->place;
            $class = $row->class;
            $language = $row->language;
            $tutorId = $row->tutor_Id;
            $comment = $row->comments;
            $hash = $row->get_hash;
            $sql = "INSERT INTO `events`(StudFname,StudLname,Studemail,Studmobile,language,date_time1,other_class,topic,location,class,comments,tutor_Id,get_hash)
                    VALUES('$firstName','$lastName','$email','$mobile','$language','$time','$otherClass','$topic','$place','$class','$comment','$tutorId','$hash')";
            //$query = mysql_query($sql);
	    if(!mysql_query($sql))
		{
    			echo "<br/>";
    			echo "<br/>";
    			die('Error: ' . mysql_error());
    			echo "<br/>";echo "<br/>";
		}
            $sql = "DELETE FROM `job-Booked` WHERE book_Id  = '" . $delete_Id . "' and tutor_Id = '" .$delete_Tutor. "'";
            $query = mysql_query($sql);

            $sql = "SELECT * FROM tutors WHERE tutor_Id = '" . $accept_Tutor . "'";
            $query = mysql_query($sql);
            $row = mysql_fetch_object($query);
            $fName = $row->FirstName;
            $lName = $row->LastName;
            include("jobCancelMailer.php");

            include("cancelHours.php");
            echo"Job Cancelled";
            //echo"<script>alert('Job Deleted');
   			//window.top.location.href='cancelHours.php?value='" . $delete_Tutor. "''</script>";
        }
    }
}

else
{
    echo"<script>alert('Error, two or more jobs contain same job ID');
	window.top.location.href='ViewBooking.php'</script>";
}

mysql_close($connect);
?>