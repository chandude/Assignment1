<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bookings
 *
 * @author Connor
 */
class Bookings extends CSV_Model {

        public function __construct()
        {
            parent::__construct(APPPATH . '../data/tofortnelson.csv', 'id');
        }

}