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

    //Get array from wackyAPI with vulture information
    $airline = $this->wackyAPI->getAirline();

    //grab destination airport codes
    $destinationCodes = array($airline["dest1"], $airline["dest2"], $airline["dest3"]);

    $destinationNames = array();

    //use WackyAPI to grab names of destinations
    foreach($destinationCodes as $destination)
    {
        $destination = $this->wackyAPI->getAirport($destination);
        array_push($destinationNames,$destination["airport"]);
    }

    $totalFlights = count($allFlights);
    $totalPlanes = count($allPlanes);
    $this->data['flightTotal'] = $totalFlights;
    $this->data['planeTotal'] = $totalPlanes;
    $this->data['homeBase'] = 'Fort Nelson Airport';
    $this->data['destinationAirports'] = implode('<br>', $destinationNames);

    $this->data['pagetitle'] = 'Vulture Airlines';
    $this->data['pagebody'] = 'welcome_message';
    $this->render();
  }
}
