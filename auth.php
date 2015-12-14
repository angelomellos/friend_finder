<?php
require 'vendor/autoload.php';
$user = getenv('DBUSER');
$pass = getenv('DBPASS');
try {
   $dbh = new PDO('mysql:host=localhost;dbname=mysql', $user, $pass);
    foreach($dbh->query('SELECT * from help_topic') as $row) {
       print_r($row);
   }
   $dbh = null;
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>
