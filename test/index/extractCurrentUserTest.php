<?php
require '../../index.php';
/**
 * @backupGlobals disabled
 */
class ExtractCurrentUserTest extends PHPUnit_Framework_TestCase
{
  public function testExtractCurrentUser(){
    $sources = array(
      0 => array("first-name" => "Obi Wan", "email" => "obiwan@gmail.com"),
      1 => array("first-name" => "Luke", "email" => "jedi@gmail.com"),
      2 => array("first-name" => "Darth", "email" => "darkside@gmail.com")
    );
    $expected_user = $sources[1];
    //it returns the extracted user
    $this->assertEquals($expected_user, extract_current_user($sources, "jedi@gmail.com"));
    //the array no longer contains the extracted user
    $this->assertEquals(2, count($sources));
    //array_values was called on the array, leaving index 0 and 1
    $this->assertEquals("obiwan@gmail.com", $sources[0]['email']);
    $this->assertEquals("darkside@gmail.com", $sources[1]['email']);
  }
}
?>
