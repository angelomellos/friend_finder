<?php
require '../../index.php';
//require '../vendor/autoload.php';
//use Elasticsearch\ClientBuilder;
/**
 * @backupGlobals disabled
 */
class GetAddressFromSourceTest extends PHPUnit_Framework_TestCase
{
     public function testGetAddressFromSource()
   {
     $source = array(
          "first-name" => "Obi Wan",
          "last-name" => "Kenobi",
          "full-name" => "Obi Wan Kenobi",
          "city" => "New York",
          "state" => "New York",
          "address" => "1140 Park Avenue",
          "zip" => "10128",
          "email" => "obiwan@gmail.com"
        );
      $address = get_address_from_source($source);
      $expected_address = $source['address'] . " " . $source['city'] . ", " . $source['state'];
      $this->assertEquals($expected_address, $address);
    }
}
?>
