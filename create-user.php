<?php
require 'vendor/autoload.php';
$config = parse_ini_file('/../../../config.ini');
$dbuser = $config['username'];
$dbpass = $config['password'];
session_start();
$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
try
{
  $db = new PDO('mysql:host=localhost;dbname=friend_finder', $dbuser, $dbpass);
  $query = $db->prepare("INSERT INTO users VALUES ($email, $password)");
  $query->execute();
  $db = null;
}
catch (PDOException $e)
{
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>
