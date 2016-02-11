<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(authentication): Yassir
* Security Check(sanitize): Kevin
*This page is used as the function to show details of a job for tutors.
*
-->

<?php
session_start();
include("../shared/db.php");
include("../tutors/userauthentication.php");
$connect = connect();

$detail_ID = $_POST['jobId'];
$detail_ID=sanitize($detail_ID);
$detail_Tutor = $_POST['tutorId'];
$detail_Tutor=sanitize($detail_Tutor);

$sql = "SELECT * FROM `events` WHERE `event_Id` = '" .$detail_ID. "'";

$query = mysql_query($sql);

while($row = mysql_fetch_object($query))
{
    echo"<script>alert('Student Name: ' + '$row->StudFname' + ' ' + '$row->StudLname'
        + '\\nJob Subject: ' + '$row->topic'
        + '\\nLanguage: ' + '$row->language'
        + '\\nTime: ' + '$row->date_time1'
        + '\\nLocation: ' + '$row->location'
        + '\\nPhone Number: ' + '$row->Studmobile'
        + '\\nEmail: ' + '$row->Studemail'
        + '\\nClass: ' + '$row->class'
        + '\\nOther class: ' + '$row->other_class'
        + '\\nComment: ' + '$row->comments'
        )</script>";
        echo"<script>window.top.location.href='ViewJob.php'</script>";
    break;
}

mysql_close($connect);
?>