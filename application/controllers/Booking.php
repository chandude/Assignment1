<?php

/**
 * Description of Booking
 *
 * @author Connor
 */
class Booking extends Application 
{
    //put your code here
      public function index()
  {
    $this->load->library('table');
    $flyingTo = $this->session->userdata('flyingTo');
    $flyingFrom = $this->session->userdata('flyingFrom');
    
    $allBookings = $this->bookings->all();
    
    foreach ($allBookings as $flight) {
        $temp = (array)$flight;
        $from = $temp['flyingfrom'];
        $to = $temp['flyingto'];
        $cells[] = array();
       if (strcmp($from, $flyingFrom) == 0 && strcmp($to, $flyingTo) == 0)
        {
          $cells[] = (strcmp($from, $flyingFrom) == 0 && strcmp($to, $flyingTo) == 0) ? $this->parser->parse('_bookingcell', (array)$flight, true) : null;
          //$cells[] = $this->parser->parse('_bookingcell', (array)$flight, true);
        }   
    }
    $parms = array(
      'table_open' => '<table class="flight-table">'
    );
    
    $this->table->set_template($parms);
    $rows = $this->table->make_columns($cells, 1);
    
    $this->table->set_heading("Flying From","Departure Time","Connecting Flight From","Connecting Arrival Time","Flying To","Connecting Departure Time","Arrival Time");
    $this->data['thetable'] = $this->table->generate($rows);

    $this->data['pagebody'] = 'booking';
    $this->data['pagetitle'] = 'Vulture Airlines Flights';
    
    $this->render();
  }

}
