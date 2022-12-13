<?php

session_start();
$haserror = false;

if (isset($_POST["submit"])) {
  $newpass = $_POST["newpass1"];
  $email = $_POST["email"];

  if (empty($email) || empty($newpass) || empty($_POST["newpass2"])) {
    echo "All info must be filled!\n";
    $haserror = true;
  } else if (strlen($newpass) < 8) {
    echo "Password cannot be less than 8 characters!<br>";
    $haserror = true;
  } else if ($newpass != $_POST["newpass2"]) {
    echo "Passwords does not match!<br>";
    $haserror = true;
  }

  if (!$haserror) {
    $usersdata = '../../Data/subs.json';

    $data = file_get_contents($usersdata);
    $mydata = json_decode($data);
    $found = false;

    foreach ($mydata as $myobject) {
      if ($myobject->email == $email) {
        $found = true;
        $myobject->password = $newpass;

        $jsondata = json_encode($mydata, JSON_PRETTY_PRINT);
        file_put_contents($usersdata, $jsondata);
        break;
      }
    }

    if ($found)
      header("location: login.php");
    else echo "User not found with the E-Mail!<br>";
  }
}
