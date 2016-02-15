<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: May 2015-->
<!--*-->
<!--*This page is for ajax time passing in student site-->
<!--*-->
<!--*/-->
<script src="../js/TimePass.js"></script>
<?php
require_once("../shared/db.php");
$con=connect();

header("Cache-Control: no-cache"); 
$id=$_GET["id"];
?>
    <select name="tutor_Id[]"  id="s_trade" onchange="showHint(this.value)">
        <option value="-2">——tutor——</option>

    <?php
    $sql = "select a.tutor_Id,b.FirstName,b.LastName from applicant_language a,tutors b WHERE a.tutor_Id=b.tutor_Id AND a.language='$id' AND b.hired='YES'";
    $result=mysql_query($sql);

    while($rs=mysql_fetch_array($result))
    {
        echo "<option value='$rs[tutor_Id]'>$rs[FirstName] $rs[LastName]</option>";
    }
     ?>
    </select>


