<?php
function conn()
{
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "pdo";

  try {
    return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
