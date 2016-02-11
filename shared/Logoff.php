<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to log of the system
 */
session_start();
session_destroy();
header ("Refresh:2; URL = index.php");
echo "<h1>Logoff completed, redirecting to Home Page</h1>";
exit;

?>
