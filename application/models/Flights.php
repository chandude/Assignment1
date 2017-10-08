<?php
/**
 *  Flights model providing mock up data for the airline flights
 *  @author Chandu Dissanayake, Stephanie Cosacescu
 *
 */


class Flights extends CI_Model
{
  // Flight data for all flights scheduled by Vulture Airlines
  var $data = array(
    //PLANE 1 FLIGHTS : CONDOR I
    '1' => array('id' => 'V001',
      'plane' => 'Condor I',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Dease Lake Airport',
      'departure time' => '0800',
      'arrival time' => '0930'),
    '2' => array('id' => 'V002',
      'plane' => 'Condor I',
      'departure airport' => 'Dease Lake Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1000',
      'arrival time' => '1130'),
    '3' => array('id' => 'V003',
      'plane' => 'Condor I',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Dease Lake Airport',
      'departure time' => '1230',
      'arrival time' => '130'),
    '4' => array('id' => 'V004',
      'plane' => 'Condor I',
      'departure airport' => 'Dease Lake Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1400',
      'arrival time' => '1530'),
    '5' => array('id' => 'V005',
      'plane' => 'Condor I',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Dease Lake Airport',
      'departure time' => '1600',
      'arrival time' => '1730'),
    '6' => array('id' => 'V006',
      'plane' => 'Condor I',
      'departure airport' => 'Dease Lake Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1800',
      'arrival time' => '1930'),
    // PLANE 2 FLIGHTS: CONDOR II
    '7' => array('id' => 'V007',
      'plane' => 'Condor II',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Fort St. John Airport',
      'departure time' => '0800',
      'arrival time' => '0900'),
    '8' => array('id' => 'V008',
      'plane' => 'Condor II',
      'departure airport' => 'Fort St. John Airport',
      'destination' => 'Abbotsford Airport',
      'departure time' => '0930',
      'arrival time' => '1200'),
    '9' => array('id' => 'V009',
      'plane' => 'Condor II',
      'departure airport' => 'Abbotsford Airport',
      'destination' => 'Fort St. John Airport',
      'departure time' => '1230',
      'arrival time' => '1500'),
    '10' => array('id' => 'V010',
      'plane' => 'Condor II',
      'departure airport' => 'Fort St. John Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1530',
      'arrival time' => '1630'),
    '11' => array('id' => 'V011',
      'plane' => 'Condor II',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Fort St. John Airport',
      'departure time' => '1700',
      'arrival time' => '1800'),
    '12' => array('id' => 'V012',
      'plane' => 'Condor II',
      'departure airport' => 'Fort St. John Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1830',
      'arrival time' => '1930'),
    //PLANE 3: CONDOR III
    '13' => array('id' => 'V013',
      'plane' => 'Condor III',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Fort St. John Airport',
      'departure time' => '0900',
      'arrival time' => '1000'),
    '14' => array('id' => 'V014',
      'plane' => 'Condor III',
      'departure airport' => 'Fort St. John Airport',
      'destination' => 'Abbotsford Airport',
      'departure time' => '1030',
      'arrival time' => '1300'),
    '15' => array('id' => 'V015',
      'plane' => 'Condor III',
      'departure airport' => 'Abbotsford Airport',
      'destination' => 'Fort St. John Airport',
      'departure time' => '1330',
      'arrival time' => '1600'),
    '16' => array('id' => 'V016',
      'plane' => 'Condor III',
      'departure airport' => 'Fort St. John Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1630',
      'arrival time' => '1730'),
    '17' => array('id' => 'V017',
      'plane' => 'Condor III',
      'departure airport' => 'Fort Nelson Airport',
      'destination' => 'Fort St. John Airport',
      'departure time' => '1800',
      'arrival time' => '1900'),
    '18' => array('id' => 'V018',
      'plane' => 'Condor III',
      'departure airport' => 'Fort St. John Airport',
      'destination' => 'Fort Nelson Airport',
      'departure time' => '1930',
      'arrival time' => '2030')

  );


  public function __construct()
  {
    parent::__construct();

    // inject each "record" key into the record itself, for ease of presentation
    foreach ($this->data as $key => $record) {
      $record['key'] = $key;
      $this->data[$key] = $record;
    }
  }

  // retrieve a single flight, null if not found
  public function get($which)
  {
    return !isset($this->data[$which]) ? null : $this->data[$which];
  }

  // retrieve all of the flights
  public function all()
  {
    return $this->data;
  }
}