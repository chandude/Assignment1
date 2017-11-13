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



  //TODO: Edit the form with the proper fields
  //TODO: Add the validation rules
  private function showit()
  {
    $this->load->helper('form');
    $task = $this->session->userdata('task');
    $this->data['id'] = $task->id;

    // if no errors, pass an empty message
    if (!isset($this->data['error']))
      $this->data['error'] = '';

    //FIXME: Find proper fields
    //This should only have a single drop down with plane name and single field with plane name and add it to the CSV
    $fields = array(
      'ftask' => form_label('Task description') . form_input('task', $task->task),
      'fpriority' => form_label('Priority') . form_dropdown('priority', $this->app->priority(), $task->priority),
      'fsize' => form_label('Size') . form_dropdown('size', $this->app->size(), $task->size),
      'fgroup' => form_label('Group') . form_dropdown('group', $this->app->group(), $task->group),
      'fstatus' => form_label('Status') . form_dropdown('status', $this->app->status(), $task->status),
      'zsubmit' => form_submit('submit', 'Update the TODO task'),
    );
    $this->data = array_merge($this->data, $fields);

    $this->data['pagebody'] = 'itemedit';
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
    // setup for validation
    $this->load->library('form_validation');
    $this->form_validation->set_rules($this->fleets->rules());

    // retrieve & update data transfer buffer
    $plane = (array)$this->session->userdata('fleet');
    $plane = array_merge($plane, $this->input->post());
    $plane = (object)$plane;  // convert back to object
    $this->session->set_userdata('fleet', (object)$plane);

    // validate away
    if ($this->form_validation->run()) {
      if (empty($plane->id)) {
        $plane->id = $this->flights->highest() + 1;
        $this->tasks->add($plane);
        $this->alert('Task ' . $plane->id . ' added', 'success');
      } else {
        $this->tasks->update($plane);
        $this->alert('Task ' . $plane->id . ' updated', 'success');
      }
    } else {
      $this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
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
    $plane = $this->tasks->get($dto->id);
    $this->fleets->delete($plane->id);
    $this->session->unset_userdata('fleet');
    redirect('/fleet');
  }
}