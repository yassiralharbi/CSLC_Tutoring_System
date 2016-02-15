<?php
session_start();
$username = $_SESSION['user'];
include("../shared/db.php");
include("../tutors/userauthentication.php");

include("../header&footer/header.html");
include("../header&footer/head.html");


$connect = connect();
?>

    <!DOCTYPE html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="blended_layout.css">
        <title>Page Title</title>
        <meta name="description" content="Write some words to describe your html page">
        <style>

            * {
                padding: 0;
                margin: 0;
                border: 0;
            }

            body {
                background-color: rgba(0, 0, 0, 0);
                background-image: url(' bi-background-frame.png ');
                background-attachment: fixed;
                background-size: 100% auto;
            }

            .blended_grid {

                display: block;
                width: 1000px;
                overflow: auto;
                margin: 30px auto 0 auto;
            }

            .pageHeader {
                float: right;
                clear: none;
                height: 50px;
                width: 1000px;
            }

            .pageLeftMenu {
                float: left;
                clear: none;
                height: 100px;
                width: 150px;
            }

            .pageContent {
                float: right;
                clear: none;
                height: 400px;
                width: 800px;
            }

            .pageFooter {
                float: right;
                clear: none;
                height: 50px;
                width: 1000px;
            }

        </style>
        <link rel="stylesheet" type="text/css" href="../css/table.css" media="screen"/>
    </head>

    <body>
    <?php
    if (isset($_GET['error']) && $_GET['error'] != "")
        echo '<div id="error">' . $_GET['error'] . '</div>';
    ?>

    <div class="blended_grid">
        <div class="pageLeftMenu">
            <?php
            $image = "image";
            $sql = "SELECT DISTINCT link FROM files WHERE tutor_Id = '$username' AND catagory = '$image'";
            $query = mysql_query($sql, $connect);


            if (mysql_num_rows($query) == 0) {
                echo "Please upload a photo";
            }

            if (mysql_num_rows($query) != 0) {
                while ($row = mysql_fetch_object($query)) {
                    $link = $row->link;

                    echo "<img src='$link' height =\"100\" width=\"100\"  >";
                }
            } ?>

            <br></br>
            <form action="newimage.php" method="post" enctype="multipart/form-data">
                <input type="file" name="image" id="image">
                <input type="submit" value="Upload New Picture" name="submit">
            </form>
            <br></br>
            <form action="update_Tutor.php" method="post" enctype="multipart/form-data">
                <input type="submit" value="Update Profile" name="submit">
            </form>
        </div>

        <div class="pageContent">
            <?php

            $connect = connect();

            $sql = "SELECT\n"
                . "tutors.tutor_Id,\n"
                . "tutors.FirstName,\n"
                . "tutors.LastName,\n"
                . "tutors.email,\n"
                . "tutors.phone,\n"
                . "GROUP_CONCAT(teaching.language),\n"
                . "hours.h_Used\n"
                . "FROM\n"
                . "tutors,\n"
                . "teaching,\n"
                . "hours\n"
                . "WHERE\n"
                . "tutors.tutor_Id = '$username' and teaching.tutor_Id = '$username' and hours.tutor_Id= '$username'\n";


            $query = mysql_query($sql);
            $sql2 = "SELECT language from applicant_language where tutor_Id = '$username'";
            $query2 = mysql_query($sql2);
            $lan = '';

            while ($row = mysql_fetch_object($query2)) {
                $lan .= $row->language . ',';
            }
            $lan = substr($lan, 0, -1);

            if (mysql_num_rows($query) == 0) {
                echo "No records found";
            } else {
                while ($row = mysql_fetch_object($query)) {

                    $first = $row->FirstName;
                    $last = $row->LastName;
                    $email = $row->email;
                    $phone = $row->phone;
                    $lan[0];
                    $sql3 = "SELECT h_Used from hours where tutor_Id = '$username'";
                    $query3 = mysql_query($sql3);
                    $row = mysql_fetch_object($query3);
                    $hours = $row->h_Used/2;
                    /* show default Hours Done as 0 if the tutor has not been allocated work hours or has not done any */
                    if (is_null($hours)) {
                        $hours = "0";
                    }
                }
            }
            mysql_close($connect);

            echo "<html>
        <table class='CSSTableGenerator'>

        <tr>
            <th><h5>Name</h5></th>
            <td>$first $last</td>
        </tr>
        <tr>
            <th><h5>Email</h5></th>

            <td>$email</td>
        </tr><tr>
            <th><h5>Phone</h5></th>
            <td>$phone</td>
        </tr><tr>
            <th><h5>Languages</h5></th>
            <td>$lan</td>
        </tr><tr>
            <th><h5>Hours Done</h5></th>
            <td>$hours</td>
        </tr>
        </table>

        ";
            ?>
            <iframe src="time_selector.php" width="800" frameborder=3 height="300" align="left"></iframe>
        </div>
    </div>

        <div class="pageFooter">
            <br>
            <span style="font-size:20px ; "><br/> <a href="../shared/Logoff.php">SignOut Here</a></span>
        </div>
    </div>
    </body>
    <div id='banner'></div>
    </html>

<?php
include "../header&footer/footer.html";
?>