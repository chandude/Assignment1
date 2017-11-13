<?php
/**
 *  Fleets model providing mock up data for the airline planes
 * @author Chandu Dissanayake
 *
 */

class Fleets extends CSV_Model
{
  protected $returnType = '../entities/Plane';

  public function __construct()
  {
    parent::__construct(APPPATH . '../data/fleet.csv', 'key');
  }
}