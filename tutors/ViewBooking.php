<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check(authentication): Yassir
* Security Check(sanitize): Kevin
*This page is used as the interface of the job booked page of the tutor side.
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
	<td><h5>Cancel</h5></td>
	<tr>";

    $tutorId = $username;
    $tutorId=sanitize($tutorId);
    include("../shared/updateBooking.php");
    $tutorId=sanitize($tutorId);
    $query = mysql_query("SELECT * FROM `job-Booked` WHERE `tutor_Id` = '" .$tutorId. "'");

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
            ?>

            <form id='bookingDetail' method='POST' action='bookingDetail.php'>
                <td>
                    <input type="hidden" name="bookingId" value=<?php echo $row->book_Id?>>
                    <input type="hidden" name="tutorId" value=<?php echo $row->tutor_Id?>>
                    <input type="submit" name="bookingDetail" value="View" onclick="window.location='bookingDetail.php'">
                </td>
            </form>

            <form id='JobCancel' method='POST' action='JobCancel.php'>
                <td>
                    <input type="hidden" name="bookingId" value=<?php echo $row->book_Id?>>
                    <input type="hidden" name="tutorId" value=<?php echo $row->tutor_Id?>>
                    <input type="submit" name="JobAccept" value="Cancel" onclick="alert('Do you want to cancel this job')">
                </td>
            </form>
        <?php
        }
    }
    echo "</table>";
    echo"</center>";
    mysql_close($connect);
    ?>

</html>
<html>
<div class="pageFooter">

    <span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>

</div>
<div id='banner'></div>
</html>
<?php
include "../header&footer/footer.html";
?>