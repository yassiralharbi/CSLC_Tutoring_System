<!--
*Author: Jiefu Yang
*Time: May 2015
* Security Check(getCheck): Yassir
* Security Check(hash): Yassir
* Security Check(sanitize): Kevin
*
*This page is used as the function to show details of a job for tutors.
*
-->
<?php
session_start();
include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$detail_Tutor = $_GET['tutorHash'];
$detail_Tutor = getCheck($detail_Tutor);
$sql = "SELECT * FROM `tutors` WHERE get_hash ='" .$detail_Tutor. "'";
$query = mysql_query($sql);

$row = mysql_fetch_object($query);
$tutorId = $row->tutor_Id;
$detail_Tutor=sanitize($detail_Tutor);

$detail_ID = $_GET['jobHash'];
$detail_ID = getCheck($detail_ID);
$detail_ID = events_hash_finder_do($detail_ID);
$detail_ID=sanitize($detail_ID);
/*echo"<SCRIPT language=javascript>
opener.location= 'workHourManagement.php';
</script>";*/

$sql = "SELECT * FROM `events` WHERE event_Id = '" .$detail_ID. "'";

$query = mysql_query($sql);
if(!mysql_query($sql))
{
    echo "<br/>";
    echo "<br/>";
    die('Error: ' . mysql_error());
    echo "<br/>";echo "<br/>";
}
while($row = mysql_fetch_object($query))
{
    echo"<script>alert('Student Name: ' + '$row->StudFname' + ' ' + '$row->StudLname'
        + '\\nJob Subject: ' + '$row->topic'
        + '\\nLanguage: ' + '$row->language'
        + '\\nTime: ' + '$row->date_time1'
        + '\\nLocation: ' + '$row->location'
        + '\\nPhone Number: ' + '$row->Studmobile'
        + '\\nEmail: ' + '$row->Studemail'
        )</script>";

    $tutor= hash_finder($tutorId);
    echo"<script>window.top.location.href='adminViewJob.php?value=" .$tutor. "'</script>";
    break;
}

mysql_close($connect);
?>
