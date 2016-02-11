<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to control the tutors in the system
 */
session_start();

include("../shared/db.php");

include("../admin/adminauthentication.php");

include "../header&footer/header.html";
include("../header&footer/admin_head.html");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.wLanguages99/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User Select</title>

    <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />

</head>

<body >


    <div id="mainContent">
        <?php
        $connect = connect();

        $sql ="SELECT * FROM `language_view` WHERE hired = \"Yes\"";



        $query = mysql_query($sql);






        echo "<html>
		<title>Tutors</title>
		</head>
		<body>
		<h1>Tutors</h1>
		<center>
		<table class='CSSTableGenerator'>

		<tr>
		<td></td>
		<td><h5>Id</h5></td>
		<td><h5>Name</h5></td>
		<td><h5>Languages</h5></td>
		<td><h5>Phone</h5></td>
		<td><h5>Status</h5></td>
		<tr>";

        if (mysql_num_rows($query) == 0)
        {
            echo "No records found";
        }
        else
        {
            while($row = mysql_fetch_object($query))
            {


                echo "<tr><td>";
                echo "<a href='../admin/DeleteTutors.php?value=".$row->hash."' onclick=\"return confirm('Do you want to delete this info');\"'><img src='../image/b_drop.png' alt='Angry face' border=0/></img></a>";
                echo "</td><td>" .$row->tutor_Id;
                echo "</td><td>" . $row->FirstName;
                echo " " . $row->LastName;
                echo "</td><td>" . $row->lang;
                echo "</td><td>" . $row->phone;
                echo "</td><td>" . $row->status;echo"|<a href='../admin/Updatestat.php?value=".$row->hash."' onclick=\"return confirm('Do you want to change tutor status ');\"'><img src='../image/file_edit.png' height =\"16\" width=\"16\" alt='Angry face' border=0/></img></a>";
                $i=$i+1;

            }
        }echo "</table>";
        echo"</center>";

        mysql_close($connect);
        ?>
       <hr>
        <br>

        <?php
        $connect = connect();

        $sql ="SELECT * FROM unhired_language_view";


        $query = mysql_query($sql);

        echo "<html>

		<h1>Applicants</h1>
		<center>
		<table class='CSSTableGenerator'>
		<tr>
		<td></td>
		<td><h5>Name</h5></td>
		<td><h5>Email</h5></td>
		<td><h5>Languages</h5></td>
		<td><h5>Phone</h5></td>
		<td><h5>resume</h5></td>
		<tr>";

        if (mysql_num_rows($query) == 0)
        {
            echo "No records found";
        }
        else
        {
            while($row = mysql_fetch_object($query))
            {
                echo "<tr><td><a href='../admin/hire.php?value=".$row->hash."' onclick=\"return confirm('Do you want to hire this tutor ');\"'><img src='../image/checkmark.png' alt='Angry face' border=0/></img></a>";

                echo "<a href='..a/admin/DeleteTutors.php?value=".$row->hash."' onclick=\"return confirm('Do you want to delete this info');\"'><img src='../image/b_drop.png' alt='Angry face' border=0/></img></a>";

                //echo "</td><td>" .$row->tutor_Id;
                echo "</td><td>" . $row->FirstName;
                echo " " . $row->LastName;
                echo "</td><td>" . $row->email;
                echo "</td><td>" . $row->lang;
                echo "</td><td>" . $row->phone;
                echo "</td><td><a href=".$row->link." target='_blank' onclick=\"return confirm('Download Resume? ');\"'><img src='../image/resume-icon.png' alt='resume' height=\"20\" width=\"20\"border=0/></img></a>";


            }
        }
echo"</table>";
        echo"</center>";
        mysql_close($connect);

        ?>

        <span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>
        <br>
        <div id='bar'></div>
</body>
</html>
<?php
include "../header&footer/footer.html";
?>