<?php
/**
 *  Flights model providing mock up data for the airline flights
 *  @author Chandu Dissanayake, Stephanie Cosacescu
 *
 */


class Flights extends CSV_Model
{

  public function __construct()
  {
    parent::__construct(APPPATH . '../data/flights.csv', 'id');
  }

}