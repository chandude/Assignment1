<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Default controller for the application
 * @author Harman Mahal
 */
class Welcome extends Application
{

  /**
   *  Homepage for the application
   *  Provides basic overview of the Vulture Airlines
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
