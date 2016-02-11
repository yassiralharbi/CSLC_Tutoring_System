<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: may 2015-->
<!--*-->
<!--*This page is ajax page with admin authentication to pass vars-->
<!--*-->
<!--*/-->
<?php
require_once("../shared/db.php");
include("../admin/adminauthentication.php");
$con=connect();

header("Cache-Control: no-cache"); 
$id=$_GET["id"];
// $result=mysql_query("select * from teaching Inner JOIN tutors on teaching.tutor_Id=tutors.tutor_Id where language='$id'");
// //echo "<script src=\"TimePass.js\"></script> ";
// $rt='<select name="sTrade" id="s_trade">';
// while($rs=mysql_fetch_array($result)){
// $rt.='<option value="'.$rs["tutor_Id"].'" onchange="showHint(this.value)">'.$rs["FirstName"].'</option>';
// }
// $rt.='</select>';
// echo $rt;

?>

<script src="../js/TimePass.js"></script>
<!-- <tr><td><p>tutor</p></td>
<td><select name="tutor_Id[]" onchange="showHint(this.value)" >
    <option value="0">Select tutor</option>

            <?php
            $con=connect();
            $id=sanitize($id);
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

    <select name="tutor_Id[]"  id="s_trade" onchange="admin_time(this.value)">
        <option value="-2">——tutor——</option>
    <?php
    //$sql = "SELECT * FROM tutors WHERE hired  = 'YES '";
    $id=sanitize($id);
    $result=mysql_query("select * from teaching Inner JOIN tutors on teaching.tutor_Id=tutors.tutor_Id where teaching.language='$id' AND tutors.hired='YES'");

    //echo "<option value='0'>Anyone avaliable</option>";

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


