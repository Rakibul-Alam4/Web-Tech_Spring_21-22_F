<?php

class subDB
{
  function opencon()
  {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "isp";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
      echo "Cannot connect<br>" . $conn->connect_error;
      return false;
    }
    return $conn;
  }

  function closecon($conn)
  {
    $conn->close();
  }

  function searchUser($user, $email)
  {
    $sqlstr = "SELECT * FROM subs WHERE user = '$user' OR email='$email';";
    $conn = $this->opencon();
    $query = false;

    try {
      $query = $conn->query($sqlstr);
    } catch (Exception $e) {
      echo "cannot search user!<br>" . $e; //$conn->error;
    }

    $this->closecon($conn);
    return $query;
  }

  function loginUser($user, $pass)
  {
    $sqlstr = "SELECT * FROM subs WHERE user = '$user';";
    $conn = $this->opencon();
    $result = 0;

    // try {
    if ($conn->query($sqlstr)->num_rows > 0) {
      $sqlstr = "SELECT * FROM subs WHERE user = '$user' AND pass = '$pass';";
      $result = $conn->query($sqlstr);

      if ($result->num_rows < 1) {
        $result = 1;
      }
    }
    else {
      $result = 2;
    }
    // } catch (Exception $e) {
    //   echo "cannot search user<br>" . $e; //$conn->error;
    //   return 0;
    // }

    $this->closecon($conn);
    return $result;
  }

  function insertData($user, $pass, $email, $phone, $package, $ip, $avatar)
  {
    $result = false;
    $sqlstr = "INSERT INTO subs (user, pass, email, phone, package, ip, avatar)
        VALUES('$user', '$pass', '$email', $phone, '$package', '$ip', '$avatar');";

    $conn = $this->opencon();

    if ($conn->query($sqlstr)) {
      //echo "record Inseted!";
      $result = true;
    } else {
      echo "cannot insert<br>" . $conn->error; //$e;
      $result = false;
    }

    $this->closecon($conn);
    return $result;
  }
}
