<?php

class Info extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  public function index() {
    header("HTTP/1.1 403 Forbidden");
    exit;
  }

  public function fleet() {
    $allPlanes = $this->fleets->all();
    $this->output->set_content_type('application/json')->set_output(json_encode($allPlanes));
  }

  public function flights() {
    $allFlights= $this->flights->all();
    $this->output->set_content_type('application/json')->set_output(json_encode($allFlights));
  }

}
