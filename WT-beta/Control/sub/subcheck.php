<?php
include "../Models/subs.php";

// Check Cookie & Session
// if (!isset($_COOKIE['uname']) && !isset($_SESSION['uname'])) {
//   header('location: loginsub/login.php');
// } else if (!isset($_COOKIE['uname'])) {
//   setcookie('uname', $_SESSION['uname'], time() + (86400 * 30), "/");
// }

$haserror = false;

if (isset($_POST["btnupdate"])) {
  $avfolder = "../Files/avatarsub/";
  $usersdata = '../Data/subs.json';
  $user = $_SESSION['uname'];

  // Photo
  if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if ($_FILES["file"]["size"] == filesize($avfolder . $user . ".jpg")) {
      $haserror = true;
    } else if ($_FILES["file"]["size"] > 2 * 1024 * 1024) {
      echo "Photo size must be less than 2MB!<br>";
      $haserror = true;
    }
  }

  if (!$haserror) {
    $mydb = new subDB();
    $conn = $mydb->opencon();
    if ($mydb->insertData($conn, $fname, $lname, $age, $email, $pass, $lang, $dgn)) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], "../Files/" . $fname . ".jpg")) { //$_FILES["file"]["name"]
        //echo "File Uploaded\n";
      } else {
        echo "Cannot Upload";
      }
    }
  }

  // JSON
  // if (!$haserror) {
  //   $data = file_get_contents($usersdata);
  //   $mydata = json_decode($data);
  //   $found = false;

  //   foreach ($mydata as $myobject) {
  //     if ($myobject->username == $user) {
  //       // File
  //       if (is_uploaded_file($_FILES['file']['tmp_name'])) {
  //         $found = true;
  //         $newavatar = $myobject->avatar . "1.jpg";
  //         $myobject->avatar = $newavatar;

  //         if (!move_uploaded_file($_FILES["file"]["tmp_name"], $avfolder . $newavatar))
  //           echo "Could not upload Photo";
  //       }

  //       //Phone
  //       if (!empty($_POST['phone']) && $_POST['phone'] != $myobject->phone) {
  //         $found = true;
  //         $myobject->phone = $_POST['phone'];
  //       }

  //       //pdate Data
  //       if ($found) {
  //         $jsondata = json_encode($mydata, JSON_PRETTY_PRINT);
  //         file_put_contents($usersdata, $jsondata);
  //         header("location: subscriber.php");
  //       }
  //       break;
  //     }
  //   }
  // }
}
