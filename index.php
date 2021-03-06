<?php
require 'vendor/autoload.php';
$config = parse_ini_file('/../../../config.ini');
use Elasticsearch\ClientBuilder;
$client = ClientBuilder::create()->build();
$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
));

session_start();

if (isset($_SESSION['auth_user']) && $_SESSION["auth_user"]) {
  echo $m->render('main', get_all_friends());
} else{
  if($_SESSION['invalid'])
    echo 'invalid username or password';
  echo $m->render('login-form');
}

function get_all_friends($config){
  $client = ClientBuilder::create()->build();
  $params = [];
  $params['index'] = 'friends';
  $params['type'] = 'friends';
  $params['size'] = 1000;
  $params['body']['query']['match_all'] = [$_GET['search']];
  $params['body']['sort'] = ['_score'];
  $result = $client->search($params)['hits']['hits'];
  $sources = array_map(function($arr){
    return $arr['_source'];
  },$result);
  $current_user_location = get_address_from_source(extract_current_user($sources, $_SESSION['user_email']));
  $config = parse_ini_file('/../../../config.ini');
  return array(friends => new ArrayIterator($sources), key => $config['maps_key'], origin => $current_user_location);
}

function extract_current_user(&$sources, $email){
  foreach($sources as $key => $source){
    if ($source['email'] == $email){
         $current_user_source = $sources[$key];
         unset($sources[$key]);
         $sources = array_values($sources);
    }
  }
  if (!$current_user_source)
    $current_user_source = array(address => 'united states');
  return $current_user_source;
}

function get_address_from_source($source){
  return $source['address'] . ' ' . $source['city'] . ', ' . $source['state'];
}

?>
