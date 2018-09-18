<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Lib\MapQuest;
use App\Lib\Transits\Transit;
use App\Lib\Transits\TransitsCollection;

class TransitsController extends Controller {

  public function get() {
    $transitsCollection = $this->cache->get('transits.collection') ?? new TransitsCollection;
    $transitsCollection->sort();
    $result = [
      "locations" => $transitsCollection,
    ];
    return $this->response->withJson($result, 200);
  }

  public function post() {
    $params = $this->getAllParams();
    if(!$this->validateRequest($params)) return $this->response->withJson(["status" => 400, "error" => TRUE, "msg" => "BAD REQUEST"], 400);

    $mapQuest = new MapQuest($this->config('mapquest')['consumer_key']);
    $params['options'] = array("unit" => "k");

    $data = $mapQuest->route(json_encode($params));

    if($data !== false) {

      $transit = new Transit($params['locations'], $data->route->distance);
      $transitsCollection = $this->cache->get('transits.collection') ?? new TransitsCollection;
      $transitsCollection->add($transit);
      $this->cache->set('transits.collection', $transitsCollection);
      return $this->response->withJson($transit, 200);

    } else {
      return $this->response->withJson(["status" => 500, "error" => TRUE, "msg" => "INTERNAL SERVER ERROR"], 500);
    }
  }

  protected function validateRequest($params) {
    if(count($params['locations']) < 2) {
      return false;
    } else {
      foreach($params['locations'] as $location) {
        if(!preg_match('/^[\S\s]+,[\S\s]+,\s{0,}[a-zA-Z]{2,3}$/', trim($location))) return false;
      }
    }
    return true;
  }

}
