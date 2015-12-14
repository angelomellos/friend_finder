<?php
require 'vendor/autoload.php';
$config = parse_ini_file('/../../../config.ini');
$dbuser = $config['username'];
$dbpass = $config['password'];
$email = $_POST["email"];
$user_pass = $_POST["pass"];
session_start();
try
{
  $db = new PDO('mysql:host=localhost;dbname=friend_finder', $dbuser, $dbpass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = $db->prepare("SELECT * from users WHERE email='$email'");
  $query->execute();
  $stored_pass = $query->fetchAll()[0]['password'];
  $db = null;
}
catch (PDOException $e)
{
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

if ($stored_pass == $user_pass){
  $_SESSION['auth_user'] = TRUE;
  $_SESSION['user_email'] = $email;
  header('Location: index.php');
  exit();
} else{
  $_SESSION['invalid'] = TRUE;
  header('Location: index.php');
  exit();
}
?>
