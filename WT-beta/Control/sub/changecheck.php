<?php
session_start();

if (isset($_POST["btnchange"]) && isset($_POST['package'])) {

  // Check Cookie & Session
  if (!isset($_COOKIE['uname']) && !isset($_SESSION['uname'])) {
    header('location: loginsub/login.php');
  } else if (!isset($_COOKIE['uname'])) {
    setcookie('uname', $_SESSION['uname'], time() + (86400 * 30), "/");
  }

  // Fetch Sub Data
  $usersdata = '../../Data/subs.json';
  $data = file_get_contents($usersdata);
  $mydata = json_decode($data);

  foreach ($mydata as $myobject) {
    if ($myobject->username == $_COOKIE['uname']) {
      $package = $myobject->package;   // Cookie Package

      if ($_POST['package'] != $package) {
        $myobject->package = $_POST['package'];

        $jsondata = json_encode($mydata, JSON_PRETTY_PRINT);
        file_put_contents($usersdata, $jsondata);
      }
      break;
    }
  }
  header("location: ../loginsub/login.php");
}
