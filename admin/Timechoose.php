<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: April 2015-->
<!--*-->
<!--*This page is timetable page for admin site-->
<!--*-->
<!--*/-->

<html>
<head>
    <title>Time Range Selector</title>
    <script src="../js/TimePass.js"></script>
  </head>

<body> 
<?php
session_start();
include("../shared/db.php");
include("../admin/adminauthentication.php");
include "../header&footer/header.html";
include "../header&footer/admin_head.html";
$connect = connect();
?>

<script type="text/javascript" src="../js/jquery.js"></script>
<table>
<tr>
    <td><div class="col-wid"> View by language</div></td>
    <td> <select name="languages[]" id="lang" onchange="admin_lang(this.value)"required>
            <?php
            $con=connect();
            $result = mysql_query("SELECT * FROM Languages ");

            while($row = mysql_fetch_array($result))
            {
                echo "<option value=\"$row[language]\"> $row[language] </option>";
            }?>

        </select></td></tr>
<tr>
<!--    <td>By tutor</td>-->
<!--    <td><span id="quote">-->
<!--            <select name="sTrade">-->
<!--                <option value="-2">--tutor--</option>-->
<!--            </select>-->
<!--            </span></td>-->
    <script language="javascript">
        $("#lang").change(function(){
            $("#quote").load("admin/admin_getstrade.php?id="+$("#lang").val());
        });
    </script>
</tr>
    <span id="txtHint"></span>

</table>

</body>
<span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>


<div id='bar'></div>
<html>
<?php
include "../header&footer/footer.html";
?>