<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(sanitize): Kevin
*This page is used as the function to show details of a booked job for tutors.
*
-->

<?php
session_start();
include("../shared/db.php");
include("../tutors/userauthentication.php");

$connect = connect();

$detail_ID = $_POST['bookingId'];
$detail_ID=sanitize($detail_ID);

$detail_Tutor = $_POST['tutorId'];
$detail_Tutor=sanitize($detail_Tutor);

$sql = "SELECT * FROM `job-Booked` WHERE `book_Id` = '" .$detail_ID. "'";

$query = mysql_query($sql);

while($row = mysql_fetch_object($query))
{
    echo"<script>alert('Student Name: ' + '$row->stud_f_name' + ' ' + '$row->stud_L_name'
        + '\\nJob Subject: ' + '$row->topic'
        + '\\nLanguage: ' + '$row->language'
        + '\\nTime: ' + '$row->Time'
        + '\\nLocation: ' + '$row->place'
        + '\\nPhone Number: ' + '$row->Studmobile'
        + '\\nEmail: ' + '$row->Studemail'
        + '\\nClass: ' + '$row->class'
        + '\\nOther class: ' + '$row->other_class'
        + '\\nComment: ' + '$row->comments'
        )</script>";
        echo"<script>window.top.location.href='ViewBooking.php'</script>";
    break;
}

mysql_close($connect);
?>