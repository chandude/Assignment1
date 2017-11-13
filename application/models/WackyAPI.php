<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WackyAPI extends CI_Model
{

  function getAirplanes()
  {
    $response = $this->curl('https://wacky.jlparry.com/info/airplanes');
    $planes = json_decode($response, TRUE);
    return $planes;
  }

  function getAirplane($plane)
  {
    $response = $this->curl('https://wacky.jlparry.com/info/airplanes/' . $plane);
    $planes = json_decode($response, TRUE);
    return $planes;
  }

  function getAirports()
  {
    $response = $this->curl('https://wacky.jlparry.com/info/airports');
    $airports = json_decode($response, TRUE);
    return $airports;
  }

  function getAirport($airport)
  {
    $response = $this->curl('https://wacky.jlparry.com/info/airports/' . $airport);
    $airport = json_decode($response, TRUE);
    return $airport;
  }

  function getAirline()
  {
    $response = $this->curl('https://wacky.jlparry.com/info/airlines/vulture');
    $airline = json_decode($response, TRUE);
    return $airline;
  }

  function getRegions()
  {
    $response = $this->curl('https://wacky.jlparry.com/info/regions');
    $regions = json_decode($response, TRUE);
    return $regions;
  }

  function curl($url)
  {
    // create curl resource
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, $url);
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output contains the output string
    $output = curl_exec($ch);
    // close curl resource to free up system resources
    curl_close($ch);
    return $output;
  }

}