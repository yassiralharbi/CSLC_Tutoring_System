<!--
*Author: Jiefu Yang
*Time: April 2015
*
* Security Check(authentication): Yassir
*This page is used as the work hour management page.
*
-->

<?php
session_start();
$username= $_SERVER["REMOTE_USER"];
//$username=sanitize($username);

include("../shared/db.php");
include("../admin/adminauthentication.php");
include "../header&footer/header.html";
include "../header&footer/admin_head.html";

$connect = connect();

?>

<?php
$sql = "SELECT * FROM tutors WHERE tutor_Id = $id";
$query = mysql_query($sql);
$row = mysql_fetch_object($query);
$hash = $row->get_hash;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Work Hour Management</title>
    <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.validate.js"></script>

</head>

<body class="oneColElsCtrHdr">
<div id="mainContent">
    <?php

    $connect = connect();

    $sql = "select * from hours ";
    $query = mysql_query($sql);

    $hours = "select * from semesterHours ";
    $query1 = mysql_query($hours);
    $hours = mysql_fetch_object($query1);

    $HOURS = $hours->hours_left;
    $hour = 0;
    if(isset($hours->hours_left))
    {
        $hour = $HOURS;
        if($hour >= 0)
        {
            echo"You have $hour units(1 unit = 30 minutes) left in the hour bank.";
        }
        else
        {
            echo"Error: You have $hour units(1 unit = 30 minutes) left in the hour bank. Please recharge.";
        }
    }
    else
    {
        $hour = 0;
        echo"You have just reset the hour bank; there are no work hours in the hour bank at the moment.";
    }
    ?>
    </div>
</body>

<div>
    <form id="resetHourBank" method="post" action="resetHourBank.php">
        <?php
        echo"Reset the hour bank: ";
        echo"<a href='resetHourBank.php' onclick=\"return confirm('Are you sure you  wish to reset the entire hour bank?');\"'><img src='../image/b_drop.png' alt='Angry face' border=0/></img></a>";
        ?>
        </table>
    </form>
</div>

<div>
    <form id="semesterHours" method="post" action="semesterHours.php">

        <table class='CSSTableGenerator' >
            <h3>Insert semester hour units(1 unit = 30 minutes)</h3>

            Semester Hour Units: <input type="number"onchange="showHint(this.value)" name="semesterHours" required>
            <br>
            <input type="submit">

    </form>


<form id="resetHours" method="post" action="resetHours.php">

    <input type="button" name="resetHours" value="Reset" onclick="window.location='resetHours.php'"/>
    </table>
</form>
</div>

<div>
    <center>
<table class='CSSTableGenerator' align="center">
        <h3>Tutor Work Hour</h3>
		<tr>
		<td><h5>Tutor Name</h5></td>
		<td><h5>Total Units</h5></td>
		<td><h5>Units Left</h5></td>
		<td><h5>Units Used</h5></td>
		<td><h5>Units Claimed</h5></td>
		<td><h5>Units Unclaimed</h5></td>
		<td><h5>Unaccepted Requests</h5></td>
		<td><h5>Accepted Requests</h5></td>
		<td><h5>Claim Units</h5></td>
		<td><h5>Add Units</h5></td>
		<td><h5>Delete Units</h5></td>
		</tr>

    <?php
    $connect = connect();
echo"<div id=txtHint>";
if (mysql_num_rows($query) == 0)
{
    echo "No records found";
}
else
{
    $sql = "select * from tutors WHERE status = 'Enabled' and hired = 'Yes' ";
    $query = mysql_query($sql);

    while($row = mysql_fetch_object($query))
    {
        echo "<tr>";
        $id = $row->tutor_Id;
        $SQL = "select * from hours WHERE tutor_Id = '$id'";
        $QUERY = mysql_query($SQL);
        $ROW = mysql_fetch_object($QUERY);
        if(!mysql_query($SQL))
        {
            echo "<br/>";
            echo "<br/>";
            die('Error: ' . mysql_error());
            echo "<br/>";echo "<br/>";
        }
        if ($id == $ROW->tutor_Id)
        {
            if($ROW->h_Left <= 3)
            {
                echo "<td style=color:red;>" . $row->FirstName . " " . $row->LastName . "</td>";
            }
            if($ROW->h_Left > 3)
            {
                echo "<td>" . $row->FirstName . " " . $row->LastName . "</td>";
            }
        }
        echo "<td>" . $ROW->total_H . "</td>";
        echo "<td>" . $ROW->h_Left . "</td>";
        echo "<td>" . $ROW->h_Used . "</td>";
        echo "<td>" . $ROW->h_claimed . "</td>";
        echo "<td>" . $ROW->h_unclaimed . "</td>";
        echo"<td>
        <a href='adminViewJob.php?value=" . $row->get_hash . "' onclick = location.reload() target='_blank'><img src='../image/detail.png' alt='Angry face' border=0/></img></a>
        </td>";

        echo"<td>
        <a href='adminViewBooking.php?value=" . $row->get_hash . "'onclick = location.reload() target='_blank'><img src='../image/detail.png' alt='Angry face' border=0/></img></a>
        </td>";
?>
        <form id='claimHours' method='POST' action='claimHours.php'>
        <td>
            <input type="hidden" name="tutorId" value=<?php echo $id?>>
            <input type="number" name="hoursClaimed" value="claimHours" size="5" required>
            Units
            <input type="submit" name="claimHour" value="claim">
        </td>
    </form>

    <form id='addHours' method='POST' action='addHours.php'>
        <td>
            <input type="hidden" name="tutorId" value=<?php echo $id?>>
            <input type="number" name="hoursAdded" value="addHours" size="5" required>
            Units
            <input type="submit" name="addHour" value="add">
        </td>
    </form>

    <form id='deleteHours' method='POST' action='deleteHours.php'>
        <td>
            <input type="hidden" name="tutorId" value=<?php echo $id?>>
            <input type="number" name="hoursDeleted" value="deleteHours" size="5" required>
            Units
            <input type="submit" name="deleteHour" value="delete">
        </td>
    </form>

    <?php
    }
}
mysql_close($connect);
?>

</table>
        </center>
</div>
<span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>
<div id='bar'></div>
</html>
<?php
include "../header&footer/footer.html";
?>