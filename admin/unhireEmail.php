<?php
/**
 * Created by PhpStorm.
 * User: myMac
 * Date: 12/05/15
 * Time: 16:26
 * Author: Jiefu Yang
 * Security Check(authentication): Yassir
 */
session_start();

include("../admin/adminauthentication.php");
$connect = connect();
$sql = "SELECT * FROM `tutors` WHERE `tutor_Id` = '" . $id. "'";

$query = mysql_query($sql);
$row = mysql_fetch_object($query);
$tutorMail = $row->email;
$name = $row->FirstName;

$subject = "Notification from CS Learning Centre";
$message = "<html>
            <head>
            <title>You have been dismissed by the CS learning centre</title>
            </head>
            <body>
            <?php
            <p> Hi $name</p><br/>
            <p> We are sorry that your Computer Science tutor application has not been successful.<br/>
                Please try again next semester! </p><br/>

            <p> Kind Regards,</p>
            <p> CS Learning Centre</p>
            </body>
            </html>";

/* validate all input: no need to sanitise email address as this is only reading from db where data has already been sanitised */

if ($tutorMail == '')
{
    echo 'Please select recipients!';
}
else
{
    $subjectLine = $subject;

    /* Admin(sender) address :standard format */
    $sentFrom = $_SERVER["REMOTE_USER"]."@adelaide.edu.au";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: Cheryl Pope <cslc.cslearningcentre@gmail.com>" . "\r\n";

    /* message lines should not exceed 70 characters (PHP rule) */
    $messageBody = wordwrap($message, 70);


    /* send the message */
    if (mail($tutorMail, $subjectLine, $messageBody, $headers))
    {
         echo 'An email has been sent to the tutor.';
    }
    else
    {
         echo 'Error: your message was not sent: ' . print_r(error_get_last());
    }
}

/* function: errorMsg() */
function errorMsg($msg)
{
    ?>
    <html>
    <body>

    <p>Your message was not sent!</p>
    </br>
    <p>Error: </p>
    <strong><?php echo $msg; ?></strong>
    </body>
    </html>
    <?php
    exit();
}
?>