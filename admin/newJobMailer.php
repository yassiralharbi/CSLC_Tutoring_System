<?php
/**
 * Created by PhpStorm.
 * User: myMac
 * Date: 12/05/15
 * Time: 16:26
 * Author: Jiefu Yang
 */
$username= $_SERVER["REMOTE_USER"];

//$username=sanitize($username);
$connect = connect();
$subject = "New Tutoring Request";
$message = "<html>
            <head>
            <title>New Request</title>
            </head>
            <body>
            <?php

            <p> There is a new tutoring session request of $language: </p>

            <p> Student Name:$FirstName $LastName<br/>
                Language: $language<br/>
                Meeting location: $location<br/>
                Time: $time1<br/>
                Mobile Number: $phone<br/>
                Email: $email</p>
            <p> Cheers<br/>
                CS Learning Centre</p>
            </body>
            </html>";

/* validate all input: no need to sanitise email address as this is only reading from db where data has already been sanitised */

if ($sentTo == '')
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


    /* send the message */
    if (mail($sentTo, $subjectLine, $messageBody, $headers))
    {
        echo 'An email has been sent to the tutors.';
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