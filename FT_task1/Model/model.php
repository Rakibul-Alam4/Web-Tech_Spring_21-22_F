<?php

class DB
{
  function opencon()
  {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "wtform";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
      echo "Cannot connect" . $conn->connect_error;
    }

    return $conn;
  }

  function insertData($conn, $fname, $lname, $age, $email, $pass, $lang, $dgn)
  {
    $sqlstr = "INSERT INTO person (fname,lname, age, email, pass, dgn)
        VALUES('$fname', '$lname', '$age', '$email', '$pass', '$dgn');";

    foreach ($lang as $c) {
      echo $c . "<br>";
      $sqlstr .= " INSERT INTO langs (fname,lname,email,lang) VALUES('$fname', '$lname', '$email', '$c');";
    }
    //echo $sqlstr . '<br>';
    try {
      $conn->multi_query($sqlstr);
      echo "record Inseted!";
      return true;
    } catch (Exception $e) {
      echo "cannot insert" . $e; //$conn->error;
      return false;
    }
  }

  function fetchData($conn)
  {
    $sqlstr = "SELECT * FROM person LEFT JOIN langs ON person.email = langs.email ";
    try {
      $query = $conn->query($sqlstr);
    } catch (Exception $e) {
      echo "cannot insert" . $e;
    }

    return $query;
  }

  function searchUser($conn, $fname)
  {
    $sqlstr = "SELECT * FROM person LEFT JOIN langs ON  person.fname = langs.fname WHERE person.fname = '$fname'";
    $query = $conn->query($sqlstr);
    return $query;
  }

  function updateData($conn, $fname, $lname, $age, $email, $pass, $dgn, $lang)
  {
    $sqlstr = "UPDATE person SET lname='$lname', age='$age', 
        email='$email', pass='$pass', dgn='$dgn' WHERE fname = '$fname';";

    foreach ($lang as $c) {
      $sqlstr .= "UPDATE langs SET lname='$lname', age='$age', email='$email', lang='$c');";
    }
    $query = $conn->query($sqlstr);
    return $query;
  }

  function closecon($conn)
  {
    $conn->close();
  }
}
