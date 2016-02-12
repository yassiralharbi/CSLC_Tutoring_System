<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.wLanguages99/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />
</head>

<p><b>Notification Board</b></p>
<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to manage the notifications in admin home page . 
* first it checks how many tutors per language then it check  on the un responded jobs
 */
session_start();

include("../shared/db.php");
include("../admin/adminauthentication.php");
$connect = connect();

$sql = "SELECT * FROM tut_per_language WHERE COUNT<2 AND LANGUAGE !='Other'";
$query = mysql_query($sql);

if (mysql_num_rows($query) == 0)
{
    echo "non";
}
else
{
    while($row = mysql_fetch_object($query))
    {
        echo "There is only " . $row->COUNT." ". $row->language." tutors";
        echo "<br>" ;
    }
}

$sql = "SELECT * FROM `events`WHERE Dismiss = 'No'";
$query = mysql_query($sql);

echo"<html>
    <br><br/>
	<table class='CSSTableGenerator'style=width:80%>
	<th colspan='3' style='text-align: center'>Unconfirmed Requests</th>
	<tr>
	<td style='text-align: center'><h5><b>Applicant</b></h5></td>
	<td style='text-align: center'><h5><b>Date</b></h5></td>
	<td style='text-align: center'><h5><b>Detail</b></h5></td>
	<tr>";
if (mysql_num_rows($query) == 0)
{
    echo "No records found";
}
else
{
    while($row = mysql_fetch_object($query))
    {
        echo "<tr>";
        echo "<td style='text-align: center'><h5>" . $row->StudFname . " " . $row->StudLname . "</h5></td>";
        echo "<td style='text-align: center'><h5>" . $row->date_time1 . " </h5></td>";
        echo "<td style='text-align: center'>";
        echo "<a href='../admin/adminHomeJobDetail.php?jobId=" . $row->event_Id . "' target =_new ><h5>view</h5></a>";
        echo "</td>";
        echo "</tr>";
    }
}
echo "</table>";?>
</div>
</html>


