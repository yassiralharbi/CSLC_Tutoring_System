
<?php
/**
 *
 * Author: Claire Liu
 * Date: 21/05/15
 *
 * Security Check: Yassir Alharbi
 * Usability Check: Claire Liu
 * Reference: http://www.w3schools.com/php/func_mail_mail.asp
 *
 *
 * This page allows the user (admin) to type a message and select from a list of recipients
 *
 */
    session_start();
    include("../header&footer/header.html");
    include("../header&footer/admin_head.html");
    include("../shared/db.php");
    $username= $_SERVER["REMOTE_USER"];
    $connect = connect();

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- TemplateBeginEditable name="doctitle" -->
    <title>Contact Your Tutors</title>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.validate.js"></script>

<body class="twoColFixLtHdr">

<div id="container">
    <div id="mainContent">
        <h1>Tutor Contact</h1>
        <style type="text/css">
            #error{
                background-color:#FAF8CC;
                color:#FF0000;
                text-align:center;
                margin:10px;
                padding:10px;
            }
        </style>
</head>

<body class="oneColElsCtrHdr">

<p1>Please enter message here</p1>
<body>

<form id="form1" name="form1" method="post" action="tutorMailer.php">
    <table width="455" border="0" cellspacing="0" cellpadding="0">

        <tr>
            <td height="45" align="left"><label for="subject">Subject</label></td>
            <td><input name="subject" id="subject" type="text" size="30" required></td>
        </tr>
            <td>Message</td>
        <tr>
            <td height="41" align="left"><label for="message"></label></td>
            <td><textarea name="message" cols="70" rows="30" id="message" required></textarea></td>
        </tr>

        <tr>
            <td height="41" align="left"><label for="sendTo"></label></td>
            <td>
                <fieldset>
                    <legend><b>Please select from the following tutors</b></legend>
                     <?php
                         $con=connect();
                         $result = mysql_query("SELECT * FROM tutors WHERE hired  = 'YES'");
                         //$result = sanitize($result);
                     //echo '<button type="button" id="checkAll" class="check-all">Select All</button>';

                     echo '<input type="checkbox" id="selecctAll"/> Selecct/Unselect All<br />';
                     while ($row = mysql_fetch_array($result)) {
                             /* display a tutor's name in checkbox format */
                             $tutorName = $row['FirstName'].' '.$row['LastName'];

                             echo '<input type="checkbox" class="checkboxGroup" name="selectedTutors[]" value="'.$row['email'].'">'.$tutorName.'<br />';
                         }
                    /* Display checkbox list */
                     echo implode("\n",$checkboxes);
                     ?>


                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#selecctAll').click(function(event) {  //on click
                                if(this.checked) {
                                    $('.checkboxGroup').each(function() {
                                        this.checked = true;  //loop through checkbox group and select all
                                    });
                                }else{
                                    $('.checkboxGroup').each(function() {
                                        this.checked = false; //loop through checkbox group and unselect all
                                    });
                                }
                            });

                        });

                    </script>
                </fieldset>
            </td>
        </tr>

        <tr>
            <td height="38">&nbsp;</td>
            <td>
                <label><input name="Submit" type="submit"  id="Submit" value="Submit" required></label>

            </td>
        </tr>

    </table>

</form>
</body>
<span style="font-size:20px ; " ><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>
<div id='bar'></div>
</html>
<?php
include "../header&footer/footer.html";
?>


