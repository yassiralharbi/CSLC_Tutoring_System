<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to add or remove admins
 */

session_start();
include("../shared/db.php");
include("../admin/adminauthentication.php");


$connect = connect();

$error = array();
$FirstName = isset($_POST['FirstName']) ? trim($_POST['FirstName']) : '';
if($FirstName == "") $error[]=urlencode("Please enter a First Name.");
$FirstName=sanitize($FirstName);

$LastName = isset($_POST['LastName']) ? trim($_POST['LastName']) : '';
if($LastName == "") $error[]=urlencode("Please enter a Last Name.");
$LastName=sanitize($LastName);





$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if($email == "") $error[]=urlencode("Please enter an Email Address.");
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
    $error[]=urlencode ("You must enter a valid email address.");
$email=sanitize($email);


$id = isset($_POST['id']) ? trim($_POST['id']) : '';
if($id == "") $error[]=urlencode("Please enter school ID .");
$id=sanitize($id);

if(!empty($error)){
    header('Location:admin_control.php?error='.Join($error,
            urlencode('<br/>')));
    exit;
}
$get_hash=crypt(uniqid(crypt(uniqid("asdffdsassddffdd"))));

$connect = connect();


$sql = " insert into Admins (admin_id,FirstName,LastName,email,get_hash)
	VALUES('$id','$FirstName','$LastName','$email','$get_hash');";
mysql_query($sql);


$sql = " insert into logins (ID,type) VALUES('$id','admin');";
mysql_query($sql);



header("Refresh: 0; URL=admin_control.php");
if(mysql_affected_rows($connect) == 1)
{
    echo "";
}
else
    echo "<h1>Error: Admin not Added</h1>";

mysql_close($connect);
?>



