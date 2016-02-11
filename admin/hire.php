<?php

/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to hire a tutor 
 */
session_start();
include("../shared/db.php");

include("../admin/adminauthentication.php");


$connect = connect();

$value = $_GET['value'];
$value = hash_finder_do($value);
$id=$value;
$id = sanitize($id);

$sql = "UPDATE tutors SET hired=(SELECT CASE status WHEN 'Yes' THEN 'No' ELSE 'Yes' END) WHERE tutor_Id='" . $value . "'";
$query = mysql_query($sql);

$sqlHours = "INSERT INTO hours (total_H,h_Left,h_Used,h_claimed, h_unclaimed,tutor_Id)VALUES('0','0','0','0','0','$value');";
mysql_query($sqlHours) or die(mysql_error());

$sql = "SELECT language FROM Applicant_language WHERE tutor_Id='" . $value . "'";
$query = mysql_query($sql);

$languages = array();
while($res = mysql_fetch_object($query))
{
    $languages[] = $res->language;

}
$connect = connect();

$sql = "DELETE  FROM Applicant_language WHERE tutor_Id='" . $id . "'";
mysql_query( $sql );
$connect = connect();

foreach( $languages as $key=>$value )
{
     $value = sanitize($value);
    $get_hash=crypt(uniqid(crypt(uniqid($value))));

    $sql = "INSERT INTO Languages (language,get_hash) VALUES ( '$value','$get_hash');";
    mysql_query( $sql, $connect );
}
$connect = connect();

foreach( $languages as $key=>$value ){
    $value = sanitize($value);

    $sql = "INSERT INTO teaching (tutor_Id, language) VALUES ('$id', '$value');";
    mysql_query( $sql, $connect );
}

$sql = "INSERT INTO logins (ID, type) VALUES ('$id', 'tutor');";
mysql_query( $sql, $connect );



header("Refresh: 0; URL=tutor_control.php");

if(mysql_affected_rows($connect) == 1)
{
    include("hireEmail.php");
    echo "";
}
else
{
    echo "<h1>Error: Applicant not hired</h1>";
}
mysql_close($connect);
?>