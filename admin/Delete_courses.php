<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to delete a course from the system
 */
session_start();
include("../shared/db.php");

include("../admin/adminauthentication.php");


$connect = connect();

$value = $_GET['value'];
$value = courses_hash_finder_do($value);
$id=$value;
$id = sanitize($id);


$sql = "DELETE FROM courses  WHERE corse_Id  = '" . $id . "'";
$query = mysql_query($sql);



header("Refresh: 0; URL=language_courses.php");
if(mysql_affected_rows($connect) == 1)
{
    echo "
";

}
else
    echo "<h1>Error: Course not Deleted</h1>";

mysql_close($connect);
?>