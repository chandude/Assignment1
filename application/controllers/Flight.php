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
    $role = $this->session->userdata('userrole');
    $allFlights = $this->flights->all();
    $cells = '';

    foreach ($allFlights as $flight) {
      if ($role = ROLE_OWNER)
        $cells .= $this->parser->parse('_cellx', (array)$flight, true);
      else
        $cells .= $this->parser->parse('_cell', (array)$flight, true);
    }

    $this->data['thetable'] = $cells;

    if ($role == ROLE_OWNER)
      $this->data['flightadd'] = $this->parser->parse('flightadd', [], true);
    else
      $this->data['flightadd'] = '';

    $this->data['pagetitle'] = 'Vulture Airlines Flights' . ' (' . $role . ')';
    $this->data['pagebody'] = 'flights';
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
    //This should have fields for flight name, Plane drop down, from and to drop down, take off time, landing should be calculated?
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
    $flight = $this->flights->create();
    $this->session->set_userdata('flight', $flight);
    $this->showit();
  }

  // initiate editing of a task
  public function edit($id = null)
  {
    if ($id == null)
      redirect('/flight');
    $flight = $this->flights->get($id);
    $this->session->set_userdata('flight', $flight);
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
    $this->form_validation->set_rules($this->flights->rules());

    // retrieve & update data transfer buffer
    $flight = (array)$this->session->userdata('flight');
    $flight = array_merge($flight, $this->input->post());
    $flight = (object)$flight;  // convert back to object
    $this->session->set_userdata('flight', (object)$flight);

    // validate away
    if ($this->form_validation->run()) {
      if (empty($flight->id)) {
        $flight->id = $this->flights->highest() + 1;
        $this->tasks->add($flight);
        $this->alert('Task ' . $flight->id . ' added', 'success');
      } else {
        $this->tasks->update($flight);
        $this->alert('Task ' . $flight->id . ' updated', 'success');
      }
    } else {
      $this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
    }
    $this->showit();
  }

  function cancel()
  {
    $this->session->unset_userdata('flight');
    redirect('/flight');
  }

  function delete()
  {
    $dto = $this->session->userdata('flight');
    $flight = $this->tasks->get($dto->id);
    $this->flights->delete($flight->id);
    $this->session->unset_userdata('flight');
    redirect('/flight');
  }
}