<?php

use PHPUnit\Framework\TestCase;
require '../application/entities/Flight.php';

class FlightTest extends TestCase { 
    private $testFlight;
    
    public function setUp(){
        $this->testFlight = new Flight();
    }
    
    public function testFlightEntity(){
        $setId = $this->testFlight->setId(4);
        $setPlane = $this->testFlight->setPlane('Condor3000');
        $setDeparture = $this->testFlight->setDeparture('Vancouver');
        $setDestination = $this->testFlight->setDestination('Prince Rupert');
        $setDepartTime = $this->testFlight->setDepartTime(1000);
        $setArriveTime = $this->testFlight->setArriveTime(2100);
              
        $this->assertTrue($setId);
        $this->assertTrue($setPlane);
        $this->assertTrue($setDeparture);
        $this->assertTrue($setDestination);
        $this->assertTrue($setDepartTime);
        $this->assertTrue($setArriveTime);
    }
    
    public function testFlightEntityEmptyStringFailure(){
        $setPlane = $this->testFlight->setPlane('');
        $setDeparture = $this->testFlight->setDeparture('');
        $setDestination = $this->testFlight->setDestination('');
        
        $this->assertFalse($setPlane);
        $this->assertFalse($setDeparture);
        $this->assertFalse($setDestination);
    }
    
    public function testFlightEntityLongStringFailure(){
        //longest word in Norwegian. Means "(a) device for measuring the distance between particles in a crystal"
        $setPlane = $this->testFlight->setPlane('minoritetsladningsbærerdiffusjonskoeffisientmålingsapparatur');
        //longest word in Maori. Means "The summit where Tamatea, the man with the big knees, the slider, climber of mountains, the land-swallower who travelled about, played his nose flute to his loved one".
        $setDeparture = $this->testFlight->setDeparture('Taumatawhakatangihangakoauauotamateaturipukakapikomaungahoronukupokaiwhenuakitanatahu');
        //longest word in Ojibwe. Means blueberry pie
        $setDestination = $this->testFlight->setDestination('miinibaashkiminasiganibiitoosijiganibadagwiingweshiganibakwezhigan');
        
        $this->assertFalse($setPlane);
        $this->assertFalse($setDeparture);
        $this->assertFalse($setDestination);
    }
    
    public function testFlightEntitySmallIntFailure(){
        $setId = $this->testFlight->setId(0);
        $setDepartTime = $this->testFlight->setDepartTime(600);
        $setArriveTime = $this->testFlight->setArriveTime(500);
        
        $this->assertFalse($setId);
        $this->assertFalse($setDepartTime);
        $this->assertFalse($setArriveTime);
    }
    
    public function testFlightEntityBigIntFailure(){ 
        $setDepartTime = $this->testFlight->setDepartTime(2300);
        $setArriveTime = $this->testFlight->setArriveTime(2400);

        $this->assertFalse($setDepartTime);
        $this->assertFalse($setArriveTime);
    }  
}


