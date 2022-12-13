<?php
include "../../../Control/sub/changecheck.php";
?>

<html>

<head>
  <a href="../home.php">Home </a> |
  <a href="../../../Control/sub/logout.php">Log Out </a><br><br>
  <h3>Change Subscription</h3>
  <hr>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Change Package:</td>
        <td>
          <input type="radio" name="package" value="5mbps"> 5 Mbps
          <input type="radio" name="package" value="10mbps"> 10 Mbps
          <input type="radio" name="package" value="20mbps"> 20 Mbps
        </td>
      </tr>

    </table>
    <input type="submit" name="btnchange" value="Change">
  </form>
</body>

</html>