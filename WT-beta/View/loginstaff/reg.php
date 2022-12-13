<?php
include "../../Control/staff/regcheck.php";
?>

<html>

<body>
  <h2>Staff Registration </h2>
  <hr> <br>

  <form action="" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Username:</td>
        <td><input type="text" name="username"></td>
      </tr>
      <tr>
      <tr>
        <td>Password:</td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td>E-Mail:</td>
        <td><input type="email" name="email"></td>
      </tr>
      <tr>
        <td>Please choose a Photo:</td>
        <td><input type="file" name="file"></td>
      </tr>

    </table>

    <input type="submit" name="submit">
    <input type="reset" name="reset">
  </form>
</body>

</html>