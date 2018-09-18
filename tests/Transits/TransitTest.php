<?php
use App\Lib\Transits\Transit;

class TransitTest extends PHPUnit_Framework_TestCase {

  /** @test */
  public function returns_json_encoded_items() {
    $transit = new Transit(['Marszałkowska 58, Warszawa, PL','Marszałkowska 8, Warszawa, PL'], 2.3);
    $this->assertInternalType('string', json_encode($transit));
  }
  /** @test */
  public function returns_proper_values() {
    $locations = ['Marszałkowska 58, Warszawa, PL','Marszałkowska 8, Warszawa, PL'];
    $distance = 2.3;
    $transit = new Transit($locations, $distance);
    $this->assertEquals($distance, $transit->distanceKilometers);
    $this->assertCount(2, $transit->locations);
    $this->assertEquals($locations[0], $transit->locations[0]);
  }

  /** @test */
  public function generates_id_in_uuid4_format() {
    $transit = new Transit(['Marszałkowska 58, Warszawa, PL','Marszałkowska 8, Warszawa, PL'], 2.3);
    $this->assertEquals(1,(preg_match('/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/', $transit->id)));
  }
}
