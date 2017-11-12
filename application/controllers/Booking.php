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
    /*$allPlanes = $this->fleets->all();

    foreach ($allPlanes as $plane) {
      $cells[] = $this->parser->parse('_planecell', (array)$plane, true);
    }
    $this->load->library('table');
    $parms = array(
      'table_open' => '<table class="fleet-table">',
    );
    $this->table->set_template($parms);

    $rows = $this->table->make_columns($cells, 1);
    $this->table->set_heading('', 'ID', 'Model', 'Range');
    $this->data['thetable'] = $this->table->generate($rows);*/


    $this->data['pagebody'] = 'booking';

    $flyingTo = $this->session->userdata('flyingTo');
    $flyingFrom = $this->session->userdata('flyingFrom');
    
    $this->data['pagetitle'] = 'Vulture Airlines Flights';
    
    $this->render();
  }

}
