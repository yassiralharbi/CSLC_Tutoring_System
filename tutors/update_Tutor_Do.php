<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to update tutors information and languages 
 */
session_start();
include("../shared/db.php");

include("../tutors/userauthentication.php");


$username = $_SERVER["REMOTE_USER"];

$connect = connect();

$error = array();
$FirstName = isset($_POST['FirstName']) ? trim($_POST['FirstName']) : '';
if ($FirstName == "") $error[] = urlencode("Please enter a First Name.");
$FirstName=sanitize($FirstName);

$LastName = isset($_POST['LastName']) ? trim($_POST['LastName']) : '';
if ($LastName == "") $error[] = urlencode("Please enter a Last Name.");
$LastName=sanitize($LastName);




if (empty($_POST["languages"])) {$error[] = urlencode("Please enter a language.");}

$other = explode(",", $_POST['other']);
str_replace(" ", "", trim($other));




$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if ($email == "") $error[] = urlencode("Please enter an Email Address.");
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
    $error[] = urlencode("You must enter a valid email address.");
$email=sanitize($email);

$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
if ($phone == "") $error[] = urlencode("Please enter a Phone Number.");
$phone=sanitize($phone);


if (!empty($error)) {
    header('Location:update_Tutor.php?error=' . Join($error,
            urlencode('<br/>')));
    exit;
}
$connect = connect();

$id = $username;
$id=sanitize($id);

$sql = "DELETE from teaching where tutor_Id = '$username'";
mysql_query($sql, $connect);


if (!empty($_POST['other']))
{


    foreach ($other as $key => $value) {
        $value=sanitize($value);
        $get_hash=crypt(uniqid(crypt(uniqid("$value"))));


        $sql = "INSERT INTO Languages (language,get_hash) VALUES ( '$value','$get_hash')";
        mysql_query($sql, $connect);
    }


    foreach ($other as $key => $value) {
        $value=sanitize($value);

        $sql = "INSERT INTO teaching (tutor_Id, language) VALUES ('$id', '$value')";

        mysql_query($sql, $connect);
    }


}

foreach ($_POST['languages'] as $key => $value) {
    $value=sanitize($value);

    $sql = "INSERT INTO teaching (tutor_Id, language) VALUES ('$id', '$value')";

    mysql_query($sql, $connect);
}

$get_hash=crypt(uniqid(crypt(uniqid("$value"))));


$sql2  = "UPDATE tutors SET phone= ' $phone ' ,get_hash='$get_hash' , FirstName= ' $FirstName ' , email=' $email ', LastName=' $LastName ' where tutor_Id=' $username '";


mysql_query($sql2, $connect);


header("Refresh: 1; URL=TutorProfile.php");
if (mysql_affected_rows($connect) == 1) {


    echo "";
}
    else         echo
"";
mysql_close($connect);
