<?php

/**
 *  Controller for the flight view at /flight
 *
 * @author Connor Goudie
 */
class Flight extends Application
{

  /**
   * Fetches data from the Flights model and adds it to a table to be rendered in the template
   */
  public function index()
  {
    $allFlights = $this->flights->all();

    foreach ($allFlights as $flight) {
      $cells[] = $this->parser->parse('_cell', (array)$flight, true);
    }
    $this->load->library('table');
    $parms = array(
      'table_open' => '<table class="flight-table">'
    );
    $this->table->set_template($parms);

    $rows = $this->table->make_columns($cells, 1);
    $this->table->set_heading('Departing from', 'Arriving at', 'Departure time', 'Arrival time');
    $this->data['thetable'] = $this->table->generate($rows);


    $this->data['pagetitle'] = 'Vulture Airlines Flights';
    $this->data['pagebody'] = 'flights';
    $this->render();
  }
}