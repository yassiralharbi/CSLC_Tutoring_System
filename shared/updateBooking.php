<!--
*Author: Jiefu Yang
*Time: May 2015
*
* Security Check(sanitize): Kevin
*This page is used to update the job-booked table and the booking-history table
*
-->

<?php

date_default_timezone_set('Australia/Adelaide');
$localeTime = date('Y-m-d H:i:s',time());

$sql = "SELECT * FROM `job-Booked` WHERE `tutor_Id` =  '" . $tutorId . "'";
$query = mysql_query($sql);

while($row = mysql_fetch_object($query))
{
    $time = $row->Time;
    $time = sanitize($time);
    if(strtotime($time)<=strtotime($localeTime))
    {
        $bookId = $row->book_Id;
        $bookId = sanitize($bookId);

        $eventId = $row->event_Id;
        $eventId = sanitize($eventId);

        $firstName = $row->stud_f_name;
        $firstName = sanitize($firstName);

        $lastName = $row->stud_L_name;
        $lastName = sanitize($lastName);

        $email = $row->Studemail;
        $email = sanitize($email);

        $mobile = $row->Studmobile;
        $mobile = sanitize($mobile);

        $time = $row->Time;
        $time = sanitize($time);

        $otherClass = $row->other_class;
        $otherClass = sanitize($otherClass);

        $topic = $row->topic;
        $topic = sanitize($topic);

        $place = $row->place;
        $place = sanitize($place);

        $class = $row->class;
        $class = sanitize($class);

        $language = $row->language;
        $language = sanitize($language);

        $tutorId = $row->tutorId;
        $tutorId = sanitize($tutorId);

        $comment = $row->comments;
        $comment = sanitize($comment);

        $sql = "INSERT INTO `booking-history` (stud_f_name, stud_L_name,Studemail,Studmobile,language,Time,other_class,topic,place,class,comments,tutor_Id) VALUES ('$firstName','$lastName','$email','$mobile','$language','$time','$otherClass','$topic','$place','$class','$comment','$tutorId')";
        $query = mysql_query($sql);

        $sql = "DELETE FROM `job-Booked` WHERE `book_Id`  = '" .$bookId . "' and `tutor_Id` = '" .$tutorId. "'";
        $query = mysql_query($sql);
    }
}

?>

