<?php

class App extends CI_Model
{

  private $takeofftimes = [
    '0800',
    '0900',
    '1000',
    '1100',
    '1200',
    '1300',
    '1400',
    '1500',
    '1600'
  ];

  public function __construct()
  {
    parent::__construct();
  }

  public function plane($which = null)
  {
    $planes = $this->fleets->all();
    $planes = array_map(create_function('$o', 'return $o->id;'), $planes);
    return isset($which) ?
      (isset($planes[$which]) ? $planes[$which] : '') :
      $planes;
  }

  public function airports($which = null)
  {
    $airline = $this->wackyAPI->getAirline();

    //grab destination airport codes
    $destinationCodes = array($airline["dest1"], $airline["dest2"], $airline["dest3"]);

    $destinationNames = array();

    //use WackyAPI to grab names of destinations
    foreach ($destinationCodes as $destination) {
      $destination = $this->wackyAPI->getAirport($destination);
      array_push($destinationNames, $destination["airport"]);
    }

    array_push($destinationNames, 'Fort Nelson Airport');

    return isset($which) ?
      (isset($destinationNames[$which]) ? $destinationNames[$which] : '') :
      $destinationNames;
  }


  public function takeofftime($which = null)
  {
    return isset($which) ?
      (isset($this->takeofftimes[$which]) ? $this->takeofftimes[$which] : '') :
      $this->takeofftimes;
  }

  public function getAllPlanes($which = null)
  {
    $planes = $this->wackyAPI->getAirplanes();
    $planeObj = array();
    foreach ($planes as $plane){
      array_push($planeObj, (object) $plane);
    }
    $planeIds = array();

    foreach($planeObj as $plane){
      $planeIds[$plane->id] = $plane->model;
    }

    return isset($which) ?
      (isset($planeIds[$which]) ? $planeIds[$which] : '') :
      $planeIds;
  }

  public function getPlaneInfo($planeId){
    $plane = $this->wackyAPI->getAirplane($planeId);
    return $plane;
  }

  public function validatePlane($plane){
    $limit = 10000;
    $currentValue = $plane->price;
    $currentPlanes = $this->fleets->all();

    foreach ($currentPlanes as $currentPlane){
      $currentValue += $currentPlane->price;
    }

    if($currentValue > $limit){
      return false;
    } else
      return true;

  }


}