<?php
require 'vendor/autoload.php';
$config = parse_ini_file('/../../../config.ini');
$dbuser = $config['username'];
$dbpass = $config['password'];
session_start();
$email = $_POST["email"];
$password = $_POST["password"];
//TODO: hash password
try
{
  $db = new PDO('mysql:host=localhost;dbname=friend_finder', $dbuser, $dbpass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = $db->prepare("INSERT INTO users VALUES ('$email', '$password')");
  $query->execute();
  $db = null;
}
catch (PDOException $e)
{
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
//TODO:try{}
$params = array();
$params['body']  = array(
  'first-name' => $_POST["first-name"],
  'last-name' => $_POST["last-name"],
  'city' => $_POST["city"],
  'state' => $_POST["state"],
  'address' => $_POST["address"],
  'zip' => $_POST["zip"],
  'email' => $_POST["email"]
);
$params['index'] = 'friends';
$params['type']  = 'friends';

$result = $client->index($params);

$_SESSION['user_email'] = $_POST["email"];
$_SESSION['auth_user'] = TRUE;
header('Location: index.php');
exit();
?>
