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
<!--<div id="content">-->
<!--<td>Filter By</td>-->
<!--<tr><td><p>Language</p></td>-->
<!--    <td><select name="languages[]" onchange="showHint1(this.value)">-->
<!--        <option value="0">Select Language</option>-->
<!--           --><?php
//            $con=connect();
//            $result = mysql_query("SELECT * FROM Languages ");
//
//
//            while($row = mysql_fetch_array($result))
//            {
//                echo "<option value=\"$row[language]\"> $row[language] </option>";
//            }
//
//            ?>
<!--    </select></td></tr>-->
<!--<br\>-->
<!---->
<!--    <tr><td><p>Tutor</p></td>-->
<!--        <td><select name="tutor_Id[]" onchange="showHint(this.value)" >-->
<!--    <option >Select tutor</option>-->
<!--    <option value="0">all</option>-->
<!--            --><?php
//            $con=connect();
//            $result = mysql_query("SELECT * FROM tutors where hired='YES'");
//
//
//            while($row = mysql_fetch_array($result))
//  {
//  echo "<option value=\"$row[tutor_Id]\"> $row[FirstName] $row[LastName]</option>";
//  }
//            // foreach($options as $lang){
//            //     echo "<option value=\"$lang\">$lang</option>";
//            // }
//            ?>
<!---->
<!--    </select></td></tr>-->
<!--    <tr><td><div id="txtHint"></div></td></tr>-->
<!---->
<!--</div>-->
<script type="text/javascript" src="../js/jquery.js"></script>
<table>
<tr><td><div class="col-wid"> View by language</div></td>
    <td> <select name="languages[]" id="lang" onchange="admin_lang(this.value)"required>
            <?php
            $con=connect();
            $result = mysql_query("SELECT * FROM Languages ");


            while($row = mysql_fetch_array($result))
            {
                echo "<option value=\"$row[language]\"> $row[language] </option>";
            }?>

        </select></td></tr>

<!--            <select name="language[]" id="lang">-->
<!--                <option value="-1">——select language——</option>-->
<!--                --><?php
//
//
//                $result=mysql_query("select * from Languages ");
//
//                while($row = mysql_fetch_array($result))
//                {
//                    echo "<option value=\"$row[language]\"> $row[language] </option>";
//                } ?>
<!---->
<!--            </select>-->
<tr>
    <td>By tutor</td>
    <td><span id="quote">
            <select name="sTrade">
                <option value="-2">--tutor--</option>
            </select>
            </span></td>
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