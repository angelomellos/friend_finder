<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$client = ClientBuilder::create()->build();

$params = array();

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';
$params['id'] = '1A-000';

$result = $client->get($params);
print_r($result);



//try {
  //  $dbh = new PDO('mysql:host=localhost;dbname=mysql', 'root', 'mushroomshopper');
    //foreach($dbh->query('SELECT * from help_topic') as $row) {
      //  print_r($row);
   // }
   // $dbh = null;
//} catch (PDOException $e) {
  //  print "Error!: " . $e->getMessage() . "<br/>";
    //die();
//}
?>
