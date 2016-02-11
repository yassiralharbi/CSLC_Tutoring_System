<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to manage languages and courses in the system
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


<div id="mainContent">
    <?php
    $connect = connect();

    $sql ="SELECT * FROM `Languages` ORDER BY `language` ASC ";



    $query = mysql_query($sql);

    $rowcount = mysql_num_rows($query);
    $i = 0;




    echo "<html>

		<h1>Languages</h1>
		<center>
		<table class='CSSTableGenerator'>
		<tr>

		<td><h5>Language</h5></td>
		<td><h5>Delete</h5></td>

		<td><h5>Language</h5></td>
		<td><h5>Delete</h5></td>
		</tr>";

    if (mysql_num_rows($query) == 0)
    {
        echo "No courses found";
    }
    else
    {
        while($row = mysql_fetch_object($query))
        {

            echo "</td><td>" . $row->language;
            echo "</td><td><a href='../admin/Delete_language.php?value=".$row->get_hash."' onclick=\"return confirm('Do you want to delete this info');\"'><img src='../image/b_drop.png' alt='Angry face' border=0/></img></a>";
            $i++;
            if ($i==2){echo "</tr>";
            $i=0;

            }





        }
    }
    echo "</table>";
echo"</center>";

    mysql_close($connect);
    ?>



    <span style="font-size:20px ; " ><br/>
        <center>
        <table class='CSSTableGenerator'><tr><td> <h5>Add Languages</h5></td></tr><tr><td>
            <form action="../admin/addlanguage.php" id = "language"method="post" enctype="multipart/form-data">
                <textarea name="lang" id="lang" cols="120%"form="language" onblur="if (this.value == '') {this.value = 'use comma to separate languages';}"   onfocus="if (this.value == 'use comma to separate languages') {this.value = '';}">use comma to separate languages</textarea>
                </td></tr><tr><td>
                <input type="submit" value="Add" name="submit"></td></tr>
        </table>
        </center>
            </form>



    </span>


    <br>
    <hr>
    <br>

    <?php
    $connect = connect();

    $sql ="SELECT * FROM courses";


    $query = mysql_query($sql);
$c=0;

    echo "<html>

		<h1>Courses</h1>
		<center>
		<table class='CSSTableGenerator'>
		<tr>

		<td><h5>Course</h5></td>
		<td><h5>Delete</h5></td>
        <td><h5>Course</h5></td>
		<td><h5>Delete</h5></td>

		</tr>";

    if (mysql_num_rows($query) == 0)
    {
        echo "No courses found";
    }
    else
    {
        while($row = mysql_fetch_object($query))
        {
            echo "</td><td>" . $row->corse_Id;
            echo "</td><td><a href='../admin/Delete_courses.php?value=".$row->get_hash."' onclick=\"return confirm('Do you want to delete this info');\"'><img src='../image/b_drop.png' alt='Angry face' border=0/></img></a>";
            $c++;
            if ($c==2) {
                echo "</tr>";
                $c = 0;
            }





        }
    }
    echo"</table>";
    echo"</center>";
    mysql_close($connect);

    ?>

    <br>
        <span style="font-size:20px ; " ><br/>
            <center>
            <table class='CSSTableGenerator'><tr><td> <h5>Add Course</h5></td></tr><tr><td>
                        <form action="../admin/add_course.php" id = "course"method="post" enctype="multipart/form-data">
                            <textarea name="course" id="course" cols="120%"form="course" onblur="if (this.value == '') {this.value = 'use comma to separate courses';}"   onfocus="if (this.value == 'use comma to separate courses') {this.value = '';}">use comma to separate courses</textarea>
                    </td></tr><tr><td>
                        <input type="submit" value="Add" name="submit"></td></tr>
            </table>
            </center>
            </form>



    </span>

    <span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>
    <br>
    <div id='bar'></div>
</body>
</html>
<?php
include "../header&footer/footer.html";
?>