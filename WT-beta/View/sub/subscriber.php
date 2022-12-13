<?php
session_start();
include "../../Control/sub/subcheck.php";
$phone = $email = $package = $ip = $avatar = '';

$mydb = new subDB();
$result = $mydb->searchUser($_SESSION['uname'], '');

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $phone = $row['phone'];
  $email = $row['email'];
  $package = $row['package'];
  $ip = $row['ip'];
  $avatar = $row['avatar'];
}

// JSON
// Fetch Sub Data
// $usersdata = '../Data/subs.json';
// $data = file_get_contents($usersdata);
// $mydata = json_decode($data);

// foreach ($mydata as $myobject) {
//   if ($myobject->username == $_SESSION['uname']) {
//     $phone = $myobject->phone;
//     $email = $myobject->email;
//     $package = $myobject->package;
//     $ip = $myobject->ip;
//     $avatar = $myobject->avatar;
//     break;
//   }
// }
?>

<html>

<head>
  <a href="home.php">Home </a> |
  <a href="../../Control/sub/logout.php">Log Out </a><br><br>
  <h3>Subscriber Profile</h3>
  <hr>
  <link rel="stylesheet" type="text/css" href="../../css/substyle.css">
</head>

<body>
  <div id="box">
    <form action="" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td> Avatar: </td>
          <td>
            <img src="../../Files/avatarsub/<?= $avatar; ?>" alt="<?= $_SESSION['uname']; ?>" width="100" height="100">
          </td>
        </tr>
        <tr>
          <td>Username: </td>
          <td><?php echo $_SESSION['uname']; ?></td>
        </tr>
        <tr>
          <td>Phone No:</td>
          <td><input type="text" name="phone" placeholder="<?= $phone; ?>">
            
          </td>
        </tr>
        <tr>
          <td>E-mail:</td>
          <td><?= $email; ?></td>
        </tr>
        <tr>
          <td>Package:</td>
          <td><?= $package; ?>&nbsp;<a href="profile/changesub.php">[Change package?]</a></td>
        </tr>
        <tr>
          <td>IPv4:</td>
          <td><?= $ip; ?></td>
        </tr>
        <!-- <tr>
        <td>Password:</td>
        <td><input type="password" name="password" placeholder=""></td>
      </tr> -->
        <tr>
          <td>Update Photo:</td>
          <td><button type="file" class="btnfile" name="file">Upload</button></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="submit" class="btnupdate" name="btnupdate">Update</button>
            <button type="reset" class="btnreset" name="reset"> Reset</button>
          </td>
        </tr>

      </table>

    </form>
    
</body>

</html>