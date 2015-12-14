<?php
require 'vendor/autoload.php';
$user = getenv('DBUSER');
$pass = getenv('DBPASS');
try
{
  $db = new PDO('mysql:host=localhost;dbname=friend_finder', $user, $pass);
  $users = $db->query('SELECT * from users');
  $db = null;
}
catch (PDOException $e)
{
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
print_r($users);


?>
