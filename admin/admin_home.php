<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: April 2015-->
<!--*-->
<!--*Admin site homepage-->
<!--*Assist:Yassir-->
<!--*/-->

<?php
session_start();
include("../shared/db.php");

include "../admin/adminauthentication.php";
include "../header&footer/header.html";

include "../header&footer/admin_head.html";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>CSLC Tutoring System</title>
    <link href="../css/css.css" rel="stylesheet" type="text/css" media="all" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen" />

</head>


<body >
<div class="container">

    <div class="row">
        <div class="col-sm-4">

            <?php

            $connect = connect();
            $admin_id=$_SERVER["REMOTE_USER"];
            date_default_timezone_set('Australia/Adelaide');
            $sql = "SELECT * FROM `Admins` WHERE `admin_id` = '$admin_id'";
            $query = mysql_query($sql);
            $iipp=$_SERVER["REMOTE_ADDR"];

            $row = mysql_fetch_object($query);

            echo "<table style=width:30% >";
            echo "<tr>";
            echo "<td><h5><b>Name</b></td></h5>";
            echo "<td><h5>" . $row->FirstName;
            echo " " . $row->LastName."</h5></td>";
            echo "</tr>";
            echo "<td><h5><b>Email</b></td></h5>";
            echo "<td><h5>" . $row->email."</h5></td>";
            echo "</tr>" ;
            echo "</tr>";
            echo "<td><h5><b>Current IP</b></td></h5>";
            echo "<td><h5> $iipp</h5></td>";
            echo "</tr>" ;
            echo "</tr>";
            echo "<td><h5><b>Login Time</b></td></h5>";

            echo "<td><h5>".date('d-m-Y H:i:s',time())."</h5></td>";
            echo "</tr>" ;
            echo "</table>";

            echo " <html><div><iframe src='lang_notefication.php' width='400' frameborder=0 height='100%'align='left'></iframe>
</div></html>";

           // $sql = "SELECT * FROM `events`WHERE Dismiss = 'No'";
           // $query = mysql_query($sql);


            //if (mysql_num_rows($query) == 0)
           // {
           //     echo "No records found";
           // }

          //  else
           // {
                //while($row = mysql_fetch_object($query))
                //{
                    //echo "<tr>";
                   // echo "<td><h5>" . $row->StudFname . " " . $row->StudLname . "</h5></td>";
                   // echo "<td><h5>" . $row->date_time1 . " </h5></td>";

                   // echo "<td>";
                   // echo "<a href='adminHomeJobDetail.php?jobId=" . $row->event_Id . "'><h5>view</h5></a>";
                   // echo "</td>";
                    //echo "</tr>";
               // }
           // }



            ?>
        </div>
        <div class="col-sm-4">
            <?php
            $con=connect();
            $result = mysql_query("SELECT * FROM events");
            while($row = mysql_fetch_array($result)){
                $nums[]=$row['class'];
                $len[]=$row['event_Id'];
            }
            $counter=array('0','0','0','0','0','0','0','0');
            for($i=0;$i<count($len);$i++){
                if($nums[$i]==' Algorithm Design and Data Structure')
                    $counter[0]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]=='Foundations of Computer Science')
                    $counter[1]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]=='Introduction to Programming')
                    $counter[2]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]=='Object Oriented Programming')
                    $counter[3]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]=='Scientific Computing')
                    $counter[4]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]=='Introduction to Programming for Engineers')
                    $counter[5]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]=='Web and Database Computing')
                    $counter[6]++;
            }
            for($i=0;$i<count($len);$i++){
                if($nums[$i]!='Object Oriented Programming'&&$nums[$i]!='Scientific Computing'&&$nums[$i]!='Introduction to Programming for Engineers'&&$nums[$i]!='Web and Database Computing'&&$nums[$i]!='Algorithm and Data Structure Design'&&$nums[$i]!='Foundations of Computer Science')
                    $counter[7]++;
            }




            ?>
            <br></br>
                <meta charset='UTF-8'>
                <title>ichartjs designer</title>
                <script src='../js/ichart.latest.min.js'></script>
                <script type='text/javascript'>
                    var a=<?=$counter[0]?>;
                    var b=<?=$counter[1]?>;
                    var c=<?=$counter[2]?>;
                    var d=<?=$counter[3]?>;
                    var e=<?=$counter[4]?>;
                    var f=<?=$counter[5]?>;
                    var g=<?=$counter[6]?>;
                    var h=<?=$counter[7]?>;
                    //document.write(a);
                    $(function(){
                        var chart = iChart.create({
                            render:"ichart-render",
                            width:500,
                            height:400,
                            background_color:"#f2f3f5",
                            gradient:false,
                            color_factor:0.2,
                            border:{
                                color:"#404c5d",
                                width:1
                            },
                            align:"center",
                            offsetx:0,
                            offsety:-20,
                            sub_option:{
                                border:{
                                    color:"#fefefe",
                                    width:1
                                },
                                label:{
                                    fontweight:600,
                                    fontsize:20,
                                    color:"#3b1a1a",
                                    sign:"square",
                                    sign_size:12,
                                    border:{
                                        color:"#BCBCBC",
                                        width:1
                                    },
                                    background_color:"#fefefe"
                                }
                            },
                            shadow:true,
                            shadow_color:"#fafafa",
                            shadow_blur:10,
                            showpercent:false,
                            column_width:"70%",
                            bar_height:"70%",
                            radius:"90%",
                            title:{
                                text:"Booking information by courses",
                                color:"#331e1e",
                                fontsize:14,
                                font:"Verdana",
                                textAlign:"left",
                                height:30,
                                offsetx:36,
                                offsety:0
                            },
                            subtitle:{
                                text:"",
                                color:"#8d9db5",
                                fontsize:24,
                                textAlign:"left",
                                height:50,
                                offsetx:36,
                                offsety:6
                            },

                            coordinate:{
                                width:"92%",
                                height:"80%",
                                background_color:"rgba(246,246,246,0.05)",
                                axis:{
                                    color:"#bfbfc3",
                                    width:["","",6,""]
                                },
                                grid_color:"#c0c0c0",
                                label:{
                                    fontweight:500,
                                    color:"#331e1e",
                                    fontsize:0
                                }
                            },
                            label:{
                                fontweight:300,
                                color:"#331e1e",
                                fontsize:10
                            },

                            type:"column2d",
                            data:[
                                {
                                    name:"ADSA",
                                    value:a,
                                    color:"rgba(131,166,213,0.90)"
                                },{
                                    name:"FCS",
                                    value:b,
                                    color:"rgba(243,125,178,0.90)"
                                },{
                                    name:"IP",
                                    value:c,
                                    color:"rgba(237,236,133,0.90)"
                                },{
                                    name:"OOP",
                                    value:d,
                                    color:"rgba(143,198,64,0.90)"
                                },{
                                    name:"SC",
                                    value:e,
                                    color:"rgba(100,139,191,0.90)"
                                },{
                                    name:"IPE",
                                    value:f,
                                    color:"rgba(100,139,69,0.90)"
                                },{
                                    name:"WADC",
                                    value:g,
                                    color:"rgba(100,139,191,0.90)"
                                },{
                                    name:"Other",
                                    value:h,
                                    color:"rgba(100,139,91,0.90)"
                                }
                            ]
                        });
                        chart.draw();

                    });
                </script>


            <td><div id='ichart-render'></div></td>




        </div>

    </div>
</div>



</div>
<div id='bar'></div>
<span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>

</body>
</html>
<?php
include "../header&footer/footer.html";
?>