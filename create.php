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

?>
