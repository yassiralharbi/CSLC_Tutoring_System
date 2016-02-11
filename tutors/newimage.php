<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to aupload image of tutors
 */
session_start();
include("../shared/db.php");

include("../tutors/userauthentication.php");

$username= $_SERVER["REMOTE_USER"];


$connect = connect();

?>

<?php

$filename = $username ;
$filename=sanitize($filename);


$myfile_uploadname = 'image';
$directory = 'tutors_images';



if (isset($_FILES[$myfile_uploadname])) {



    $acceptable = array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png',
        'image/JPEG',
        'image/JPG',
        'image/GIF',
        'image/PNG'
    );
    $size =$_FILES[$myfile_uploadname]['size'];
    if ($size>=524288){
        $error[] = urlencode("Picture is  too large. File must be less than 500 Kilos.");
    }

    if(!empty($error)){
        header('Location:TutorProfile.php?error='.Join($error,
                urlencode('<br/>')));
        exit;
    }


    $name = $username;

    $size =$_FILES[$myfile_uploadname]['size'];
    $type = $_FILES[$myfile_uploadname]['type'];

    $filename=$_FILES["$myfile_uploadname"]["type"];
    $extension=end(explode(".", $filename));
    $extension=end(explode("/", $filename));
    $newfilename=$name.".".$extension;
    $link = $directory."/".$newfilename;



    if (move_uploaded_file($_FILES[$myfile_uploadname]['tmp_name'], "$directory/$newfilename")) {
        $sql = "DELETE FROM files WHERE tutor_Id= $name  AND catagory ='image'";

        mysql_query( $sql, $connect );

        $sql = "INSERT INTO files ( tutor_Id, link, catagory, type) VALUES ( '$name', '$link','$myfile_uploadname','$extension')";
        mysql_query( $sql, $connect );

    } else {

        echo '<p><font color="red">image could not be changed.</font></p>';

    }

}
header("Refresh: 0; URL=TutorProfile.php");


mysql_close($connect);
?>