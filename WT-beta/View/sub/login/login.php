<?php
include "../../Control/sub/logincheck.php";
$username = "";
?>

<html>

<head>
  <h3>Subscriber Log-In</h3>
  <hr><br>
  <link rel="stylesheet" type="text/css" href="../../css/substyle.css">
</head>

<body>
  <div id="box">
    <form action="" method="post" enctype="multipart/form-data">

      <table>
        <tr>
          <td>Username:
          </td>
          <td><input type="text" placeholder="Enter Username" name="username" required value=<?= $username ?>></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" placeholder="Enter Password" name="password" required></td>
        </tr>
      </table>

      <button type="submit" class="btnsubmit" name="btnlogin">Log In</button>
      <br><br>
      <a href="forgotpass.php"> Forgot Password?</a><br>
      <a href="reg.php"> Don't have an account? Create one</a>
    </form>
  </div>
</body>

</html>