<?php
/**
 * Created by PhpStorm.
 * User: yassir
 * Date: 5/06/15
 * Time: 2:42 AM
 * this page take the admin get_hash find the admin id then delete the admin
 */

session_start();
include("../shared/db.php");
include("../admin/adminauthentication.php");

$connect = connect();

$value = $_GET['value'];
$value = admin_hash_finder_do($value);
$id = $value;
$id = sanitize($id);

$error = array();

$sql = "SELECT * from Admins";
$query = mysql_query($sql);

$num_rows =  mysql_num_rows($query);

if($num_rows < 2)
{
    $error[]=urlencode("there must be at least 1 admin.");
}
if(!empty($error))
{
    header('Location:admin_control.php?error='.Join($error, urlencode('<br/>')));
    exit;
}

$sql = "DELETE FROM `Admins` WHERE admin_id  = '" . $value . "'";
$query = mysql_query($sql);
$sql = "DELETE FROM `logins` WHERE ID  = '" . $value . "'";
$query = mysql_query($sql);

header("Refresh: 1; URL=admin_control.php");
if(mysql_affected_rows($connect) == 1)
{
    echo"<h1>Admin deleted successfully</h1>";
}
else
{
    echo "<h1>Error: Admin not Deleted</h1>";
}
mysql_close($connect);
?>