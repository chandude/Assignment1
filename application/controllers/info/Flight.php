<?php

class Flight extends Application {
  //put your code here
  public function index() {
    $this->data['pagebody'] = 'flights';
    $this->render();
  }
}