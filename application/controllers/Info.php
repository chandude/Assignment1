<?php

/**
 *  Info controller is a RESTful-ish service controller which returns the data models as JSON
 *
 * @author Harman Mahal
 */
class Info extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  /**
   * Returns 403 error when info is accessed directly
   */
  public function index() {
    header("HTTP/1.1 403 Forbidden");
    exit;
  }

  /**
   * Returns the Fleet model as JSON for get request to info/fleet
   */
  public function fleet() {
    $allPlanes = $this->fleets->all();
    $this->output->set_content_type('application/json')->set_output(json_encode($allPlanes));
  }

  /**
   * Returns the Flights model as JSON for get request to info/flights
   */
  public function flights() {
    $allFlights= $this->flights->all();
    $this->output->set_content_type('application/json')->set_output(json_encode($allFlights));
  }

}
