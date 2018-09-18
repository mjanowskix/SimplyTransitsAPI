<?php
use App\Lib\Transits\TransitsCollection;
use App\Lib\Transits\Transit;

class TransitsCollectionTest extends PHPUnit_Framework_TestCase {

  /** @test */
  public function returns_json_encoded_items() {
    $transitsCollection = new TransitsCollection;
    $this->assertInternalType('string', json_encode($transitsCollection));
  }
  /** @test */
  public function returns_array_of_transits_objects() {
    $transit = new Transit(['Marszałkowska 58, Warszawa, PL','Marszałkowska 8, Warszawa, PL'], 2.3);
    $transit2 = new Transit(['Marszałkowska 58, Warszawa, PL','Marszałkowska 8, Warszawa, PL'], 2.3);
    $transitsCollection = new TransitsCollection;
    $transitsCollection->add($transit);
    $transitsCollection->add($transit2);

    $this->assertCount(2, $transitsCollection);
    $this->assertInstanceOf(Transit::class, $transitsCollection->get()[0]);
  }

  /** @test */
  public function merges_two_collections() {
    $transit = new Transit(['Marszałkowska 58, Warszawa, PL','Marszałkowska 8, Warszawa, PL'], 2.3);
    $transit2 = new Transit(['al. Jerozolimskie 3, Warszawa, PL','Wspólna 3, Poznań, PL'], 195.3);
    $transit3 = new Transit(['al. Kraśnickie 121, Lublin, PL','Podwale 12, Kraków, PL'], 221.1);

    $transitsCollection1 = new TransitsCollection;
    $transitsCollection2 = new TransitsCollection;
    $transitsCollection1->add($transit);
    $transitsCollection1->add($transit2);
    $transitsCollection2->add($transit3);

    $transitsCollection1->merge($transitsCollection2);

    $this->assertCount(3, $transitsCollection1);

  }
}
