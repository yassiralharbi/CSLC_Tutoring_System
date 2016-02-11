<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: May 2015-->
<!--*-->
<!--*This page is for ajax time passing in student site-->
<!--*-->
<!--*/-->
<?php
require_once("../shared/db.php");
$con=connect();

header("Cache-Control: no-cache"); 
$id=$_GET["id"];


?>

<script src="../js/TimePass.js"></script>
<!-- <tr><td><p>tutor</p></td>
<td><select name="tutor_Id[]" onchange="showHint(this.value)" >
    <option value="0">Select tutor</option>

            <?php
            $con=connect();
            $result = mysql_query("SELECT * FROM teaching where language='$id'");
           

            while($row = mysql_fetch_array($result))
  {
  echo "<option value=\"$row[tutor_Id]\"> $row[tutor_Id] </option>";
  }
            // foreach($options as $lang){
            //     echo "<option value=\"$lang\">$lang</option>";
            // }
            ?>

    </select></td></tr> -->

    <select name="tutor_Id[]"  id="s_trade" onchange="showHint(this.value)">
        <option value="-2">——tutor——</option>
    <?php
    //$sql = "SELECT * FROM tutors WHERE hired  = 'YES '";
    $result=mysql_query("select * from teaching Inner JOIN tutors on teaching.tutor_Id=tutors.tutor_Id where teaching.language='$id' AND tutors.hired='YES'");


    while($rs=mysql_fetch_array($result)){
        echo "<option value='$rs[tutor_Id]'>$rs[FirstName] $rs[LastName]</option>";

    }

//    $query = mysql_query($sql);
//                            $firstName = array();
//                            $secondName = array();
//                            $i = 0;
//                            while($row = mysql_fetch_object($query))
//                            {
//                                $firstName[$i] = "$row->FirstName";
//                                $secondName[$i] = "$row->LastName";
//                                $id = $row->tutor_Id;
//                                echo "<option name = tutor1 value='$id'>$firstName[$i] $secondName[$i]</option>";
//
//                                $i++;
//                            }
//                            ?>
    </select>


