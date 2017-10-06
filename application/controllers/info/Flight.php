<?php

class Flight extends Application {
  //put your code here
      public function index()
    {
       $allFlights = $this->flights->all();
       
       foreach ($allFlights as $flight) {
           $cells[] = $this->parser->parse('_cell', (array) $flight, true);
       }
       $this->load->library('table');
       $parms = array(
           'table_open' => '<table class="gallery">',
           'cell_start' => '<td class="oneimage">',
           'cell_alt_start' => '<td class="oneimage">'
       );
       $this->table->set_template($parms);
       
       $rows = $this->table->make_columns($cells, 1);
       $this->table->set_heading('','ID','Plane','Departing from','Arriving at','Departure time', 'Arrival time');
       $this->data['thetable'] = $this->table->generate($rows);
       
       $this->data['pagebody'] = 'flights';
       $this->render();
    }
}