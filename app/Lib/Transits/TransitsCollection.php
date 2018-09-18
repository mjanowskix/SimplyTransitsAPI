<?php
namespace App\Lib\Transits;
use \IteratorAggregate;
use \ArrayIterator;
use \JsonSerializable;
use App\Lib\Transits\Transit;

class TransitsCollection implements IteratorAggregate, JsonSerializable {

  protected $transits = [];

  public function get() {
    return $this->transits;
  }

  public function add(Transit $transit) {
    $this->transits[] = $transit;
  }

  public function merge(TransitsCollection $transitsCollection) {
    $this->transits = array_merge($this->transits, $transitsCollection->get());
  }

  public function count() {
    return count($this->transits);
  }

  public function sort() {
    usort($this->transits, function ($a, $b) {
      if ($a->createdAt == $b->createdAt) {
        return 0;
      }
      return ($a->createdAt < $b->createdAt) ? 1 : -1;
    });
  }

  public function jsonSerialize() {
    return $this->transits;
  }

  public function getIterator() {
    return new ArrayIterator($this->transits);
  }
}
