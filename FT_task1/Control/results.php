<?php

include "../Model/model.php";
$fname = $lname = $age = $email = $pass = $dgn = $c1 = $c2 = $c3 = "";
$lang = array();

// Fetch All
if (isset($_POST['Fetch'])) {
  $mydb = new DB();
  $conn = $mydb->opencon();
  $result = $mydb->fetchData($conn);

  if ($result->num_rows > 0) {
    echo "<table>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      foreach ($row as $k => $v) {
        echo "<td>$v</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
}

//Search
if (isset($_POST['Search']) && !empty($_POST['searchname'])) {
  $langs = array();
  $found = false;

  $mydb = new DB();
  $conn = $mydb->opencon();
  $result = $mydb->fetchData($conn, $_POST['searchname']);
  //print_r($result);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if (!$found) {
        $found = true;
        $fname = $row['fname'];
        $lname = $row['lname'];
        $age = $row['age'];
        $email = $row['email'];
        $pass =  $row['pass'];
        $dgn = $row['dgn'];
      }

      if ($row['lang'] == "JAVA") $c1 = true;
      if ($row['lang'] == "PHP") $c2 = true;
      if ($row['lang'] == "C++") $c3 = true;
    }
  }
}

if (isset($_POST['Submit'])) {
  $haserror = false;

  // Name
  $fname = $_REQUEST["fname"];
  $lname = $_REQUEST["lname"];

  if (strlen($fname) < 5 || strlen($lname) < 5) {
    $haserror = true;
    echo "Names must be 5 characters or more";
    echo "; Your Name is " . $fname . " " . $lname;
  } else {
    //echo "Your Name is " . $fname . " " . $lname;
  }

  // Password
  echo "<br>";
  $pass = $_REQUEST["password"];

  if (strlen($pass) < 8) {
    $haserror = true;
    echo "Password must be 8 characters or more";
    echo "; Your password is " . $pass;
  } else {
    //echo "Your password is " . $pass;
  }

  // Age
  echo "<br>";
  $age = $_REQUEST["age"];

  if (strlen($age) < 1) {
    $haserror = true;
    echo "You must Enter valid age";
    echo "; Your age is 0";
  } else {
    //echo "Your age is " . $age;
  }

  // Radio
  echo "<br>";
  $dgn = $_REQUEST["rd"];
  if (isset($_REQUEST["rd"])) {
    //echo "You have selected " . $dgn;
  } else {
    $haserror = true;
    echo "You have no radio selection";
  }

  // Checkbox
  echo "<br>";

  if (isset($_REQUEST["c1"]) || isset($_REQUEST["c2"]) || isset($_REQUEST["c3"])) {
    echo "You have selected checkbox ";

    if (isset($_REQUEST["c1"])) {
      $lang[] = $_REQUEST["c1"];
      //echo $_REQUEST["c1"] . ", ";
    }
    if (isset($_REQUEST["c2"])) {
      $lang[] = $_REQUEST["c2"];
      //echo $_REQUEST["c2"] . ", ";
    }
    if (isset($_REQUEST["c3"])) {
      $lang[] = $_REQUEST["c3"];
      //echo $_REQUEST["c3"] . ", ";
    }
  } else {
    $haserror = true;
    echo "You have no checkbox selection";
  }

  // Email
  echo "<br>";
  $email = $_REQUEST["email"];

  if (strlen($email) < 1) {
    $haserror = true;
    echo "You must Enter valid email";
  } else {
    //echo "Your email is " . $email;
  }

  // File
  // echo "<br>";

  // echo $_FILES["file"]["tmp_name"] . "; ";
  // echo $_FILES["file"]["type"] . "; ";
  // echo $_FILES["file"]["size"] . "\n";

  if ($_FILES["file"]["name"] == "") {
    $haserror = true;
    echo "Must upload a file!";
  } else if ($_FILES["file"]["type"] != "image/jpeg") {
    $haserror = true;
    echo "File must be in JPG format!";
  } else if ($_FILES["file"]["size"] > 2 * 1024 * 1024) {
    $haserror = true;
    echo "File size must be less than 2MB!";
  }

  //DB
  if (!$haserror) {
    $mydb = new DB();
    $conn = $mydb->opencon();
    if ($mydb->insertData($conn, $fname, $lname, $age, $email, $pass, $lang, $dgn)) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], "../Files/" . $fname . ".jpg")) { //$_FILES["file"]["name"]
        //echo "File Uploaded\n";
      } else {
        echo "Cannot Upload";
      }
    }
  }
}
