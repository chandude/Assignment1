<?php

/**
 *  Controller for the fleet view at /fleet
 *
 * @author Stephanie Cosacescu, Harman Mahal
 */

class Fleet extends Application
{
  /**
   * Fetches data from the Fleet model and adds it to a table to be rendered in the template
   */
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

  /**
   * @param $id The key for the plane to be displayed in the plane view
   * Plane subcontroller used to display the plane details for the `plane` view
   */
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