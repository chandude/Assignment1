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
    $role = $this->session->userdata('userrole');
    $allPlanes = $this->fleets->all();
    $cells = '';
    foreach ($allPlanes as $plane) {
      if ($role == ROLE_OWNER)
        $cells .= $this->parser->parse('_planecellx', (array)$plane, true);
      else
        $cells .= $this->parser->parse('_planecell', (array)$plane, true);
    }

    $this->data['thetable'] = $cells;
    $this->data['pagebody'] = 'fleet';
    if ($role == ROLE_OWNER)
      $this->data['addplane'] = $this->parser->parse('fleetadd', [], true);
    else
      $this->data['addplane'] = '';

    $this->data['pagetitle'] = 'Vulture Airlines Fleet' . ' (' . $role . ')';
    $this->render();
  }

  /**
   * @param $id The key for the plane to be displayed in the plane view
   * Plane subcontroller used to display the plane details for the `plane` view
   */
  public function plane($id)
  {
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

  private function showit()
  {
    $this->load->helper('form');
    $plane = $this->session->userdata('fleet');
    $this->data['id'] = $plane->id;

    // if no errors, pass an empty message
    if (!isset($this->data['error']))
      $this->data['error'] = '';

    //This should only have a single drop down with plane name and single field with plane name and add it to the CSV
    $fields = array(
      'fid' => form_label('Task description') . form_input('id', $plane->id),
      'fplaneId' => form_label('Plane Model') . form_dropdown('planeId', $this->app->getAllPlanes(), $plane->planeId),
      'zsubmit' => form_submit('submit', 'Update the Plane Info'),
    );
    $this->data = array_merge($this->data, $fields);

    $this->data['pagebody'] = 'fleetedit';
    $this->render();
  }

  // Initiate adding a new task
  public function add()
  {
    $plane = $this->fleets->create();
    $this->session->set_userdata('fleet', $plane);
    $this->showit();
  }

  // initiate editing of a task
  public function edit($id = null)
  {
    if ($id == null)
      redirect('/fleet');
    $plane = $this->fleets->get($id);
    $this->session->set_userdata('fleet', $plane);
    $this->showit();
  }

  // build a suitable error mesage
  private function alert($message)
  {
    $this->load->helper('html');
    $this->data['error'] = heading($message, 3);
  }

// handle form submission
  public function submit()
  {
    // retrieve & update data transfer buffer
    $post = $this->input->post();
    $plane = (array)$this->session->userdata('fleet');
    $planeInfo = $this->app->getPlaneInfo($post['planeId']);
    unset($planeInfo->id);

    $planeInfo = array_merge((array)$planeInfo, $post);
    $plane = array_merge($plane, $planeInfo);
    $plane = (object)$plane;  // convert back to object
    $this->session->set_userdata('fleet', (object)$plane);

    // validate away
    if ($this->app->validatePlane($plane)) {
      if (empty($plane->key)) {
        $plane->key = $this->fleets->highest() + 1;
        $this->fleets->add($plane);
        $this->alert('Plane ' . $plane->id . ' added', 'success');
      } else {
        $this->fleets->update($plane);
        $this->alert('Plane ' . $plane->id . ' updated', 'success');
      }
    } else {
      $this->alert('<strong>Validation errors!<strong><br>' . 'The plane is over budget, danger');
    }

    $this->showit();
  }

  function cancel()
  {
    $this->session->unset_userdata('fleet');
    redirect('/fleet');
  }

  function delete()
  {
    $dto = $this->session->userdata('fleet');
    $plane = $this->fleets->get($dto->key);
    $this->fleets->delete($plane->key);
    $this->session->unset_userdata('fleet');
    redirect('/fleet');
  }
}