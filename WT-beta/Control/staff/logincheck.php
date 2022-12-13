<?php

session_start();

$haserror = false;

if (isset($_POST["submit"])) {
  if (empty($_POST["username"])) {
    echo "Username cannot be empty!\n";
    $haserror = true;
  }

  if (empty($_POST["password"])) {
    echo "Password cannot be empty!";
    $haserror = true;
  }

  if (!$haserror) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["password"] = $_POST["password"];

    $usersdata = '../../Data/staff.json';

    $data = file_get_contents($usersdata);
    $mydata = json_decode($data);
    $valid = 0;

    foreach ($mydata as $myobject) {
      if ($myobject->username == $_POST["username"]) {
        if ($myobject->password == $_POST["password"])
          $valid = 1;
        else
          $valid = 2;
        break;
      }
    }

    if ($valid == 1) header("location: ../staff.php");
    else if ($valid == 2) echo "Wrong password!<br>";
    else if ($valid == 0) echo "wrong User!<br>";
  }
}
