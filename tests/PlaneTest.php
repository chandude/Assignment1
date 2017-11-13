<?php

use PHPUnit\Framework\TestCase;
require '../application/entities/Plane.php';

class PlaneTest extends TestCase{
    
    private $testPlane;
    
    public function setUp(){
        $this->testPlane = new Plane();
    }
    
    public function testPlaneStringEntity(){
        $setId = $this->testPlane->setId('Condor 2');
        $setManufacturer= $this->testPlane->setManufacturer('Connor Goudie');
        $setModel= $this->testPlane->setModel('Ultra 9000X');
        
        $this->assertTrue($setId);
        $this->assertTrue($setManufacturer);
        $this->assertTrue($setModel);
    }
    
    public function testPlaneIntEntity(){
        $setNumber= $this->testPlane->setNumber(23);
        $setPrice= $this->testPlane->setPrice(1350);
        $setSeats= $this->testPlane->setSeats(300);
        $setReach= $this->testPlane->setReach(4560);
        $setCruise= $this->testPlane->setCruise(3300);
        $setTakeoff= $this->testPlane->setTakeoff(100);
        $setHourly= $this->testPlane->setHourly(1000);
       
        $this->assertTrue($setNumber);
        $this->assertTrue($setPrice);
        $this->assertTrue($setSeats);
        $this->assertTrue($setReach);
        $this->assertTrue($setCruise);
        $this->assertTrue($setTakeoff);
        $this->assertTrue($setHourly);
    }
        
    public function testPlaneEntityIntTooSmallFailure(){
        $setNumber= $this->testPlane->setNumber(0);
        $setPrice= $this->testPlane->setPrice(0);
        $setSeats= $this->testPlane->setSeats(0);
        $setReach= $this->testPlane->setReach(0);
        $setCruise= $this->testPlane->setCruise(0);
        $setTakeoff= $this->testPlane->setTakeoff(0);
        $setHourly= $this->testPlane->setHourly(0);
        
        $this->assertFalse($setNumber);
        $this->assertFalse($setPrice);
        $this->assertFalse($setSeats);
        $this->assertFalse($setReach);
        $this->assertFalse($setCruise);
        $this->assertFalse($setTakeoff);
        $this->assertFalse($setHourly); 
    }
    
    public function testPlaneEntityEmptyStringFailure(){
        $setId = $this->testPlane->setId('');
        $setManufacturer= $this->testPlane->setManufacturer('');
        $setModel= $this->testPlane->setModel('');
        
        $this->assertFalse($setId);
        $this->assertFalse($setManufacturer);
        $this->assertFalse($setModel);
        
    }
    public function testPlaneEntityLongStringFailure(){
        $setId = $this->testPlane->setId('minoritetsladningsbærerdiffusjonskoeffisientmålingsapparatur');
        $setManufacturer= $this->testPlane->setManufacturer('Taumatawhakatangihangakoauauotamateaturipukakapikomaungahoronukupokaiwhenuakitanatahu');
        $setModel= $this->testPlane->setModel('miinibaashkiminasiganibiitoosijiganibadagwiingweshiganibakwezhigan');
        
        $this->assertFalse($setId);
        $this->assertFalse($setManufacturer);
        $this->assertFalse($setModel);   
    }
}

