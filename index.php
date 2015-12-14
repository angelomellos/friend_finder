<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$client = ClientBuilder::create()->build();

if (!isset($_SESSION))
  session_start();

if (isset($_SESSION['auth_user']) && $_SESSION["auth_user"]) {
  echo 'main page here';
} else{
  if($_SESSION['invalid'])
    echo 'invalid username or password';
  echo 'login form here';
}

$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['body']['query']['match']['age'] = 15;
try{
  $result = $client->search($params);
  print_r($result['hits']['hits'][0]['_source']['name']);
  echo "<br>";
  print_r($result['hits']['hits'][0]['_source']['age']);
  echo "<br>";
  print_r($result['hits']['hits'][0]['_source']['badges']);
} catch(Exception $e) {
  print_r($e);
}
?>
