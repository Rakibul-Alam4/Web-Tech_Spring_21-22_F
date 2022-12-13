<?php
include "../../Control/staff/forgotcheck.php";
?>
<html>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Enter your e-mail:</td>
        <td><input type="text" name="email"></td>
      </tr>
      <tr>
        <td>Enter new password:</td>
        <td><input type="password" name="newpass1"></td>
      </tr>
      <tr>
        <td>Confirm new password:</td>
        <td><input type="password" name="newpass2"></td>
      </tr>
    </table>
    <input type="submit" name="submit">
</body>

</html>