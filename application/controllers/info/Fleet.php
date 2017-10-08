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
    );
    $this->table->set_template($parms);

    $rows = $this->table->make_columns($cells, 1);
    $this->table->set_heading('', 'ID', 'Model', 'Range');
    $this->data['thetable'] = $this->table->generate($rows);


    $this->data['pagetitle'] = 'Vulture Airlines Fleet';
    $this->data['pagebody'] = 'fleet';
    $this->render();
  }

  public function plane($id) {
    $plane = $this->fleets->get($id);
    $cells[] = $this->parser->parse('_planedetail', (array)$plane, true);
    $this->load->library('table');
    $parms = array(
      'table_open' => '<table class="plane-table">',
    );
    $this->table->set_template($parms);
    $rows = $this->table->make_columns($cells, 1);
    $this->data['thetable'] = $this->table->generate($rows);
    $this->data['pagetitle'] = 'Vulture Airlines Fleet';
    $this->data['pagebody'] = 'plane';
    $this->render();
  }
}