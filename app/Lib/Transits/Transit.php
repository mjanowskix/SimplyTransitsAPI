<?php
namespace App\Lib\Transits;

class Transit implements \JsonSerializable {

  protected $id;
  protected $distanceKilometers;
  protected $locations;
  protected $createdAt;

  public function __construct(array $locations, float $distance) {
    $this->locations = $locations;
    $this->distanceKilometers = $distance;
    $this->createdAt = date_timestamp_get(date_create());
    $this->id = $this->guid4(random_bytes(16));
  }

  public function __get($var) {
      return $this->{$var} ?? null;
  }

  public function guid4($data) {
    assert(strlen($data) == 16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  public function jsonSerialize() {
    return [
      "id" => $this->id,
      "distanceKilometers" => $this->distanceKilometers,
      "locations" => $this->locations,
      "createdAt" => $this->createdAt
    ];
  }
}
