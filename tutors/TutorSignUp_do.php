<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is to collect the data from tutor sign up form sanitize it then insert it in the database
 */
session_start();
include("../shared/db.php");
include "../header&footer/header.html";

$connect = connect();

$error = array();
$postback= array();

$FirstName = isset($_POST['FirstName']) ? trim($_POST['FirstName']) : '';
if($FirstName == "") $error[]=urlencode("Please enter a First Name.");
$FirstName=sanitize($FirstName);
$postback[]=urlencode($FirstName);

$LastName = isset($_POST['LastName']) ? trim($_POST['LastName']) : '';
if($LastName == "") $error[]=urlencode("Please enter a Last Name.");
$LastName=sanitize($LastName);
$postback[]=urlencode($LastName);



$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if($email == "") $error[]=urlencode("Please enter an Email Address.");
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
    $error[]=urlencode ("You must enter a valid email address.");
$email=sanitize($email);
$postback[]=urlencode($email);



$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
if($phone == "") $error[]=urlencode("Please enter a Phone Number.");
$phone=sanitize($phone);
$postback[]=urlencode($phone);


$myfile_uploadname = 'resume';
if(isset($_FILES[$myfile_uploadname])){
$acceptable = array(
    'pdf'
);}
$size =$_FILES[$myfile_uploadname]['size'];
if ($size>=1048576){
    $error[] = urlencode("File too large. File must be less than 2 megabytes.");
}

$filename=$_FILES["$myfile_uploadname"]["type"];
$extension=end(explode(".", $filename));
$extension=end(explode("/", $filename));



if(!in_array($extension, $acceptable)){

    $error[] = urlencode("Please use PDF only");}
$postback[]="Please use pdf and less than 2 MG";


if(!empty($error)){
    header('Location:TutorSignUp.php?postback='.Join($postback,
            urlencode(',') ));


    exit;
}
$get_hash=crypt(uniqid(crypt(uniqid("asdffdsassddffdd"))));
$tutor_Id= $_SERVER["REMOTE_USER"];
$connect = connect();


$sql = " insert into tutors (tutor_Id,FirstName,LastName,email,phone,get_hash)
	VALUES('$tutor_Id','$FirstName','$LastName','$email','$phone','$get_hash');";

mysql_query($sql);

 mysql_affected_rows($connect) ;

header("Refresh: 2; URL=index.php");
if(mysql_affected_rows($connect) == 1)
{ $id = mysql_insert_id($connect);



    $other = isset($_POST['other']) ? trim($_POST['other']) : '';


    if ($other!= ""){
        $other = explode(",",$_POST['other']);
    foreach( $other as $key=>$value )
    {       $value = sanitize($value);
        $sql = "INSERT INTO Applicant_language (tutor_Id, language) VALUES ('$tutor_Id', '$value');";
        mysql_query( $sql, $connect );
    }}

    foreach( $_POST['languages'] as $key=>$value )
    {
       $value = sanitize($value);
        $sql = "INSERT INTO Applicant_language (tutor_Id, language) VALUES ('$tutor_Id', '$value');";

        mysql_query( $sql, $connect );
    }

    $filename = $tutor_Id ;



   // isset($_POST['resume']);
    $myfile_uploadname = 'resume';

    $directory = 'resumes';




    if (isset($_FILES[$myfile_uploadname])) {



        $name = uniqid();
        $size =$_FILES[$myfile_uploadname]['size'];

        $type = $_FILES[$myfile_uploadname]['type'];


        $filename=$_FILES["$myfile_uploadname"]["type"];
        $extension=end(explode(".", $filename));
        $extension=end(explode("/", $filename));
        $newfilename=$name.".".$extension;
       $link = $directory."/".$newfilename;
       $file_Id=rand();



        if (move_uploaded_file($_FILES[$myfile_uploadname]['tmp_name'], "$directory/$newfilename")) {


               // echo '<p><span style="color:#36624C;">File name '.$name.' was successfully uploaded!</span></p>';
             $sql = "INSERT INTO files ( file_Id,tutor_Id, link, catagory, type) VALUES ( '$file_Id','$tutor_Id', '$link','$myfile_uploadname','$extension');";
             echo$sql;

            mysql_query( $sql, $connect );

            } else {

               // echo '<p><font color="red">File could not be moved.</font></p>';

            }


    }	else {
        echo '<p><span style="color:#36624C;">We only accept the following documents:<br/>Word, PDF, txt, jpeg, gif, png, html, javascript and css that are less than 1 mb!</span></p>';
        echo '<p><span style="color:#36624C;"><a href="'.$_SERVER[PHP_SELF].'">Try again</a></span></p>';

    }



    echo "<p1>Thank you for your application, $FirstName.<br/>
        The administrator will be in contact with you shortly.</p1>";
    header("Refresh: 3; URL=index.php");


}
        else
            echo
"<p1>Sorry $FirstName, your application could not be processed. Please contact the administrator to report an issue.</p1>";
header("Refresh: 3; URL=index.php");


mysql_close($connect);   ?>



<?php
include "../header&footer/footer.html";
?>