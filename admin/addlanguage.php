<?php


/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to add a language to the system
 */
session_start();

include("../shared/db.php");

include("../admin/adminauthentication.php");

$error = array();

$lang=getCheck($_POST['lang']);
$lang=trim($lang);
if ($lang == '') $error[] = urlencode("Please enter a language.");

$lang = explode(",",$lang);
str_replace(" ", "", trim($lang));
if (!empty($error)) {
    header('Location:../admin/language_courses.php?error=' . Join($error,
            urlencode('<br/>')));
    exit;
}

foreach( $lang as $key=>$value )
{
    $value = sanitize($value);
    $get_hash=crypt(uniqid(crypt(uniqid("$value"))));


    $sql = "INSERT INTO Languages (language,get_hash) VALUES ('$value','$get_hash');";
   $query= mysql_query( $sql, $connect );


}
header("Refresh: 0; URL=../admin/language_courses.php");
if(mysql_affected_rows($connect) == 1)
{
echo" ";
}
else
    echo "<h1>Error: language not added</h1>";

mysql_close($connect);
?>