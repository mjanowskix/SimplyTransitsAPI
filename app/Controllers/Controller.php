<?php
namespace App\Controllers;

abstract class Controller {
    protected $request, $response, $args, $container;

    public function __construct($request, $response, $args, $container) {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        $this->container = $container;
    }

    public function __get($property) {
      if ($this->container->{$property}) {
          return $this->container->{$property};
      }
    }

    public function config($key) {
        return $this->config->get($key);
    }

    public function param($name) {
        return $this->request->getParam($name);
    }

    public function getAllParams() {
      return $this->request->getParsedBody();
    }
  }
