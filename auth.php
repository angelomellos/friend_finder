<?php
require 'vendor/autoload.php';
$config = parse_ini_file('/../../../config.ini');
$dbuser = $config['username'];
$dbpass = $config['password'];
$email = htmlspecialchars($_POST["email"]);
$user_pass = htmlspecialchars($_POST["pass"]);
try
{
  $db = new PDO('mysql:host=localhost;dbname=friend_finder', $dbuser, $dbpass);
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
  _SESSION['auth_user']= TRUE;
  header('Location: index.php');
  exit();
} else{
  print 'invalid credentials';
}
?>
