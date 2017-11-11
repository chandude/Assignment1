<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WackyAPI extends CI_Model {
    
    function getAirplanes() {
        $response = file_get_contents('https://wacky.jlparry.com/info/airplanes');
        return $response;
    }
    
    function getAirports(){
        $response = file_get_contents('https://wacky.jlparry.com/info/airports');
        return $response;
    }
    
    function getAirlines(){
        $response = file_get_contents('https://wacky.jlparry.com/info/airlines');
        return $response;
    }
    
    function getRegions(){
        $response = file_get_contents('https://wacky.jlparry.com/info/regions');
        return $response;
    }
    
}