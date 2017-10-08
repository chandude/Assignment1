<?php
/**
 * Created by PhpStorm.
 * User: chand
 * Date: 2017-10-06
 * Time: 12:02 PM
 */

class Fleets extends CI_Model
{

  var $data = array(
    '1' => array('id' => 'Condor I',
      'number' => '1',
      'manufacturer' => 'Cessna',
      'model' => 'Grand Caravan EX',
      'price' => '2300',
      'seats' => '14',
      'reach' => '1689',
      'cruise' => '340',
      'takeoff' => '660',
      'hourly' => '389'),
    '2' => array('id' => 'Condor II',
      'number' => '2',
      'manufacturer' => 'Cessna',
      'model' => 'Grand Caravan EX',
      'price' => '2300',
      'seats' => '14',
      'reach' => '1689',
      'cruise' => '340',
      'takeoff' => '660',
      'hourly' => '389'),
    '3' => array('id' => 'Condor III',
      'number' => '3',
      'manufacturer' => 'Cessna',
      'model' => 'Grand Caravan EX',
      'price' => '2300',
      'seats' => '14',
      'reach' => '1689',
      'cruise' => '340',
      'takeoff' => '660',
      'hourly' => '389')
  );


  // Constructor
  public function __construct()
  {
    parent::__construct();

    // inject each "record" key into the record itself, for ease of presentation
    foreach ($this->data as $key => $record) {
      $record['key'] = $key;
      $this->data[$key] = $record;
    }
  }

  // retrieve a single quote, null if not found
  public function get($which)
  {
    return !isset($this->data[$which]) ? null : $this->data[$which];
  }

  // retrieve all of the quotes
  public function all()
  {
    return $this->data;
  }
}