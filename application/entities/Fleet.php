<?php
/**
 * Created by PhpStorm.
 * User: chandu
 * Date: 2017-11-09
 * Time: 2:03 PM
 */

require_once 'Entity.php';

class Fleet extends Entity
{
    private $id;
    private $number;
    private $manufacturer;
    private $model;
    private $price;
    private $seats;
    private $reach;
    private $cruise;
    private $takeoff;
    private $hourly;

    public function setId($id){

        if (preg_match('/^[A-Z0-9 ]+$/i', $id) && strlen($id) <= 64) {
            $this->id = $id;
            return true;
        }
        return false;
    }

    public function setManufacturer($manufacturer){

        if (preg_match('/^[A-Z0-9 ]+$/i', $manufacturer) && strlen($manufacturer) <= 64) {
            $this->manufacturer = $manufacturer;
            return true;
        }
        return false;
    }

    public function setModel($model){

        if (preg_match('/^[A-Z0-9 ]+$/i', $model) && strlen($model) <= 64) {
            $this->model = $model;
            return true;
        }
        return false;
    }

    public function setNumber($number)
    {
        if (is_int($number) && $number>0)
        {
            $this->number = $number;
            return true;
        }
        return false;
    }

    public function setPrice($price)
    {
        if (is_int($price) && $price>0)
        {
            $this->price = $price;
            return true;
        }
        return false;
    }
    public function setSeats($seats)
    {
        if (is_int($seats) && $seats>0 )
        {
            $this->seats = $seats;
            return true;
        }
        return false;
    }

    public function setReach($reach)
    {
        if (is_int($reach) && $reach>0)
        {
            $this->reach = $reach;
            return true;
        }
        return false;
    }

    public function setCruise($cruise)
    {
        if (is_int($cruise) && $cruise>0)
        {
            $this->cruise = $cruise;
            return true;
        }
        return false;
    }

    public function setTakeoff($takeoff)
    {
        if (is_int($takeoff) && $takeoff>0)
        {
            $this->takeoff = $takeoff;
            return true;
        }
        return false;
    }

    public function setHourly($hourly)
    {
        if (is_int($hourly) && $hourly>0)
        {
            $this->hourly = $hourly;
            return true;
        }
        return false;
    }

    public function getId(){
        return $this->id;
    }

    public function getNumber(){
        return $this->number;
    }

    public function getManufacturer(){
        return $this->manufacturer;
    }
    public function getModel(){
        return $this->model;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getSeats(){
        return $this->seats;
    }
    public function getReach(){
        return $this->reach;
    }
    public function getCruise(){
        return $this->cruise;
    }
    public function getTakeoff(){
        return $this->takeoff;
    }
    public function getHourly(){
        return $this->hourly;
    }
}