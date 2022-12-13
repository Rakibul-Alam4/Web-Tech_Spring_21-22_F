<?php
include "../../Control/sub/regcheck.php";
?>

<html>

<head>
  <a href="../home.php">Home </a><br>
  <h3>Registration</h3>
  <hr><br>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data" onsubmit="return validatename()">
    <table>
      <tr>
        <td>Username:</td>
        <td><input type="text" id='username' name="username" required>
          <p id="unameerr"></p>
        </td>
      </tr>
      <tr>
        <td>Phone No:</td>
        <td><input type="text" name="phone" required></td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><input type="email" name="email" required></td>
      </tr>
      <tr>
        <td>Choose Package:</td>
        <td>
          <input type="radio" name="package" value="5mbps"> 5 Mbps
          <input type="radio" name="package" value="10mbps"> 10 Mbps
          <input type="radio" name="package" value="20mbps"> 20 Mbps
        </td>
      </tr>
      <tr>
        <td>IPv4:</td>
        <td>
          <input type="checkbox" name="publicip"> Public IP
        </td>
      </tr>

      <tr>
        <td>Password:</td>
        <td><input type="password" name="password" required></td>
      </tr>
      <tr>
        <td>Please choose a Photo:</td>
        <td><input type="file" name="file" required></td>
      </tr>

    </table>

    <input type="submit" name="submit">
    <input type="reset" name="reset">
  </form>
  <script src="../../js/sub/subjs.js"></script>
  <!--  Load the js later -->
</body>

</html>