<?php

class Fleet extends Application
{
  public function index()
  {
    $allPlanes = $this->fleets->all();

    foreach ($allPlanes as $plane) {
      $cells[] = $this->parser->parse('_planecell', (array)$plane, true);
    }
    $this->load->library('table');
    $parms = array(
      'table_open' => '<table class="fleet-table">',
      'cell_start' => '<td class="planedetail">',
      'cell_alt_start' => '<td class="oneimage">'
    );
    $this->table->set_template($parms);

    $rows = $this->table->make_columns($cells, 1);
    $this->table->set_heading('', 'ID', 'Model', 'Range');
    $this->data['thetable'] = $this->table->generate($rows);


    $this->data['pagetitle'] = 'Vulture Airlines Fleet';
    $this->data['pagebody'] = 'fleet';
    $this->render();
  }
}