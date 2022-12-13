<?php
include "../../Models/subs.php";
$user = $pass = $email = $phone = $package = $ip = $avatar = "";

session_start();
$haserror = false;

if (isset($_POST["submit"])) {
  $user = $pass = $email = $phone = $package = $ip = $avatar = "";

  // DB
  $mydb = new subDB();

  // Username
  $user = $_POST["username"];
  if (empty($user) || strlen($user) < 5) {
    echo "Username cannot be empty or less than 5 characters!<br>";
    $haserror = true;
  } else if ($mydb->searchUser($user, "")->num_rows > 0) {
    //echo $mydb->searchUser($user, " ")->num_rows . '<br>';
    echo "Username already exists!<br>";
    $haserror = true;
  }

  /* JSON
  // Duplicate & Read JSON
  $usersdata = '../../Data/subs.json';
  $existingdata = file_get_contents($usersdata);
  $tempJSONdata = json_decode($existingdata);

  // Username
  $user = $_POST["username"];
  if (empty($user) || strlen($user) < 5) {
    echo "Username cannot be empty or less than 5 characters!<br>";
    $haserror = true;
  } else {
    foreach ($tempJSONdata as $myobject) {
      if ($myobject->username == $user) {
        echo "Username already exists!<br>";
        $haserror = true;
      }
    }

  // JSON
  // foreach ($tempJSONdata as $myobject) {
  //   if ($myobject->username == $user) {
  //     echo "Username already exists!<br>";
  //     $haserror = true;
  //   }
  // }
  */

  // Phone
  $phone = $_POST["phone"];
  if (empty($phone) || !is_numeric($phone)) {
    echo "Phone number cannot be empty or non-numeric!<br>";
    $haserror = true;
  }

  // E-Mail
  $email = $_POST["email"];
  $regex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
  if (
    empty($email)
    || !preg_match($regex, $email)
  ) {
    echo "E-mail cannot be empty or Invalid format!<br>";
    $haserror = true;
  } else if ($mydb->searchUser($user, $email)->num_rows > 0) {
    //echo $mydb->searchUser($user, $email)->num_rows . '<br>';
    echo "E-Mail already exists!<br>";
    $haserror = true;

    // JSON
    // foreach ($tempJSONdata as $myobject) {
    //   if ($myobject->email == $email) {
    //     echo "E-Mail already exists!<br>";
    //     $haserror = true;
    //   }
    // }
  }

  // Package
  $package = $_POST["package"];
  if (!isset($_POST["package"])) {
    echo "Please select an Package!<br>";
    $haserror = true;
  }

  $ip = (isset($_POST['publicip']) ? "Public IP" : "Shared IP");

  // Password
  $pass = $_POST["password"];
  if (empty($pass) || strlen($pass) < 8) {
    echo "Password cannot be empty or less than 8 characters!<br>";
    $haserror = true;
  }

  // Photo
  if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
    echo "Must upload a Photo or avatar!<br>";
    $haserror = true;
  } else if ($_FILES["file"]["type"] != "image/jpeg") {
    echo "Photo must be in JPG format!<br>";
    $haserror = true;
  } else if ($_FILES["file"]["size"] > 2 * 1024 * 1024) {
    echo "Photo size must be less than 2MB!<br>";
    $haserror = true;
  }

  if (!$haserror) {
    $avfolder = "../../Files/avatarsub/";
    $avatar = $user . ".jpg";

    $db = new subDB();
    if ($db->insertData($user, $pass, $email, $phone, $package, $ip, $avatar)) {
      if (!move_uploaded_file($_FILES["file"]["tmp_name"], $avfolder . $avatar)) {
        echo "Cannot upload file!<br>";
      } else {
        header("location: login.php");
      }
    }

    // JSON
    // $avfolder = "../../Files/avatarsub/";

    // //Get form data
    // $formdata = array(
    //   'username' => $user,
    //   'password' => $pass,
    //   'email' => $email,
    //   'phone' => $phone,
    //   'package' => $_POST["package"],
    //   'ip' => $ip,
    //   'avatar' => $user . ".jpg",
    // );

    // $tempJSONdata[] = $formdata;

    // //Convert updated array to JSON
    // $jsondata = json_encode($tempJSONdata, JSON_PRETTY_PRINT);

    // if (file_put_contents($usersdata, $jsondata)) {
    //   if (!move_uploaded_file($_FILES["file"]["tmp_name"], $avfolder . $user . ".jpg"))
    //     echo "Could not upload Photo";
    //   else
    //     header("location: login.php");
    // }
  }
}
