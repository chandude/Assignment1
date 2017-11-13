<?php
/**
 * Created by PhpStorm.
 * User: chandu
 * Date: 2017-11-09
 * Time: 2:04 PM
 */

require_once 'Entity.php';

class Flight extends Entity
{
    private $id;
    private $plane;
    private $departure;
    private $destination;
    private $departTime;
    private $arriveTime;

    public function setId($id)
    {
        if (is_int($id) && $id>0)
        {
            $this->id = $id;
            return true;
        }
        return false;
    }

    public function setPlane($plane)
    {
        if (preg_match('/^[A-Z0-9 ]+$/i', $plane) && strlen($plane) <= 64) {
            $this->plane = $plane;
            return true;
        }
        return false;
    }

    public function setDeparture($departure)
    {
        if (preg_match('/^[A-Z0-9 ]+$/i', $departure) && strlen($departure) <= 64) {
            $this->departure = $departure;
            return true;
        }
        return false;
    }

    public function setDestination($destination)
    {
        if (preg_match('/^[A-Z0-9 ]+$/i', $destination) && strlen($destination) <= 64) {
            $this->destination = $destination;
            return true;
        }
        return false;
    }

    public function setDepartTime($departTime)
    {
        if (is_int($departTime) && $departTime>800 && $departTime<2200 ) {
            $this->departTime = $departTime;
            return true;
        }
        return false;
    }

    public function setArriveTime($arriveTime)
    {
        if (is_int($arriveTime) && $arriveTime>800 && $arriveTime<2200 ) {
            $this->arriveTime = $arriveTime;
            return true;
        }
        return false;
    }

    public function getId(){
        return $this->id;
    }

    public function getPlane(){
        return $this->plane;
    }

    public function getDeparture(){
        return $this->departure;
    }

    public function getDestination(){
        return $this->destination;
    }

    public function getDepartTime(){
        return $this->departTime;
    }

    public function getArriveTime(){
        return $this->arriveTime;
    }

}