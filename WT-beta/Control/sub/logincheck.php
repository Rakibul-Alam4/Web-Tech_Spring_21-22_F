<?php
include "../../Models/subs.php";
session_start();

// Previous Session 
if (isset($_SESSION['uname']))
  header("location: ../subscriber.php");

// New Session
if (isset($_POST["btnlogin"])) {
  $haserror = false;

  if (empty($_POST["username"])) {
    echo "Username cannot be empty!<br>";
    $haserror = true;
  } else {
    $username = $_POST["username"];
  }

  if (empty($_POST["password"])) {
    echo "Password cannot be empty!<br>";
    $haserror = true;
  }

  if (!$haserror) {
    $mydb = new subDB();
    $result = $mydb->loginUser($_POST["username"], $_POST["password"]);

    if ($result->num_rows > 0) {
      $_SESSION["uname"] = $_POST["username"];
      $_SESSION["pass"] = $_POST["password"];
      //setcookie('email', $result["email"], time() + (86400 * 30), "/"); // 86400 = 1 day
      header("location: ../subscriber.php");
    } else {
      switch ($result) {
        case 1:
          echo "Wrong User!<br>";
          break;
        case 2:
          echo "Wrong User!<br>";
          break;
        default:
          echo $result . '<br>';
          break;
      }
    }

    // JSON
    // $usersdata = '../../Data/subs.json';

    // $data = file_get_contents($usersdata);
    // $mydata = json_decode($data);
    // $valid = 0;

    // foreach ($mydata as $myobject) {
    //   if ($myobject->username == $_POST["username"]) {
    //     if ($myobject->password == $_POST["password"]) {
    //       $valid = 1;
    //       $_SESSION["uname"] = $_POST["username"];
    //       $_SESSION["pass"] = $_POST["password"];
    //       setcookie('uname', $_POST["username"], time() + (86400 * 30), "/"); // 86400 = 1 day
    //     } else
    //       $valid = 2;

    //     break;
    //   }
    // }

    // if ($valid == 1) header("location: ../subscriber.php");
    // else if ($valid == 2) echo "Wrong password!<br>";
    // else if ($valid == 0) echo "wrong User!<br>";
  }
}
