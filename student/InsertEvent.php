<!--
*Author: Zhongjie Kang
*Time: April 2015
*
*This page is the PHP page for request form for booking tutor.
*
-->


<?php

session_start();
include("../shared/db.php");
include "../header&footer/header.html";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Request Tutor</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.validate.js"></script>
<link href="../css/bootstrap-theme.css" rel="stylesheet" type="text/css" media="all">
<script src="../js/bootstrap.js" type="text/javascript"></script>
<style>
    .divcss5{ background: #d7d5d3; color: #292929;width: auto}
    .col-wid {width:200px}table.timelabels  {border-collapse:collapse; border:hidden 1px #ffffff; margin-left:57px;}

</style>

<center><h1 >Request Tutor</h1></center>


<?php
if(isset($_GET['error'])&&$_GET['error']!="")
    echo'<div id="error">'.$_GET['error'].'</div>';

?>
<body>


<center><div class="divcss5">
        <form action="InsertEvent_do.php" method="POST" enctype="multipart/form-data">
            <table>

                <tr><td>First Name<font color="red">*</font></td>

                    <td><input type="text" name="StudFname" id="First Name" maxlength="16" required></td>
                <tr>
                </tr>
                <td>Last Name<font color="red">*</font></td>
                <td><input type="text" name="StudLname" id = "Last Name" maxlength="16" required></td>
                </tr>


                <tr>
                    <td>Email<font color="red">*</font></td>
                    <td><input type="email" name="Studemail" required></td>
                </tr>
                <tr>
                    <td>Mobile<font color="red">*</font></td>
                    <td><input type="number" name="Studmobile"maxlength="20"required></td>
                </tr>

                <tr>
                    <td>Meeting Location</td>
                    <td><input type="text" maxlength="20"name="location" ></td>
                </tr>
                <tr>
                    <td><div class="col-wid">Specific Topic (e.g., pointers, arrays, objects, inheritance, etc.)</div></td>
                    <td><input type="text"maxlength="20" name="topic" ></td>
                </tr>

                <tr>
                    <td><div class="col-wid">What Course Are You Enrolled In?<font color="red">＊</font></div></td>
                    <td><select name="class[]" required>
                            <!--                        <?php
                            //                        $options = getOptions("DESCRIBE courses course_Id ");
                            //                        foreach($options as $class)
                            //                            echo "<option>$class</option>";
                            //                        ?>  -->


                            <?php
                            $con=connect();
                            $result = mysql_query("SELECT * FROM courses ");


                            while($row = mysql_fetch_array($result))
                            {
                                echo "<option value=\"$row[corse_Id]\"> $row[corse_Id] </option>";
                            }

                            ?>
                        </select><font color="red">＊</font>
                    </td>
                </tr>

                <tr>    <td>Other (please specify)</td>
                    <td><input type="text" maxlength="12"name="other_class" ></td>
                </tr>

                 <script type="text/javascript" src="../js/jquery.js"></script>
                <tr><td><div class="col-wid"> What Language Do You Need Assistance With?<font color="red">＊</font></div></td>
                    <td> <select name="languages[]" id="lang" onchange="showHint1(this.value)"required>
                            <?php
                            $con=connect();
                            $result = mysql_query("SELECT * FROM Languages ");


                            while($row = mysql_fetch_array($result))
                            {
                                echo "<option value=\"$row[language]\"> $row[language] </option>";
                            }?>

                        </select></td></tr>


                <tr>
                    <td>Select A Tutor</td>
                    <td><span id="quote">
            <select name="sTrade">
                <option value="-2">——tutor——</option>
            </select>
            </span></td>
                    <script language="javascript">
                        $("#lang").change(function(){
                            $("#quote").load("getstrade.php?id="+$("#lang").val());
                        });
                    </script>
                </tr>
                <tr><td>Tutor Availability<td>

                        <span id="txtHint"></span></td></td></tr>


                        </div>






                <tr>
                    <td>

                        <input type="submit" value="Submit" >
                        <input type="reset" value="Clear">
                    </td>
                </tr>

            </table>
        </form>
</center></div>









<div id="banner"></div>
</body>

</html>


<?php
include "../header&footer/footer.html";
?>