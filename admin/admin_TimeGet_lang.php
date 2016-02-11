<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: April 2015-->
<!--*-->
<!--*This page is for admin get time by language-->
<!--*-->
<!--*/-->
<?php
session_start();

include("../shared/db.php");

// Fill up array with names

$con=connect();


//get the q parameter from URL
$q=$_GET["q"];

$result = mysql_query("SELECT * FROM teaching WHERE language = '".$q."'");
while($row = mysql_fetch_array($result))
{
    $lang[]=$row['language'];
    $tutor[]=$row['tutor_Id'];
}
//lookup all hints from array if length of q>0

//output the response
//echo $response;
if (strlen($q) > 0)
{
    $hint="";
    for($i=0; $i<count($lang); $i++)
    {
        if ($q==$lang[$i])
            //if (fnmatch($q, $lang[$i]))
        {
            if ($hint=="")
            {
                $hint=$tutor[$i];
            }
            else
            {
                $hint=$hint." , ".$tutor[$i];
            }
        }
    }
}

?>
<link href="../css/bootstrap-theme.css" rel="stylesheet" type="text/css" media="all">
<script src="../js/bootstrap.js" type="text/javascript"></script>
<style type="text/css">
    table.timelabels  {border-collapse:collapse; border:hidden 1px #ffffff; margin-left:57px;}
    table.timeslots   {border-collapse:collapse; border:solid 1px #006363;}
    table.daysofweek  {border-collapse:collapse; border:hidden 0px #ffffff;}
    .timelabels td    {border-style:hidden; border-width:1px; width:35px; font-size:11px;}
    .timeslots td     {border:solid 1px #006363; width:34px; font-size:12px; background-color:#ffffff;}
    .daysofweek td    {border-style:hidden; border-width:1px; font-size:12px; height:19px;}
    #banner{width:auto;margin:auto;border-bottom:3px solid #000000;clear:both}
</style>

<body>
<div id="banner"></div>

<?php


$username= $hint;
//print_r($hint);
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

                        $mon = array();
                        $tue = array();
                        $wed = array();
                        $thu = array();
                        $fri = array();
                        $result = array();

                        $Time = explode(',',$username);

                        for($i=0;$i<count($Time);$i++){
                            $sql[$i] = "select * from available_time where tutor_Id ='$Time[$i]'";


                            $result[$i]=mysql_query($sql[$i]);



                            if(mysql_num_rows($result[$i])<1)
                            {
                                $Mon = array();
                                $Tue = array();
                                $Wed = array();
                                $Thu = array();
                                $Fri = array();
                            } else {
                                while ($row = mysql_fetch_array($result[$i])) {
                                    $Mon = explode(',',$row['mon']);
                                    $Tue = explode(',',$row['tue']);
                                    $Wed = explode(',',$row['wed']);
                                    $Thu = explode(',',$row['thu']);
                                    $Fri = explode(',',$row['fri']);

                                }
                            }
                            $mon=array_merge($Mon,$mon);
                            $tue=array_merge($Tue,$tue);
                            $wed=array_merge($Wed,$wed);
                            $thu=array_merge($Thu,$thu);
                            $fri=array_merge($Fri,$fri);

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

                                    &nbsp;
                                </td>
                                <td id="tdMon2" name="tdMon2" align="center" <?php
                                if (in_array("9.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon3" name="tdMon3" align="center" <?php
                                if (in_array("10.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon4" name="tdMon4" align="center" <?php
                                if (in_array("10.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon5" name="tdMon5" align="center" <?php
                                if (in_array("11.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon6" name="tdMon6" align="center" <?php
                                if (in_array("11.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon7" name="tdMon7" align="center" <?php
                                if (in_array("12.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon8" name="tdMon8" align="center" <?php
                                if (in_array("12.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon9" name="tdMon9" align="center" <?php
                                if (in_array("1.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon10" name="tdMon10" align="center" <?php
                                if (in_array("1.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon11" name="tdMon11" align="center" <?php
                                if (in_array("2.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon12" name="tdMon12" align="center" <?php
                                if (in_array("2.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon13" name="tdMon13" align="center" <?php
                                if (in_array("3.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon14" name="tdMon14" align="center" <?php
                                if (in_array("3.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon15" name="tdMon15" align="center" <?php
                                if (in_array("4.00", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdMon16" name="tdMon16" align="center" <?php
                                if (in_array("4.30", $mon)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

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

                                    &nbsp;
                                </td>
                                <td id="tdTue2" name="tdTue2" align="center" <?php
                                if (in_array("9.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue3" name="tdTue3" align="center" <?php
                                if (in_array("10.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue4" name="tdTue4" align="center" <?php
                                if (in_array("10.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue5" name="tdTue5" align="center" <?php
                                if (in_array("11.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue6" name="tdTue6" align="center" <?php
                                if (in_array("11.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue7" name="tdTue7" align="center" <?php
                                if (in_array("12.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue8" name="tdTue8" align="center" <?php
                                if (in_array("12.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue9" name="tdTue9" align="center" <?php
                                if (in_array("1.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue10" name="tdTue10" align="center" <?php
                                if (in_array("1.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue11" name="tdTue11" align="center" <?php
                                if (in_array("2.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue12" name="tdTue12" align="center" <?php
                                if (in_array("2.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue13" name="tdTue13" align="center" <?php
                                if (in_array("3.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue14" name="tdTue14" align="center" <?php
                                if (in_array("3.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue15" name="tdTue15" align="center" <?php
                                if (in_array("4.00", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdTue16" name="tdTue16" align="center" <?php
                                if (in_array("4.30", $tue)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

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

                                    &nbsp;
                                </td>
                                <td id="tdWed2" name="tdWed2" align="center" <?php
                                if (in_array("9.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed3" name="tdWed3" align="center" <?php
                                if (in_array("10.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed4" name="tdWed4" align="center" <?php
                                if (in_array("10.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed5" name="tdWed5" align="center" <?php
                                if (in_array("11.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed6" name="tdWed6" align="center" <?php
                                if (in_array("11.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed7" name="tdWed7" align="center" <?php
                                if (in_array("12.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed8" name="tdWed8" align="center" <?php
                                if (in_array("12.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed9" name="tdWed9" align="center" <?php
                                if (in_array("1.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed10" name="tdWed10" align="center" <?php
                                if (in_array("1.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed11" name="tdWed11" align="center" <?php
                                if (in_array("2.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed12" name="tdWed12" align="center" <?php
                                if (in_array("2.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed13" name="tdWed13" align="center" <?php
                                if (in_array("3.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed14" name="tdWed14" align="center" <?php
                                if (in_array("3.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed15" name="tdWed15" align="center" <?php
                                if (in_array("4.00", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdWed16" name="tdWed16" align="center" <?php
                                if (in_array("4.30", $wed)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

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

                                    &nbsp;
                                </td>
                                <td id="tdThu2" name="tdThu2" align="center" <?php
                                if (in_array("9.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu3" name="tdThu3" align="center" <?php
                                if (in_array("10.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu4" name="tdThu4" align="center" <?php
                                if (in_array("10.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu5" name="tdThu5" align="center" <?php
                                if (in_array("11.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu6" name="tdThu6" align="center" <?php
                                if (in_array("11.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu7" name="tdThu7" align="center" <?php
                                if (in_array("12.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu8" name="tdThu8" align="center" <?php
                                if (in_array("12.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu9" name="tdThu9" align="center" <?php
                                if (in_array("1.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu10" name="tdThu10" align="center" <?php
                                if (in_array("1.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu11" name="tdThu11" align="center" <?php
                                if (in_array("2.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu12" name="tdThu12" align="center" <?php
                                if (in_array("2.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu13" name="tdThu13" align="center" <?php
                                if (in_array("3.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu14" name="tdThu14" align="center" <?php
                                if (in_array("3.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu15" name="tdThu15" align="center" <?php
                                if (in_array("4.00", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdThu16" name="tdThu16" align="center" <?php
                                if (in_array("4.30", $thu)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

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

                                    &nbsp;
                                </td>
                                <td id="tdFri2" name="tdFri2" align="center" <?php
                                if (in_array("9.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri3" name="tdFri3" align="center" <?php
                                if (in_array("10.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri4" name="tdFri4" align="center" <?php
                                if (in_array("10.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri5" name="tdFri5" align="center" <?php
                                if (in_array("11.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri6" name="tdFri6" align="center" <?php
                                if (in_array("11.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri7" name="tdFri7" align="center" <?php
                                if (in_array("12.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri8" name="tdFri8" align="center" <?php
                                if (in_array("12.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri9" name="tdFri9" align="center" <?php
                                if (in_array("1.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri10" name="tdFri10" align="center" <?php
                                if (in_array("1.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri11" name="tdFri11" align="center" <?php
                                if (in_array("2.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri12" name="tdFri12" align="center" <?php
                                if (in_array("2.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri13" name="tdFri13" align="center" <?php
                                if (in_array("3.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri14" name="tdFri14" align="center" <?php
                                if (in_array("3.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri15" name="tdFri15" align="center" <?php
                                if (in_array("4.00", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                                <td id="tdFri16" name="tdFri16" align="center" <?php
                                if (in_array("4.30", $fri)){
                                    echo"style='background-color: #c6e7de'";
                                }else {
                                    echo "";
                                }
                                ?>>

                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>


        </div>

        <span style="font-size:14px;"><br/></span>

    </form>
</div>



<div id="banner"></div>

<?php $_SERVER["temp"]='0'; ?>
</body>