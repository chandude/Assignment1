<?php

class Fleet extends Application {
  //put your code here
public function index()
    {
       $allPlanes = $this->fleets->all();
       
       foreach ($allPlanes as $plane) {
           $cells[] = $this->parser->parse('_planecell', (array) $plane, true);
       }
       $this->load->library('table');
       $parms = array(
           'table_open' => '<table class="gallery">',
           'cell_start' => '<td class="oneimage">',
           'cell_alt_start' => '<td class="oneimage">'
       );
       $this->table->set_template($parms);
       
       $rows = $this->table->make_columns($cells, 1);
       $this->table->set_heading('','ID','Model','Range');
       $this->data['thetable'] = $this->table->generate($rows);
       
       $this->data['pagebody'] = 'fleet';
       $this->render();
    }
}