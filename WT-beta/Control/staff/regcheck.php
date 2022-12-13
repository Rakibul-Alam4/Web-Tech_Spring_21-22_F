<?php

session_start();
$haserror = false;

if (isset($_POST["submit"])) {
  $avfolder = "../../Files/avatarstaff/";
  $usersdata = '../../Data/staff.json';

  $existingdata = file_get_contents($usersdata);
  $tempJSONdata = json_decode($existingdata);

  // Username
  $user = $_POST["username"];
  if (empty($user) || strlen($user) < 5) {
    echo "Username cannot be empty or less than 5 characters!<br>";
    $haserror = true;
  }

  // Password
  $pass = $_POST["password"];
  if (empty($pass) || strlen($pass) < 8) {
    echo "Password cannot be empty or less than 8 characters!<br>";
    $haserror = true;
  }

  //Email
  $email = $_POST["email"];
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail cannot be Invalid or empty!<br>";
    $haserror = true;
  } else {
    foreach ($tempJSONdata as $myobject) {
      if ($myobject->email == $email) {
        echo "E-Mail already exists!<br>";
        $haserror = true;
      }
    }
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

    //Get form data
    $formdata = array(
      'username' => $user,
      'password' => $pass,
      'email' => $email,
      'avatar' => $user . ".jpg"
    );
    $tempJSONdata[] = $formdata;
    //Convert updated array to JSON
    $jsondata = json_encode($tempJSONdata, JSON_PRETTY_PRINT);

    if (file_put_contents($usersdata, $jsondata)) {
      if (!move_uploaded_file($_FILES["file"]["tmp_name"], $avfolder . $user . ".jpg"))
        echo "Could not upload Photo";
      else
        header("location: login.php");
    }
  }
}
