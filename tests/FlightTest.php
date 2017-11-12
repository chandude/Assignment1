<?php

use PHPUnit\Framework\TestCase;
require '../application/entities/Flight.php';

class FlightTest extends TestCase { 
    private $testTask;
    
    public function setUp(){
        $this->testTast = new Task();
    }
    
    public function testFlightEntity(){
        $setId = $this->testTask->setId(4);
        $setPlane = $this->testTask->setPlane('Condor3000');
        $setDeparture = $this->testTask->setDeparture('Vancouver');
        $setDestination = $this->testTask->setDestination('Prince Rupert');
        $setDepartTime = $this->testTask->setDepartTime(1000);
        $setArriveTime = $this->testTask->setArriveTime(2200);
              
        $this->assertTrue($setId);
        $this->assertTrue($setPlane);
        $this->assertTrue($setDeparture);
        $this->assertTrue($setDestination);
        $this->assertTrue($setDepartTime);
        $this->assertTrue($setArriveTime);
    }
    
    public function testFlightEntityEmptyStringFailure(){
        $setPlane = $this->testTask->setPlane('');
        $setDeparture = $this->testTask->setDeparture('');
        $setDestination = $this->testTask->setDestination('');
        
        $this->assertFalse($setPlane);
        $this->assertFalse($setDeparture);
        $this->assertFalse($setDestination);
    }
    
    public function testFlightEntityLongStringFailure(){
        //longest word in Norwegian. Means "(a) device for measuring the distance between particles in a crystal"
        $setPlane = $this->testTask->setPlane('minoritetsladningsbærerdiffusjonskoeffisientmålingsapparatur');
        //longest word in Maori. Means "The summit where Tamatea, the man with the big knees, the slider, climber of mountains, the land-swallower who travelled about, played his nose flute to his loved one".
        $setDeparture = $this->testTask->setDeparture('Taumatawhakatangihangakoauauotamateaturipukakapikomaungahoronukupokaiwhenuakitanatahu');
        //longest word in Ojibwe. Means blueberry pie
        $setDestination = $this->testTask->setDestination('miinibaashkiminasiganibiitoosijiganibadagwiingweshiganibakwezhigan');
        
        $this->assertFalse($setPlane);
        $this->assertFalse($setDeparture);
        $this->assertFalse($setDestination);
    }
    
    public function testFlightEntitySmallIntFailure(){
        $setId = $this->testTask->setId(0);
        $setDepartTime = $this->testTask->setDepartTime(600);
        $setArriveTime = $this->testTask->setArriveTime(500);
        
        $this->assertFalse($setId);
        $this->assertFalse($setDepartTime);
        $this->assertFalse($setArriveTime);
    }
    
    public function testFlightEntityBigIntFailure(){ 
        $setDepartTime = $this->testTask->setDepartTime(2300);
        $setArriveTime = $this->testTask->setArriveTime(2400);

        $this->assertFalse($setDepartTime);
        $this->assertFalse($setArriveTime);
    }  
}


