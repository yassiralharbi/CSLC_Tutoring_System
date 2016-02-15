<!--/*-->
<!--*Author: Zhongjie Kang-->
<!--*Time: April 2015-->
<!--*-->
<!--*This page is php action for event-->
<!--*Security assisted by Yassir-->
<!--*/-->

<?php
session_start();     
include("../shared/db.php");
include "../header&footer/header.html";
$username = $_SESSION['user'];
$connect = connect();

$error = array();

$FirstName = isset($_POST['StudFname']) ? trim($_POST['StudFname']) : '';
if($FirstName == "") $error[]=urlencode("Please enter a First Name.");
$FirstName = sanitize($FirstName);
	
$LastName = isset($_POST['StudLname']) ? trim($_POST['StudLname']) : '';
if($LastName == "") $error[]=urlencode("Please enter a Last Name.");
$LastName = sanitize($LastName);


$email = isset($_POST['Studemail']) ? trim($_POST['Studemail']) : '';
if($email == "") $error[]=urlencode("Please enter an Email Address.");
$email = cleanInput($email);

$phone = isset($_POST['Studmobile']) ? trim($_POST['Studmobile']) : '';
if($phone == "") $error[]=urlencode("Please enter a Phone Number.");
$phone = cleanInput($phone);

$language = implode(",",$_POST['languages']);
$language = sanitize($language);

$time1 = isset($_POST['times']) ? trim($_POST['times']) : '';

$topic = isset($_POST['topic']) ? trim($_POST['topic']) : '';
$topic = cleanInput($topic);

$class = implode(",",$_POST['class']);

$other = isset($_POST['other_class']) ? trim($_POST['other_class']) : '';
$other = cleanInput($other);
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$location = cleanInput($location);

$tutor_Id = implode(",",$_POST['tutor_Id']);
$tutor_Id = sanitize($tutor_Id);

$con = connect();

    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";

if(is_string($tutor_Id))
{

    $get_hash=crypt(uniqid(crypt(uniqid("asdffdsassddffdd"))));

    $sql = "INSERT INTO events (StudFname,StudLname,Studemail,Studmobile, other_class,topic,class,language,tutor_Id,location,date_time1,get_hash)
            VALUES('$FirstName','$LastName','$email','$phone','$other','$topic','$class','$language','$tutor_Id','$location','$time1','$get_hash')";

    $query = mysql_query($sql);

    $sql = "SELECT * FROM `tutors` WHERE `tutor_Id` = $tutor_Id";

    $query = mysql_query($sql);
    $row = mysql_fetch_object($query);
    $tutorMail = $row->email;
    include("../admin/newSpecJobMailer.php");
}
else{
    $sql = "INSERT INTO events (StudFname,StudLname,Studemail,Studmobile, other_class,topic,class,language,location,date_time1)
            VALUES('$FirstName','$LastName','$email','$phone','$other','$topic','$class','$language','$location','$time1')";

    $query = mysql_query($sql);

    $query = mysql_query("SELECT * FROM `teaching` WHERE  `language` =  '" .$language. "'");
    $count = 0;
    $tutorEmails = array();
    while($row = mysql_fetch_object($query))
    {
        $ID = $row->tutor_Id;
        $QUERY = mysql_query("SELECT * FROM `tutors` WHERE  `tutor_Id` =  '" .$ID. "'");
        $ROW = mysql_fetch_object($QUERY);
        $tutorEmails[$count] = $ROW->email;
        $count++;
    }
    $sentTo = implode(",", $tutorEmails);
    include("../admin/newJobMailer.php");
}

header("Refresh: 3; URL=index.php");

$id = mysql_insert_id($con);
echo "<br/>";

echo "<p1>Thank you for your booking. A CS tutor will be in contact with you shortly.</p1>";

mysql_close($con);

include "../header&footer/footer.html";
