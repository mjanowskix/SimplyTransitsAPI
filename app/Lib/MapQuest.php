<?php
namespace App\Lib;

class MapQuest {

  protected $consumer_key;
  public function __construct(string $consumer_key) {
    $this->consumer_key = $consumer_key;
  }

  public function route($locations) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://www.mapquestapi.com/directions/v2/route?key=$this->consumer_key",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $locations,
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json; charset=UTF-8"
      ),
    ));

    $result = json_decode(curl_exec($curl));
    $info = curl_getinfo($curl);
    if($info['http_code'] == 200) {
      return $result;
    } else {
      return false;
    }
  }
}
