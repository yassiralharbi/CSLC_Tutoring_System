<?php
/**
 * Created by PhpStorm.
 * User: myMac
 * Date: 12/05/15
 * Time: 16:26
 * Author: Jiefu Yang
 * Security Check(authentication): Yassir
 */
/*session_start();

$connect = connect();*/
include("../tutors/userauthentication.php");
$subject = "Request Canceled";

$message = "<html>
            <head>
            <title>Request Cancelled</title>
            </head>
            <body>
            <?php
            <p> Hi $firstName<br/>
                Your tutoring session request is cancelled</p><br/>

            <p> Language: $language<br/>
                Meeting location: $place<br/>
                Time: $time</p>

            <p> CS Learning Centre</p>
            </body>
            </html>";

/* validate all input: no need to sanitise email address as this is only reading from db where data has already been sanitised */
if ($email == '')
{
    echo 'Please select recipients!';
}
else
{
    $subjectLine = 'Notification from CS Learning Centre: ' . $subject;

    /* Admin(sender) address :standard format */
    $sentFrom = "cslc.cslearningcentre@gmail.com";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: Cheryl Pope <cslc.cslearningcentre@gmail.com>" . "\r\n";

    /* message lines should not exceed 70 characters (PHP rule) */
    $messageBody = wordwrap($message, 70);

    //mail($email, $subjectLine, $messageBody, $headers);
    /* send the message */
    if (mail($email, $subjectLine, $messageBody, $headers))
    {
        echo 'Your message has been sent';
    }
    else
    {
        echo 'Error: your message was not sent: ' . print_r(error_get_last());
    }
}

/* function: errorMsg() */
/*function errorMsg($msg)
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
}*/
?>