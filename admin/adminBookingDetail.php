<!--
*Author: Jiefu Yang
*Time: May 2015
* Security Check(get): Yassir
* Security Check(sanitize): Kevin
*
*This page is used as the function to show details of booked jobs for a tutor.
*
-->
<?php
session_start();
include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$detail_Tutor = $_GET['tutorHash'];
$detail_Tutor = getCheck($detail_Tutor);
$detail_Tutor = sanitize($detail_Tutor);
$sql = "SELECT * FROM tutors WHERE get_hash = '" .$detail_Tutor. "'";
$query = mysql_query($sql);

while($row = mysql_fetch_object($query))
{
    $tutorId = $row->tutor_Id;
}

$detail_Tutor=sanitize($detail_Tutor);

$detail_ID = $_GET['bookingHash'];
$detail_ID = getCheck($detail_ID);
$detail_ID = job_hash_finder_do($detail_ID);
$detail_ID = sanitize($detail_ID);
/*echo"<SCRIPT language=javascript>
opener.location= 'workHourManagement.php';
</script>";*/
$sql = "SELECT * FROM `job-Booked` WHERE `book_Id` = '" .$detail_ID. "'";
if(!mysql_query($sql,$connect))
{
    echo "<br/>";
    echo "<br/>";
    die('Error: ' . mysql_error());
    echo "<br/>";echo "<br/>";
}
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

    $tutor= hash_finder($tutorId);
    echo"<script>window.top.location.href='adminViewBooking.php?value=".$tutor." '</script>";
    break;
}

mysql_close($connect);
?>