<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/
   *  - or -
   *    http://example.com/welcome/index
   *
   * So any other public methods not prefixed with an underscore will
   * map to /welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
  {
    $allPlanes = $this->fleets->all();
    $allFlights = $this->flights->all();

    $totalFlights = count($allFlights);
    $totalPlanes = count($allPlanes);
    $destinations = array('Fort St. John Airport', 'Abbotsford Airport', 'Dease Lake Airport');

    $this->data['flightTotal'] = $totalFlights;
    $this->data['planeTotal'] = $totalPlanes;
    $this->data['homeBase'] = 'Fort Nelson Airport';
    $this->data['destinationAirports'] = implode('<br>', $destinations);

    $this->data['pagetitle'] = 'Vulture Airlines';
    $this->data['pagebody'] = 'welcome_message';
    $this->render();
  }

}
