
<script type='text/javascript'>
    self.close();
</script>
<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to dismiss a job from the admin homepage (old jobs)
 */
session_start();
include("../shared/db.php");

include("../admin/adminauthentication.php");


$connect = connect();

$value = $_GET['value'];
$value = sanitize($value);


$sql = "UPDATE events SET dismiss= 'Yes' WHERE event_Id='" . $value . "'";


$query = mysql_query($sql);

header("Refresh: 0; URL=admin_home.php");
if(mysql_affected_rows($connect) == 1)
{
    echo "";
}
else
    echo "<h1>Error: Job not updated</h1>";

mysql_close($connect);

