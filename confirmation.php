<?php
require 'vendor/autoload.php';
$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
));
echo $m->render('confirmation');
?>
