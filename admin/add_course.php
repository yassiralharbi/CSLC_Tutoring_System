<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to add a course to the system 
 */
session_start();
include("../shared/db.php");

include("../admin/adminauthentication.php");




$error = array();

$connect = connect();
$course=getCheck($_POST['course']);
$course=trim($course);
if ($course == ""|| strlen($course)<2) $error[] = urlencode("Please enter a course.");
$course = explode(",",$course);
str_replace(" ", "", trim($course));
if (!empty($error)) {
    header('Location:language_courses.php?error=' . Join($error,
            urlencode('<br/>')));
    exit;
}
$connect = connect();

foreach( $course as $key=>$value )
{         $value = sanitize($value);
    $get_hash=crypt(uniqid(crypt(uniqid("$value"))));

    $sql = "INSERT INTO courses (corse_Id,get_hash) VALUES ('$value','$get_hash');";

    $query= mysql_query( $sql, $connect );


}
header("Refresh: 0; URL=language_courses.php");
if(mysql_affected_rows($connect) == 1)
{
    echo" ";
}
else
    echo "<h1>Error: course not added</h1>";

mysql_close($connect);
?>