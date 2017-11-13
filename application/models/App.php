<?php

class App extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function plane($which = null)
  {
    $planes = $this->fleets->all();
    $planeAssocArray = array();
    foreach ($planes as $plane) {
      $planeAssocArray[$plane->id] = $plane->id;
    }
    return isset($which) ?
      (isset($planeAssocArray[$which]) ? $planeAssocArray[$which] : '') :
      $planeAssocArray;
  }

  public function airports($which = null)
  {
    $airline = $this->wackyAPI->getAirline();

    //grab destination airport codes
    $destinationCodes = array($airline["dest1"], $airline["dest2"], $airline["dest3"]);

    $destinationNames = array();
    $destAssocArray = array();

    //use WackyAPI to grab names of destinations
    foreach ($destinationCodes as $destination) {
      $destination = $this->wackyAPI->getAirport($destination);
      array_push($destinationNames, (object)$destination);
    }

    foreach ($destinationNames as $destinationName) {
      $destAssocArray[$destinationName->airport] = $destinationName->airport;

    }

    $destAssocArray['Fort Nelson Airport'] =  'Fort Nelson Airport';

    return isset($which) ?
      (isset($destAssocArray[$which]) ? $destAssocArray[$which] : '') :
      $destAssocArray;
  }

  public function getAllPlanes($which = null)
  {
    $planes = $this->wackyAPI->getAirplanes();
    $planeObj = array();
    foreach ($planes as $plane) {
      array_push($planeObj, (object)$plane);
    }
    $planeIds = array();

    foreach ($planeObj as $plane) {
      $planeIds[$plane->id] = $plane->model;
    }

    return isset($which) ?
      (isset($planeIds[$which]) ? $planeIds[$which] : '') :
      $planeIds;
  }

  public function getPlaneInfo($planeId)
  {
    $plane = $this->wackyAPI->getAirplane($planeId);
    return $plane;
  }

  public function validatePlane($plane)
  {
    $limit = 10000;
    $currentValue = $plane->price;
    $currentPlanes = $this->fleets->all();

    foreach ($currentPlanes as $currentPlane) {
      $currentValue += $currentPlane->price;
    }

    if ($currentValue > $limit) {
      return false;
    } else
      return true;

  }

  public function validateFlight($flight)
  {
    $latestLandingTime = 2200;
    $earliestTakeoffTime = 800;
    if($flight->destination == $flight->departure)
      return false;
    if($flight->arrivalTime > $latestLandingTime)
      return false;
    if($flight->departTime < $earliestTakeoffTime)
      return false;
    if($flight->departTime > $flight->arrivalTime)
      return false;

    return true;
  }


}