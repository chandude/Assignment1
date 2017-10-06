<?php

class Fleet extends Application {
  //put your code here
  public function index() {
    $this->data['pagebody'] = 'fleet';
    $this->render();
  }
}