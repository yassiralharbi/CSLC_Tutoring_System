<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is used to authinicate tutors
 */
session_start();
$username= $_SESSION['user'];

$connect = connect();

$sql = "select * from logins WHERE ID = '$username'";
$query = mysql_query($sql);
$row= mysql_fetch_object($query);
$type = $row->type;
if (!$username || !isset($type))
{
    header ("Refresh:2; URL = ../index.php");
    echo "<h1>Invalid User, redirecting to Home Page</h1>";
    exit;
}
//$defense=$_SESSION['type'];
if($type!="tutor")
{
    header ("Refresh:2; URL = ../index.php");
    echo "<h1>Invalid User, redirecting to Home Page</h1>";
    exit;

}