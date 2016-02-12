<?php
/**
 * Created by PhpStorm.
 * User: yassir
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to collect the information from user to add or remove admins
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
        <title>language and courses control</title>
        <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />
    </head>

    <body >
    <?php
    if(isset($_GET['error'])&&$_GET['error']!="")
        echo'<div id="error">'.$_GET['error'].'</div>';
    ?>

    <div id="mainContent">
        <?php
        $connect = connect();
        $sql ="SELECT * FROM `Admins`  ";
        $query = mysql_query($sql);

        echo "<html>

		<h1>Admins Control</h1>
		<center>
		<table class='CSSTableGenerator'>

		<tr>
		<td><h5>Name</h5></td>
		<td><h5>email</h5></td>
        <td><h5>Delete</h5></td>
		</tr>";

        if (mysql_num_rows($query) == 0)
        {
            echo "No admins found";
        }
        else
        {
            while($row = mysql_fetch_object($query))
            {
                echo "</td><td>" . $row->FirstName." ".$row->LastName;
                echo "</td><td>" . $row->email;
                echo "</td><td><a href='../admin/Delete_Admin.php?value=" .$row->get_hash. "'><img src='../image/b_drop.png' alt='Angry face' border=0/></a>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo"</center>";
        mysql_close($connect);
        ?>
    </div>
        <br>
        <hr>
        <br>
        <form action="../admin/admin_control_do.php" method="POST" enctype="multipart/form-data">
		<h1>Add a new admin</h1>
		<center>
		<table class='CSSTableGenerator'>
            <tr>
	            <td>First Name<font color="red">*</font></td>
	            <td><input type="text" name="FirstName" required></td>
            </tr>

            <tr>
                <td>Last Name<font color="red">*</font></td>
                <td><input type="text" name="LastName" required></td>
            </tr>

            <tr>
                <td>Email<font color="red">*</font></td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>School Id<font color="red">*</font></td>
                <td><input type="id" name="id" required></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Submit">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
        </form>

        <span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>
        <br>
        <div id='bar'></div>
    </body>
    </html>
<?php
include "../header&footer/footer.html";
?>