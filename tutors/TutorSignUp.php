<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is the sign up form for the tutors
 */
    session_start();
    include("../shared/db.php");
    include "../header&footer/header.html";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.validate.js"></script>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register New Tutors</title>

<?php
if(isset($_GET['postback'])&&$_GET['postback']!="")
{
    $postback = explode("%2C",$_GET['postback']);
    $postback = implode(",",$postback);
    $postback = explode(",",$postback);
}
?>

<form action="TutorSignUp_do.php" method="POST" enctype="multipart/form-data">
<table>
<tr>
    <td>First Name<font color="red">*</font></td>
    <td><input type="text" name="FirstName"value="<?php echo $postback[0];?>"required>
</tr>

<tr>
    <td>Last Name<font color="red">*</font></td>
    <td><input type="text" name="LastName" value="<?php echo $postback[1];?>"required>
</tr>


<tr>
  <td>Email<font color="red">*</font></td>
  <td><input type="email" name="email" value="<?php echo $postback[2];?>"required>
</tr>
<tr>
    <td>What Language(s) Can You Teach?<font color="red">*</font></td>
    <td><select multiple name="languages[]" size=13 style='height: 100%;' required>
            <?php
            $con=connect();
            $result = mysql_query("SELECT * FROM Languages ");

            while($row = mysql_fetch_array($result))
            {
                echo "<option value=$row[language]> $row[language] </option>";
            }

            ?>
        </select>
        <script type='text/javascript'>//<![CDATA[
            window.onload=function(){
                window.onmousedown = function (e) {
                    var el = e.target;
                    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
                        e.preventDefault();

                        // toggle selection
                        if (el.hasAttribute('selected')) el.removeAttribute('selected');
                        else el.setAttribute('selected', '');

                        // hack to correct buggy behavior
                        var select = el.parentNode.cloneNode(true);
                        el.parentNode.parentNode.replaceChild(select, el.parentNode);
                    }
                }
            }//]]>

        </script>

    </td>



    <tr>
        <td>Other (please specify)</td>
        <td><input type="text" name="other" ></td>
    </tr>
<tr>
<td>Phone Number<font color="red">*</font></td>
    <td><input type="number" name="phone" value="<?php echo $postback[3];?>"required>
</tr>

    <tr>
        <td>Upload Resume (PDF Format Only)<font color="red">*</font></td>
        <td><input type="file" name="resume" required> <?php echo $postback[4];?></td>

    </tr>



<tr>
<td></td>
<td>
<input type="submit" value="Submit">
<input type="reset" value="Clear">
</td>
</tr>
</table>
</form>
<!-- end #mainContent --></div>
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
<!-- end #container --></div>
</body>

</html>


<?php
include "../header&footer/footer.html";
?>