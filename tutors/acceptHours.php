<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check: Yassir
*This page is used as the function to modify the hourbank when a tutor accepts a job.
*
-->

<?php
//$accept_ID = $_GET['value'];
/*session_start();
include("../shared/db.php");
$connect = connect();*/
include("../tutors/userauthentication.php");
$sql = "SELECT * FROM hours WHERE tutor_Id  = '" . $accept_Tutor . "'";
$query = mysql_query($sql);
if (mysql_num_rows($query) == 1)
{
    $row = mysql_fetch_object($query);
    $hoursUsed = $row->h_Used + 1;
    $hoursLeft = $row->h_Left - 1;
    $hoursUnclaimed = $row->h_unclaimed + 1;

    if($hoursLeft >= 0)
    {
        $sql= "update hours set h_Used='$hoursUsed' where tutor_Id='$accept_Tutor'";
        mysql_query($sql) or die(mysql_error());
        $sql= "update hours set h_Left='$hoursLeft' where tutor_Id='$accept_Tutor'";
        mysql_query($sql) or die(mysql_error());
        $sql= "update hours set h_unclaimed='$hoursUnclaimed' where tutor_Id='$accept_Tutor'";
        mysql_query($sql) or die(mysql_error());
        include("../shared/hoursLeft.php");

    }
    else
    {
        echo"Error: No enough hours, can't accept more jobs'";
        header("Refresh: 1; URL=ViewJob.php");
    }
}
else
{
    echo"Error: There are two tutors containing the same tutor ID";
    header("Refresh: 1; URL=ViewJob.php");
}

?>