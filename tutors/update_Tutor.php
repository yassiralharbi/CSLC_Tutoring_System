<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is the form to  update tutor information 
 */
session_start();
$username= $_SERVER["REMOTE_USER"];

include("../shared/db.php");
include("../tutors/userauthentication.php");

include("../header&footer/head.html");


$connect = connect();

?>
<?php
if(isset($_GET['error'])&&$_GET['error']!="")
    echo'<div id="error">'.$_GET['error'].'</div>';
?>

<?php
$connect = connect();

$sql = "SELECT * FROM tutors WHERE tutor_Id LIKE '$username'";

$query = mysql_query($sql);

if(mysql_num_rows($query)==0)
{
    header("Refresh: 1; URL=TutorProfile.php");
    echo "<h1>No records found</h1>";
}
else
{
    $row = mysql_fetch_assoc($query);
    mysql_close($connect);
    ?>
    <html>
    <head>
        <title>Update Tutor</title>
    </head>
    <body>
    <h1>Update Tutor <?php echo $row['FirstName'];?> </h1>
    <form action = "update_Tutor_Do.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Tutor ID:</td>
                <td><?php echo $row['tutor_Id']; ?></td>

            </tr>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="FirstName" value = "<?php echo $row['FirstName']; ?>"  ></td>

            </tr>

            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="LastName" value = "<?php echo $row['LastName']; ?>" > </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" value="<?php echo $row['email']; ?>" ></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="text" name="phone" value="<?php echo $row['phone']; ?>" ></td>
            </tr>
            </tr>
            <td>languages:</td>
            <td><select multiple name="languages[]" size=13 style='height: 100%;'>
                    <?php
                    $con=connect();
                    $result = mysql_query("SELECT * FROM Languages ");


                    while($row = mysql_fetch_array($result))
                    {
                        echo "<option value=$row[language]> $row[language] </option>";
                    }

                    ?>
                </select>
            </td>


            <tr>
                <td>Other Languages:</td>
                <td><input type="text" name="other" ></td>
            </tr>




            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Update">
                </td>
            </tr>
        </table>
    </form>
    </html>
<?php
}

?>

