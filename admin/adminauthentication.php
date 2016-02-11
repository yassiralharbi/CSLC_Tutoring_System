<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to check the user credential by chicking on the usertype in the table logins
 */
session_start();
$username= $_SERVER["REMOTE_USER"];
$connect = connect();

$sql = "select * from logins WHERE ID = '$username'";
$query = mysql_query($sql);
$row= mysql_fetch_object($query);

$type = $row->type;

if (!isset($_SERVER["REMOTE_USER"]) || !isset($type))

{echo $_SERVER["REMOTE_USER"].$type;
    header ("Refresh:2; URL = index.php");
    echo "<h1>Invalid User, redirecting to Home Page</h1>";
    exit;
}
//$defense=$_SESSION['type'];
//echo $defense;
if($type!="admin")
{
    header ("Refresh:2; URL = index.php");
    echo "<h1>Invalid User,redirecting to Home Page</h1>";
    exit;

}