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

  private function showit()
  {
    $this->load->helper('form');
    $flight = $this->session->userdata('flight');
    $this->data['id'] = $flight->id;

    // if no errors, pass an empty message
    if (!isset($this->data['error']))
      $this->data['error'] = '';

    //This should have fields for flight name, Plane drop down, from and to drop down, take off time, landing should be calculated?
    $fields = array(
      'fid' => form_label('Flight ID') . form_input('id', $flight->id),
      'fplane' => form_label('Plane') . form_dropdown('plane', $this->app->plane(), $flight->plane),
      'fto' => form_label('Destination') . form_dropdown('destination', $this->app->airports(), $flight->destination),
      'ffrom' => form_label('Departure Airport') . form_dropdown('departure', $this->app->airports(), $flight->departure),
      'ftakeoff' => form_label('Departure Time') . form_input('departTime', $flight->departTime),
      'flanding' => form_label('Landing Time') . form_input('arrivalTime', $flight->arrivalTime),
      'zsubmit' => form_submit('submit', 'Update the Flight details'),
    );
    $this->data = array_merge($this->data, $fields);

    $this->data['pagebody'] = 'flightedit';
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
    // retrieve & update data transfer buffer
    $flight = (array)$this->session->userdata('flight');
    $flight = array_merge($flight, $this->input->post());
    $flight = (object)$flight;  // convert back to object
    $this->session->set_userdata('flight', (object)$flight);

    // validate away
    if ($this->app->validateFlight($flight)) {
      if (empty($flight->key)) {
        $flight->key = $this->flights->highest() + 1;
        $this->flights->add($flight);
        $this->alert('Flight ' . $flight->id . ' added', 'success');
      } else {
        $this->flights->update($flight);
        $this->alert('Flight ' . $flight->id . ' updated', 'success');
      }
    } else {
      print_r($flight);
      $this->alert('<strong>Validation errors!<strong><br>' . 'Invalid flight details, danger');
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
    $flight = $this->flights->get($dto->id);
    $this->flights->delete($flight->id);
    $this->session->unset_userdata('flight');
    redirect('/flight');
  }
}