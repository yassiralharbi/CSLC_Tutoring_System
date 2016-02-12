<?php

/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to check if a student is either an admin or a tutor
 */
session_start();
include("db.php");
$connect = connect();

$username = $_POST['user'];
$username = sanitize($username);

$sql = "SELECT * FROM logins WHERE id = '$username' ";
$query = mysql_query($sql);

$num_rows = mysql_num_rows($query);

if($num_rows == 0 || $num_rows > 1)
{
    header ("Refresh:2; URL = ../index.php");
    echo "Authorization Required";
    exit;
}
else
{
    $_SESSION['user'] = $username;
    $row = mysql_fetch_object($query);
    $_SERVER["REMOTE_USER"] = $row->ID;
    $type=$row->type;


    if ($type=='tutor')
    {
        header ("Refresh:0; URL =../tutors/TutorProfile.php");
    }
    else
    {
        if ($type=='admin')
        {
            header ("Refresh:0; URL =../admin/admin_home.php");
        }
    }
}

?>