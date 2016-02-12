<?php
/**
 *
 * Author: Claire Liu
 * Date: 12/05/15
 *
 * Security Check: Yassir Alharbi
 * Usability Check: Claire Liu
 * Reference: http://www.w3schools.com/php/func_mail_mail.asp
 *
 *
 * This page sends the user-typed email to selected recipients
 *
 */
session_start();
$adminID = $_SESSION['user'];

include("../shared/db.php");
include("../admin/adminauthentication.php");
include("../header&footer/admin_head.html");

$connect = connect();

$sql = "SELECT * FROM Admins WHERE admin_id = '$adminID'";
$query = mysql_query($sql);
$row = mysql_fetch_assoc($query);

if (mysql_num_rows($query) == 0)
{
    echo "Admin does not exist!";
}
else
{
    $senderName = $row['FirstName'] . " " . $row['LastName'];
}

/* debugging flag */
$pageDebugging = FALSE;


/* pass all input */
$subject = $_POST['subject'];
$message = $_POST['message'];
$recipients = $_POST['selectedTutors'];



$sentTo = implode(",", $recipients);    /* pass one or multiple recipient address(es) to the send to parameter; separate by comma*/
if ($pageDebugging) {
    echo "You have selected the following recipients: " . $sentTo;  //check recipients
}



/* check if admin has entered both subject line and message field */
if ($subject == '' || $message == '' ){
    echo 'Please fill in all fields';
}
else {
    if ($sentTo == '') {
        echo 'Please select recipients!';
    }
    else {
        /* compose email */

        $subjectLine = 'Notification from CS Learning Centre: ' . $subject;

        /* Admin(sender) address :standard format */
        $sentFrom = $adminID . "@adelaide.edu.au";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: ".$senderName." <". $sentFrom.">" . "\r\n";

        /* formatting user-typed message body */
        $messageBody = '<html><body>';
        $messageBody .= wordwrap($message, 100);     //each line of message contains 100 characters only
        $messageBody .= '</body></html>';
        $messageBody = nl2br($messageBody);         //preserve user-entered line breaks and other formats in the message body


        /* send the message */
        if (mail($sentTo, $subjectLine, $messageBody, $headers)) {
            echo 'Your message has been sent';
        }
        else
        {
            if ($pageDebugging) {
                echo 'Error: your message was not sent: ' . print_r(error_get_last());
            }

        }
        /* redirect to tutor contact page */
        header("Refresh: 1; URL=tutorContact.php");
        exit();
    }

}

/* function: errorMsg() */
function errorMsg($msg)
{

}
?>