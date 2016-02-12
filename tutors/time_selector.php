<!--/*-->
<!--*Author: Yassir->
<!-*Time: May 2015-->
<!--*-->
<!--*Assised Zhongjie-->
<!--*-->
<!--*/-->
<html>

<head>
    <title>Time Range Selector</title>
</head>
<link href="../css/bootstrap-theme.css" rel="stylesheet" type="text/css" media="all">
<script src="../js/bootstrap.js" type="text/javascript"></script>
<style type="text/css">
    table.timelabels  {border-collapse:collapse; border:hidden 1px #ffffff; margin-left:57px;}
    table.timeslots   {border-collapse:collapse; border:solid 1px #006363;}
    table.daysofweek  {border-collapse:collapse; border:hidden 0px #ffffff;}
    .timelabels td    {border-style:hidden; border-width:1px; width:35px; font-size:11px;}
    .timeslots td     {border:solid 1px #006363; width:34px; font-size:12px; background-color:#ffffff;}
    .daysofweek td    {border-style:hidden; border-width:1px; font-size:12px; height:19px;}
    #banner{width:auto;margin:auto;border-bottom:10px solid #000fff;clear:both}
</style>

<body>
<div id="banner"></div>

<?php
session_start();
$username= $_SESSION['user'];
include("../shared/db.php");

$connect = connect();

$queryName = "select *  from tutors where tutor_Id ='$username'";
$sqlName = mysql_query($queryName);
$row = mysql_fetch_assoc($sqlName);

if($_POST){
    $days= array('mon','tue','wed','thu','fri');
    for ($j=0;$j<5;$j++) {
        for($i=1;$i<17;$i++){
            if (isset($_POST[$days[$j].$i])){
                $val[$j][]= $_POST[$days[$j].$i];
            }
        }
        $day[]=implode(',',array_filter($val[$j]));
    }

    $rs=mysql_query("select * from available_time where tutor_Id ='$username'");
    if(mysql_num_rows($rs)<1)
    {

        $sql = "insert into available_time values ('','$username','$day[0]','$day[1]','$day[2]','$day[3]','$day[4]','')";

        mysql_query($sql);

        $success_msg ="<b style='color: green;'>Your available times have been scheduled.";
    }
    else
    {
        $sql = "update available_time set mon='$day[0]',tue='$day[1]',wed='$day[2]',thu='$day[3]',fri='$day[4]' where tutor_Id='$username'";
        mysql_query($sql);

        $success_msg ="<b style='color: green;'>Your available times have been rescheduled.</b>";
    }

}
if(isset($success_msg)){
    ?>
    <div class="alert alert-success">
        <?php
        echo $success_msg;
        ?>
    </div>
<?php
}
?>
<div id="main" align="center">

    <span style="font-size:20px;"><br/></span><br>
    <form method="post" action="">
        <div align="left" style="border-style:solid; border-width:0px; border-color:red; width:760px;">

            <table id="tblTimeLabels" class="timelabels">
                <tr>
                    <td align="center">
                        9:00
                    </td>
                    <td align="center">
                        9:30
                    </td>
                    <td align="center">
                        10:00
                    </td>
                    <td align="center">
                        10:30
                    </td>
                    <td align="center">
                        11:00
                    </td>
                    <td align="center">
                        11:30
                    </td>
                    <td align="center">
                        12:00
                    </td>
                    <td align="center">
                        12:30
                    </td>
                    <td align="center">
                        1:00
                    </td>
                    <td align="center">
                        1:30
                    </td>
                    <td align="center">
                        2:00
                    </td>
                    <td align="center">
                        2:30
                    </td>
                    <td align="center">
                        3:00
                    </td>
                    <td align="center">
                        3:30
                    </td>
                    <td align="center">
                        4:00
                    </td>
                    <td align="center">
                        4:30
                    </td>
                    <td align="center">
                        5:00
                    </td>
                </tr>
            </table>

            <table border="0">
                <tr>
                    <td valign="top">

                        <table id="tblDaysOfWeek" class="daysofweek">
                            <tr>
                                <td align="right">
                                    Monday
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    Tuesday
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    Wednesday
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    Thursday
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    Friday
                                </td>
                            <tr>
                        </table>

                    </td>
                    <td valign="top">
                        <?php
                        $sql1 = "select * from available_time where tutor_Id ='$username'";
                        $result=mysql_query($sql1);
                        if(mysql_num_rows($result)<1)
                        {
                            $mon = array();
                            $tue = array();
                            $wed = array();
                            $thu = array();
                            $fri = array();
                        } else {
                            while ($row = mysql_fetch_array($result)) {
                                $mon = explode(',',$row['mon']);
                                $tue = explode(',',$row['tue']);
                                $wed = explode(',',$row['wed']);
                                $thu = explode(',',$row['thu']);
                                $fri = explode(',',$row['fri']);
                            }
                        }
                        ?>
                        <table id="tblTimeSlotsMon" class="timeslots">
                            <tr>
                                <td id="tdMon1" name="tdMon1" align="center" <?php
                                if (in_array("9.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon1" id="mon1" value="<?php
                                    if (in_array("9.00", $mon)){
                                        echo"9.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />

                                    &nbsp;
                                </td>
                                <td id="tdMon2" name="tdMon2" align="center" <?php
                                if (in_array("9.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon2" id="mon2" value="<?php
                                    if (in_array("9.30", $mon)){
                                        echo"9.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon3" name="tdMon3" align="center" <?php
                                if (in_array("10.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon3" id="mon3" value="<?php
                                    if (in_array("10.00", $mon)){
                                        echo"10.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon4" name="tdMon4" align="center" <?php
                                if (in_array("10.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon4" id="mon4" value="<?php
                                    if (in_array("10.30", $mon)){
                                        echo"10.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon5" name="tdMon5" align="center" <?php
                                if (in_array("11.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon5" id="mon5" value="<?php
                                    if (in_array("11.00", $mon)){
                                        echo"11.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon6" name="tdMon6" align="center" <?php
                                if (in_array("11.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon6" id="mon6" value="<?php
                                    if (in_array("11.30", $mon)){
                                        echo"11.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon7" name="tdMon7" align="center" <?php
                                if (in_array("12.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon7" id="mon7" value="<?php
                                    if (in_array("12.00", $mon)){
                                        echo"12.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon8" name="tdMon8" align="center" <?php
                                if (in_array("12.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon8" id="mon8" value="<?php
                                    if (in_array("12.30", $mon)){
                                        echo"12.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon9" name="tdMon9" align="center" <?php
                                if (in_array("1.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon9" id="mon9" value="<?php
                                    if (in_array("1.00", $mon)){
                                        echo"1.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon10" name="tdMon10" align="center" <?php
                                if (in_array("1.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon10" id="mon10" value="<?php
                                    if (in_array("1.30", $mon)){
                                        echo"1.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon11" name="tdMon11" align="center" <?php
                                if (in_array("2.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon11" id="mon11" value="<?php
                                    if (in_array("2.00", $mon)){
                                        echo"2.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon12" name="tdMon12" align="center" <?php
                                if (in_array("2.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon12" id="mon12" value="<?php
                                    if (in_array("2.30", $mon)){
                                        echo"2.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon13" name="tdMon13" align="center" <?php
                                if (in_array("3.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon13" id="mon13" value="<?php
                                    if (in_array("3.00", $mon)){
                                        echo"3.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon14" name="tdMon14" align="center" <?php
                                if (in_array("3.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon14" id="mon14" value="<?php
                                    if (in_array("3.30", $mon)){
                                        echo"3.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon15" name="tdMon15" align="center" <?php
                                if (in_array("4.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon15" id="mon15" value="<?php
                                    if (in_array("4.00", $mon)){
                                        echo"4.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdMon16" name="tdMon16" align="center" <?php
                                if (in_array("4.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="mon16" id="mon16" value="<?php
                                    if (in_array("4.30", $mon)){
                                        echo"4.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                        <table id="tblTimeSlotsTue" class="timeslots">
                            <tr>
                                <td id="tdTue1" name="tdTue1" align="center" <?php
                                if (in_array("9.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue1" id="tue1" value="<?php
                                    if (in_array("9.00", $tue)){
                                        echo"9.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue2" name="tdTue2" align="center" <?php
                                if (in_array("9.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue2" id="tue2" value="<?php
                                    if (in_array("9.30", $tue)){
                                        echo"9.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue3" name="tdTue3" align="center" <?php
                                if (in_array("10.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue3" id="tue3" value="<?php
                                    if (in_array("10.00", $tue)){
                                        echo"10.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue4" name="tdTue4" align="center" <?php
                                if (in_array("10.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue4" id="tue4" value="<?php
                                    if (in_array("10.30", $tue)){
                                        echo"10.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue5" name="tdTue5" align="center" <?php
                                if (in_array("11.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue5" id="tue5" value="<?php
                                    if (in_array("11.00", $tue)){
                                        echo"11.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue6" name="tdTue6" align="center" <?php
                                if (in_array("11.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue6" id="tue6" value="<?php
                                    if (in_array("11.30", $tue)){
                                        echo"11.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue7" name="tdTue7" align="center" <?php
                                if (in_array("12.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue7" id="tue7" value="<?php
                                    if (in_array("12.00", $tue)){
                                        echo"12.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue8" name="tdTue8" align="center" <?php
                                if (in_array("12.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue8" id="tue8" value="<?php
                                    if (in_array("12.30", $tue)){
                                        echo"12.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue9" name="tdTue9" align="center" <?php
                                if (in_array("1.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue9" id="tue9" value="<?php
                                    if (in_array("1.00", $tue)){
                                        echo"1.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue10" name="tdTue10" align="center" <?php
                                if (in_array("1.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue10" id="tue10" value="<?php
                                    if (in_array("1.30", $tue)){
                                        echo"1.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue11" name="tdTue11" align="center" <?php
                                if (in_array("2.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue11" id="tue11" value="<?php
                                    if (in_array("2.00", $tue)){
                                        echo"2.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue12" name="tdTue12" align="center" <?php
                                if (in_array("2.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue12" id="tue12" value="<?php
                                    if (in_array("2.30", $tue)){
                                        echo"2.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue13" name="tdTue13" align="center" <?php
                                if (in_array("3.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue13" id="tue13" value="<?php
                                    if (in_array("3.00", $tue)){
                                        echo"3.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue14" name="tdTue14" align="center" <?php
                                if (in_array("3.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue14" id="tue14" value="<?php
                                    if (in_array("3.30", $tue)){
                                        echo"3.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue15" name="tdTue15" align="center" <?php
                                if (in_array("4.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue15" id="tue15" value="<?php
                                    if (in_array("4.00", $tue)){
                                        echo"4.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdTue16" name="tdTue16" align="center" <?php
                                if (in_array("4.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="tue16" id="tue16" value="<?php
                                    if (in_array("4.30", $tue)){
                                        echo"4.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                        <table id="tblTimeSlotsWed" class="timeslots">
                            <tr>
                                <td id="tdWed1" name="tdWed1" align="center" <?php
                                if (in_array("9.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed1" id="wed1" value="<?php
                                    if (in_array("9.00", $wed)){
                                        echo"9.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed2" name="tdWed2" align="center" <?php
                                if (in_array("9.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed2" id="wed2" value="<?php
                                    if (in_array("9.30", $wed)){
                                        echo"9.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed3" name="tdWed3" align="center" <?php
                                if (in_array("10.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed3" id="wed3" value="<?php
                                    if (in_array("10.00", $wed)){
                                        echo"10.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed4" name="tdWed4" align="center" <?php
                                if (in_array("10.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed4" id="wed4" value="<?php
                                    if (in_array("10.30", $wed)){
                                        echo"10.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed5" name="tdWed5" align="center" <?php
                                if (in_array("11.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed5" id="wed5" value="<?php
                                    if (in_array("11.00", $wed)){
                                        echo"11.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed6" name="tdWed6" align="center" <?php
                                if (in_array("11.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed6" id="wed6" value="<?php
                                    if (in_array("11.30", $wed)){
                                        echo"11.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed7" name="tdWed7" align="center" <?php
                                if (in_array("12.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed7" id="wed7" value="<?php
                                    if (in_array("12.00", $wed)){
                                        echo"12.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed8" name="tdWed8" align="center" <?php
                                if (in_array("12.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed8" id="wed8" value="<?php
                                    if (in_array("12.30", $wed)){
                                        echo"12.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed9" name="tdWed9" align="center" <?php
                                if (in_array("1.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed9" id="wed9" value="<?php
                                    if (in_array("1.00", $wed)){
                                        echo"1.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed10" name="tdWed10" align="center" <?php
                                if (in_array("1.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed10" id="wed10" value="<?php
                                    if (in_array("1.30", $wed)){
                                        echo"1.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed11" name="tdWed11" align="center" <?php
                                if (in_array("2.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed11" id="wed11" value="<?php
                                    if (in_array("2.00", $wed)){
                                        echo"2.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed12" name="tdWed12" align="center" <?php
                                if (in_array("2.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed12" id="wed12" value="<?php
                                    if (in_array("2.30", $wed)){
                                        echo"2.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed13" name="tdWed13" align="center" <?php
                                if (in_array("3.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed13" id="wed13" value="<?php
                                    if (in_array("3.00", $wed)){
                                        echo"3.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed14" name="tdWed14" align="center" <?php
                                if (in_array("3.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed14" id="wed14" value="<?php
                                    if (in_array("3.30", $wed)){
                                        echo"3.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed15" name="tdWed15" align="center" <?php
                                if (in_array("4.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed15" id="wed15" value="<?php
                                    if (in_array("4.00", $wed)){
                                        echo"4.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdWed16" name="tdWed16" align="center" <?php
                                if (in_array("4.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="wed16" id="wed16" value="<?php
                                    if (in_array("4.30", $wed)){
                                        echo"4.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                        <table id="tblTimeSlotsThu" class="timeslots">
                            <tr>
                                <td id="tdThu1" name="tdThu1" align="center" <?php
                                if (in_array("9.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu1" id="thu1" value="<?php
                                    if (in_array("9.00", $thu)){
                                        echo"9.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu2" name="tdThu2" align="center" <?php
                                if (in_array("9.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu2" id="thu2" value="<?php
                                    if (in_array("9.30", $thu)){
                                        echo"9.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu3" name="tdThu3" align="center" <?php
                                if (in_array("10.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu3" id="thu3" value="<?php
                                    if (in_array("10.00", $thu)){
                                        echo"10.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu4" name="tdThu4" align="center" <?php
                                if (in_array("10.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu4" id="thu4" value="<?php
                                    if (in_array("10.30", $thu)){
                                        echo"10.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu5" name="tdThu5" align="center" <?php
                                if (in_array("11.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu5" id="thu5" value="<?php
                                    if (in_array("11.00", $thu)){
                                        echo"11.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu6" name="tdThu6" align="center" <?php
                                if (in_array("11.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu6" id="thu6" value="<?php
                                    if (in_array("11.30", $thu)){
                                        echo"11.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu7" name="tdThu7" align="center" <?php
                                if (in_array("12.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu7" id="thu7" value="<?php
                                    if (in_array("12.00", $thu)){
                                        echo"12.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu8" name="tdThu8" align="center" <?php
                                if (in_array("12.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu8" id="thu8" value="<?php
                                    if (in_array("12.30", $thu)){
                                        echo"12.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu9" name="tdThu9" align="center" <?php
                                if (in_array("1.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu9" id="thu9" value="<?php
                                    if (in_array("1.00", $thu)){
                                        echo"1.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu10" name="tdThu10" align="center" <?php
                                if (in_array("1.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu10" id="thu10" value="<?php
                                    if (in_array("1.30", $thu)){
                                        echo"1.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu11" name="tdThu11" align="center" <?php
                                if (in_array("2.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu11" id="thu11" value="<?php
                                    if (in_array("2.00", $thu)){
                                        echo"2.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu12" name="tdThu12" align="center" <?php
                                if (in_array("2.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu12" id="thu12" value="<?php
                                    if (in_array("2.30", $thu)){
                                        echo"2.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu13" name="tdThu13" align="center" <?php
                                if (in_array("3.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu13" id="thu13" value="<?php
                                    if (in_array("3.00", $thu)){
                                        echo"3.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu14" name="tdThu14" align="center" <?php
                                if (in_array("3.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu14" id="thu14" value="<?php
                                    if (in_array("3.30", $thu)){
                                        echo"3.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu15" name="tdThu15" align="center" <?php
                                if (in_array("4.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu15" id="thu15" value="<?php
                                    if (in_array("4.00", $thu)){
                                        echo"4.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdThu16" name="tdThu16" align="center" <?php
                                if (in_array("4.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="thu16" id="thu16" value="<?php
                                    if (in_array("4.30", $thu)){
                                        echo"4.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                        <table id="tblTimeSlotsFri" class="timeslots">
                            <tr>
                                <td id="tdFri1" name="tdFri1" align="center" <?php
                                if (in_array("9.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri1" id="fri1" value="<?php
                                    if (in_array("9.00", $fri)){
                                        echo"9.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri2" name="tdFri2" align="center" <?php
                                if (in_array("9.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri2" id="fri2" value="<?php
                                    if (in_array("9.30", $fri)){
                                        echo"9.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri3" name="tdFri3" align="center" <?php
                                if (in_array("10.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri3" id="fri3" value="<?php
                                    if (in_array("10.00", $fri)){
                                        echo"10.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri4" name="tdFri4" align="center" <?php
                                if (in_array("10.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri4" id="fri4" value="<?php
                                    if (in_array("10.30", $fri)){
                                        echo"10.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri5" name="tdFri5" align="center" <?php
                                if (in_array("11.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri5" id="fri5" value="<?php
                                    if (in_array("11.00", $fri)){
                                        echo"11.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri6" name="tdFri6" align="center" <?php
                                if (in_array("11.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri6" id="fri6" value="<?php
                                    if (in_array("11.30", $fri)){
                                        echo"11.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri7" name="tdFri7" align="center" <?php
                                if (in_array("12.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri7" id="fri7" value="<?php
                                    if (in_array("12.00", $fri)){
                                        echo"12.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri8" name="tdFri8" align="center" <?php
                                if (in_array("12.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri8" id="fri8" value="<?php
                                    if (in_array("12.30", $fri)){
                                        echo"12.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri9" name="tdFri9" align="center" <?php
                                if (in_array("1.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri9" id="fri9" value="<?php
                                    if (in_array("1.00", $fri)){
                                        echo"1.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri10" name="tdFri10" align="center" <?php
                                if (in_array("1.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri10" id="fri10" value="<?php
                                    if (in_array("1.30", $fri)){
                                        echo"1.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri11" name="tdFri11" align="center" <?php
                                if (in_array("2.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri11" id="fri11" value="<?php
                                    if (in_array("2.00", $fri)){
                                        echo"2.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri12" name="tdFri12" align="center" <?php
                                if (in_array("2.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri12" id="fri12" value="<?php
                                    if (in_array("2.30", $fri)){
                                        echo"2.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri13" name="tdFri13" align="center" <?php
                                if (in_array("3.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri13" id="fri13" value="<?php
                                    if (in_array("3.00", $fri)){
                                        echo"3.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri14" name="tdFri14" align="center" <?php
                                if (in_array("3.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri14" id="fri14" value="<?php
                                    if (in_array("3.30", $fri)){
                                        echo"3.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri15" name="tdFri15" align="center" <?php
                                if (in_array("4.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri15" id="fri15" value="<?php
                                    if (in_array("4.00", $fri)){
                                        echo"4.00";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                                <td id="tdFri16" name="tdFri16" align="center" <?php
                                if (in_array("4.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>
                                    <input type="hidden" name="fri16" id="fri16" value="<?php
                                    if (in_array("4.30", $fri)){
                                        echo"4.30";
                                    }else {
                                        echo "";
                                    }
                                    ?>" />
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>

        </div>

        <span style="font-size:14px;"><br/></span>
        <input type="submit" value=" Save Timeslots ">
    </form>
</div>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#tdMon1").click(function(){
            if ($('#mon1').val()=='9.00') {
                $(this).css('background-color','none');
                $('#mon1').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon1').val('9.00');
            }
        });
        $("#tdMon2").click(function(){
            if ($('#mon2').val()=='9.30') {
                $(this).css('background-color','none');
                $('#mon2').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon2').val('9.30');
            }
        });
        $("#tdMon3").click(function(){
            if ($('#mon3').val()=='10.00') {
                $(this).css('background-color','none');
                $('#mon3').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon3').val('10.00');
            }
        });
        $("#tdMon4").click(function(){
            if ($('#mon4').val()=='10.30') {
                $(this).css('background-color','none');
                $('#mon4').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon4').val('10.30');
            }
        });
        $("#tdMon5").click(function(){
            if ($('#mon5').val()=='11.00') {
                $(this).css('background-color','none');
                $('#mon5').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon5').val('11.00');
            }
        });
        $("#tdMon6").click(function(){
            if ($('#mon6').val()=='11.30') {
                $(this).css('background-color','none');
                $('#mon6').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon6').val('11.30');
            }
        });
        $("#tdMon7").click(function(){
            if ($('#mon7').val()=='12.00') {
                $(this).css('background-color','none');
                $('#mon7').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon7').val('12.00');
            }
        });
        $("#tdMon8").click(function(){
            if ($('#mon8').val()=='12.30') {
                $(this).css('background-color','none');
                $('#mon8').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon8').val('12.30');
            }
        });
        $("#tdMon9").click(function(){
            if ($('#mon9').val()=='1.00') {
                $(this).css('background-color','none');
                $('#mon9').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon9').val('1.00');
            }
        });
        $("#tdMon10").click(function(){
            if ($('#mon10').val()=='1.30') {
                $(this).css('background-color','none');
                $('#mon10').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon10').val('1.30');
            }
        });
        $("#tdMon11").click(function(){
            if ($('#mon11').val()=='2.00') {
                $(this).css('background-color','none');
                $('#mon11').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon11').val('2.00');
            }
        });
        $("#tdMon12").click(function(){
            if ($('#mon12').val()=='2.30') {
                $(this).css('background-color','none');
                $('#mon12').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon12').val('2.30');
            }
        });
        $("#tdMon13").click(function(){
            if ($('#mon13').val()=='3.00') {
                $(this).css('background-color','none');
                $('#mon13').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon13').val('3.00');
            }
        });
        $("#tdMon14").click(function(){
            if ($('#mon14').val()=='3.30') {
                $(this).css('background-color','none');
                $('#mon14').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon14').val('3.30');
            }
        });
        $("#tdMon15").click(function(){
            if ($('#mon15').val()=='4.00') {
                $(this).css('background-color','none');
                $('#mon15').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon15').val('4.00');
            }
        });
        $("#tdMon16").click(function(){
            if ($('#mon16').val()=='4.30') {
                $(this).css('background-color','none');
                $('#mon16').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#mon16').val('4.30');
            }
        });
        $("#tdTue1").click(function(){
            if ($('#tue1').val()=='9.00') {
                $(this).css('background-color','none');
                $('#tue1').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue1').val('9.00');
            }
        });
        $("#tdTue2").click(function(){
            if ($('#tue2').val()=='9.30') {
                $(this).css('background-color','none');
                $('#tue2').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue2').val('9.30');
            }
        });
        $("#tdTue3").click(function(){
            if ($('#tue3').val()=='10.00') {
                $(this).css('background-color','none');
                $('#tue3').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue3').val('10.00');
            }
        });
        $("#tdTue4").click(function(){
            if ($('#tue4').val()=='10.30') {
                $(this).css('background-color','none');
                $('#tue4').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue4').val('10.30');
            }
        });
        $("#tdTue5").click(function(){
            if ($('#tue5').val()=='11.00') {
                $(this).css('background-color','none');
                $('#tue5').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue5').val('11.00');
            }
        });
        $("#tdTue6").click(function(){
            if ($('#tue6').val()=='11.30') {
                $(this).css('background-color','none');
                $('#tue6').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue6').val('11.30');
            }
        });
        $("#tdTue7").click(function(){
            if ($('#tue7').val()=='12.00') {
                $(this).css('background-color','none');
                $('#tue7').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue7').val('12.00');
            }
        });
        $("#tdTue8").click(function(){
            if ($('#tue8').val()=='12.30') {
                $(this).css('background-color','none');
                $('#tue8').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue8').val('12.30');
            }
        });
        $("#tdTue9").click(function(){
            if ($('#tue9').val()=='1.00') {
                $(this).css('background-color','none');
                $('#tue9').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue9').val('1.00');
            }
        });
        $("#tdTue10").click(function(){
            if ($('#tue10').val()=='1.30') {
                $(this).css('background-color','none');
                $('#tue10').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue10').val('1.30');
            }
        });
        $("#tdTue11").click(function(){
            if ($('#tue11').val()=='2.00') {
                $(this).css('background-color','none');
                $('#tue11').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue11').val('2.00');
            }
        });
        $("#tdTue12").click(function(){
            if ($('#tue12').val()=='2.30') {
                $(this).css('background-color','none');
                $('#tue12').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue12').val('2.30');
            }
        });
        $("#tdTue13").click(function(){
            if ($('#tue13').val()=='3.00') {
                $(this).css('background-color','none');
                $('#tue13').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue13').val('3.00');
            }
        });
        $("#tdTue14").click(function(){
            if ($('#tue14').val()=='3.30') {
                $(this).css('background-color','none');
                $('#tue14').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue14').val('3.30');
            }
        });
        $("#tdTue15").click(function(){
            if ($('#tue15').val()=='4.00') {
                $(this).css('background-color','none');
                $('#tue15').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue15').val('4.00');
            }
        });
        $("#tdTue16").click(function(){
            if ($('#tue16').val()=='4.30') {
                $(this).css('background-color','none');
                $('#tue16').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#tue16').val('4.30');
            }
        });
        $("#tdWed1").click(function(){
            if ($('#wed1').val()=='9.00') {
                $(this).css('background-color','none');
                $('#wed1').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed1').val('9.00');
            }
        });
        $("#tdWed2").click(function(){
            if ($('#wed2').val()=='9.30') {
                $(this).css('background-color','none');
                $('#wed2').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed2').val('9.30');
            }
        });
        $("#tdWed3").click(function(){
            if ($('#wed3').val()=='10.00') {
                $(this).css('background-color','none');
                $('#wed3').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed3').val('10.00');
            }
        });
        $("#tdWed4").click(function(){
            if ($('#wed4').val()=='10.30') {
                $(this).css('background-color','none');
                $('#wed4').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed4').val('10.30');
            }
        });
        $("#tdWed5").click(function(){
            if ($('#wed5').val()=='11.00') {
                $(this).css('background-color','none');
                $('#wed5').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed5').val('11.00');
            }
        });
        $("#tdWed6").click(function(){
            if ($('#wed6').val()=='11.30') {
                $(this).css('background-color','none');
                $('#wed6').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed6').val('11.30');
            }
        });
        $("#tdWed7").click(function(){
            if ($('#wed7').val()=='12.00') {
                $(this).css('background-color','none');
                $('#wed7').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed7').val('12.00');
            }
        });
        $("#tdWed8").click(function(){
            if ($('#wed8').val()=='12.30') {
                $(this).css('background-color','none');
                $('#wed8').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed8').val('12.30');
            }
        });
        $("#tdWed9").click(function(){
            if ($('#wed9').val()=='1.00') {
                $(this).css('background-color','none');
                $('#wed9').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed9').val('1.00');
            }
        });
        $("#tdWed10").click(function(){
            if ($('#wed10').val()=='1.30') {
                $(this).css('background-color','none');
                $('#wed10').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed10').val('1.30');
            }
        });
        $("#tdWed11").click(function(){
            if ($('#wed11').val()=='2.00') {
                $(this).css('background-color','none');
                $('#wed11').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed11').val('2.00');
            }
        });
        $("#tdWed12").click(function(){
            if ($('#wed12').val()=='2.30') {
                $(this).css('background-color','none');
                $('#wed12').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed12').val('2.30');
            }
        });
        $("#tdWed13").click(function(){
            if ($('#wed13').val()=='3.00') {
                $(this).css('background-color','none');
                $('#wed13').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed13').val('3.00');
            }
        });
        $("#tdWed14").click(function(){
            if ($('#wed14').val()=='3.30') {
                $(this).css('background-color','none');
                $('#wed14').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed14').val('3.30');
            }
        });
        $("#tdWed15").click(function(){
            if ($('#wed15').val()=='4.00') {
                $(this).css('background-color','none');
                $('#wed15').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed15').val('4.00');
            }
        });
        $("#tdWed16").click(function(){
            if ($('#wed16').val()=='4.30') {
                $(this).css('background-color','none');
                $('#wed16').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#wed16').val('4.30');
            }
        });
        $("#tdThu1").click(function(){
            if ($('#thu1').val()=='9.00') {
                $(this).css('background-color','none');
                $('#thu1').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu1').val('9.00');
            }
        });
        $("#tdThu2").click(function(){
            if ($('#thu2').val()=='9.30') {
                $(this).css('background-color','none');
                $('#thu2').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu2').val('9.30');
            }
        });
        $("#tdThu3").click(function(){
            if ($('#thu3').val()=='10.00') {
                $(this).css('background-color','none');
                $('#thu3').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu3').val('10.00');
            }
        });
        $("#tdThu4").click(function(){
            if ($('#thu4').val()=='10.30') {
                $(this).css('background-color','none');
                $('#thu4').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu4').val('10.30');
            }
        });
        $("#tdThu5").click(function(){
            if ($('#thu5').val()=='11.00') {
                $(this).css('background-color','none');
                $('#thu5').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu5').val('11.00');
            }
        });
        $("#tdThu6").click(function(){
            if ($('#thu6').val()=='11.30') {
                $(this).css('background-color','none');
                $('#thu6').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu6').val('11.30');
            }
        });
        $("#tdThu7").click(function(){
            if ($('#thu7').val()=='12.00') {
                $(this).css('background-color','none');
                $('#thu7').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu7').val('12.00');
            }
        });
        $("#tdThu8").click(function(){
            if ($('#thu8').val()=='12.30') {
                $(this).css('background-color','none');
                $('#thu8').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu8').val('12.30');
            }
        });
        $("#tdThu9").click(function(){
            if ($('#thu9').val()=='1.00') {
                $(this).css('background-color','none');
                $('#thu9').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu9').val('1.00');
            }
        });
        $("#tdThu10").click(function(){
            if ($('#thu10').val()=='1.30') {
                $(this).css('background-color','none');
                $('#thu10').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu10').val('1.30');
            }
        });
        $("#tdThu11").click(function(){
            if ($('#thu11').val()=='2.00') {
                $(this).css('background-color','none');
                $('#thu11').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu11').val('2.00');
            }
        });
        $("#tdThu12").click(function(){
            if ($('#thu12').val()=='2.30') {
                $(this).css('background-color','none');
                $('#thu12').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu12').val('2.30');
            }
        });
        $("#tdThu13").click(function(){
            if ($('#thu13').val()=='3.00') {
                $(this).css('background-color','none');
                $('#thu13').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu13').val('3.00');
            }
        });
        $("#tdThu14").click(function(){
            if ($('#thu14').val()=='3.30') {
                $(this).css('background-color','none');
                $('#thu14').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu14').val('3.30');
            }
        });
        $("#tdThu15").click(function(){
            if ($('#thu15').val()=='4.00') {
                $(this).css('background-color','none');
                $('#thu15').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu15').val('4.00');
            }
        });
        $("#tdThu16").click(function(){
            if ($('#thu16').val()=='4.30') {
                $(this).css('background-color','none');
                $('#thu16').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#thu16').val('4.30');
            }
        });
        $("#tdFri1").click(function(){
            if ($('#fri1').val()=='9.00') {
                $(this).css('background-color','none');
                $('#fri1').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri1').val('9.00');
            }
        });
        $("#tdFri2").click(function(){
            if ($('#fri2').val()=='9.30') {
                $(this).css('background-color','none');
                $('#fri2').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri2').val('9.30');
            }
        });
        $("#tdFri3").click(function(){
            if ($('#fri3').val()=='10.00') {
                $(this).css('background-color','none');
                $('#fri3').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri3').val('10.00');
            }
        });
        $("#tdFri4").click(function(){
            if ($('#fri4').val()=='10.30') {
                $(this).css('background-color','none');
                $('#fri4').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri4').val('10.30');
            }
        });
        $("#tdFri5").click(function(){
            if ($('#fri5').val()=='11.00') {
                $(this).css('background-color','none');
                $('#fri5').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri5').val('11.00');
            }
        });
        $("#tdFri6").click(function(){
            if ($('#fri6').val()=='11.30') {
                $(this).css('background-color','none');
                $('#fri6').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri6').val('11.30');
            }
        });
        $("#tdFri7").click(function(){
            if ($('#fri7').val()=='12.00') {
                $(this).css('background-color','none');
                $('#fri7').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri7').val('12.00');
            }
        });
        $("#tdFri8").click(function(){
            if ($('#fri8').val()=='12.30') {
                $(this).css('background-color','none');
                $('#fri8').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri8').val('12.30');
            }
        });
        $("#tdFri9").click(function(){
            if ($('#fri9').val()=='1.00') {
                $(this).css('background-color','none');
                $('#fri9').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri9').val('1.00');
            }
        });
        $("#tdFri10").click(function(){
            if ($('#fri10').val()=='1.30') {
                $(this).css('background-color','none');
                $('#fri10').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri10').val('1.30');
            }
        });
        $("#tdFri11").click(function(){
            if ($('#fri11').val()=='2.00') {
                $(this).css('background-color','none');
                $('#fri11').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri11').val('2.00');
            }
        });
        $("#tdFri12").click(function(){
            if ($('#fri12').val()=='2.30') {
                $(this).css('background-color','none');
                $('#fri12').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri12').val('2.30');
            }
        });
        $("#tdFri13").click(function(){
            if ($('#fri13').val()=='3.00') {
                $(this).css('background-color','none');
                $('#fri13').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri13').val('3.00');
            }
        });
        $("#tdFri14").click(function(){
            if ($('#fri14').val()=='3.30') {
                $(this).css('background-color','none');
                $('#fri14').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri14').val('3.30');
            }
        });
        $("#tdFri15").click(function(){
            if ($('#fri15').val()=='4.00') {
                $(this).css('background-color','none');
                $('#fri15').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri15').val('4.00');
            }
        });
        $("#tdFri16").click(function(){
            if ($('#fri16').val()=='4.30') {
                $(this).css('background-color','none');
                $('#fri16').val('');
            } else {
                $(this).css('background-color','#c6e7de');
                $('#fri16').val('4.30');
            }
        });


    });
</script>


<div id="banner"></div>
</body>

</html>