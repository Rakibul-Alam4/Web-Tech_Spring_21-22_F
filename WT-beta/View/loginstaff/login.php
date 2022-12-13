<?php
include "../../Control/staff/logincheck.php";
?>

<html>

<body>
  <h2>Staff Log-In </h2>
  <hr> <br>
  <form action="" method="post" enctype="multipart/form-data">

    <table>
      <tr>
        <td>Username:
        </td>
        <td><input type="text" name="username"></td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input type="password" name="password"></td>
      </tr>
    </table>

    <input type="submit" name="submit">
    <br><br> <a href="forgotpass.php"> Forgot Password?</a>
    <br> <a href="reg.php"> Don't have an account? Create one</a>
  </form>

</body>

</html>