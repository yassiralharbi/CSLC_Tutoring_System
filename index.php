<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is home page for the system 
 */
    include("header&footer/header.html");
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSLC Tutoring System LogIn</title>
<style type="text/css">

<body

{  
  font: 100% Verdana, Arial, Helvetica, sans-serif;
  background: #666666;
    margin: 100px 100px 100px 100px; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
  padding: 0;
  text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
  color: #000000;
}

#banner{width:auto;margin:auto;border-bottom:10px solid #336699;clear:both}



.oneColElsCtrHdr #header h1 {
  margin: 100px 100px 100px 100px; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
  padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.oneColElsCtrHdr #mainContent {
  padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
  background: #FFFFFF;
    margin: 100px 100px 100px 100px;
}
.oneColElsCtrHdr #footer { 
  padding: 0 10px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
  background:#DDDDDD;
    margin: 100px 100px 100px 100px;
}
.oneColElsCtrHdr #footer p {
    margin: 100px 100px 100px 100px; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
  padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
</style>
</head>

<body class="oneColElsCtrHdr">

<div id="container">

  <div id="mainContent">
      <div id="banner">

      </div>
  


      <form action='shared/Login.php' method='post'>
          <table>
              <tr><td><input type="text" name="user"/></td></tr>
              <tr><td><input type='submit' value='Log In'> <td>( Staff only)</td> </tr></td>
          </table>
      </form>

      <br><br></br></br>
      <p1><strong>Need Help from a CS Tutor?</strong></p1>
      <button onclick="window.location.href='student/InsertEvent.php'">Book A Tutor!</button>
      <br></br>
      <p1>Want to Become a CS Tutor?</p1>
      <button onclick="window.location.href='tutors/TutorSignUp.php'">Sign Up!</button>
      <br></br>

      <div id="banner">

      </div>
  </div>

 <!--end #container --></div>
</body>

</html>
<?php
include "header&footer/footer.html";
?>