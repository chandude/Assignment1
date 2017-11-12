<?php

use PHPUnit\Framework\TestCase;
require '../application/entities/Plane.php';

class PlaneTest extends TestCase{
    
    private $testTask;
    
    public function setUp(){
        $this->testTast = new Task();
    }
    
    public function testPlaneStringEntity(){
        $setId = $this->testTask->setId('Condor 2');
        $setManufacturer= $this->testTask->$setManufacturer('Connor Goudie');
        $setModel= $this->testTask->$setModel('Ultra 9000X');
        
        $this->assertTrue($setId);
        $this->assertTrue($setManufacturer);
        $this->assertTrue($setModel);
    }
    
    public function testPlaneIntEntity(){
        $setNumber= $this->testTask->$setNumber(23);
        $setPrice= $this->testTask->$setPrice(1350);
        $setSeats= $this->testTask->$setSeats(300);
        $setReach= $this->testTask->$setReach(4560);
        $setCruise= $this->testTask->$setCruise(3300);
        $setTakeoff= $this->testTask->$setTakeoff();
        $setHourly= $this->testTask->$setHourly();
       
        $this->assertTrue($setNumber);
        $this->assertTrue($setPrice);
        $this->assertTrue($setSeats);
        $this->assertTrue($setReach);
        $this->assertTrue($setCruise);
        $this->assertTrue($setTakeoff);
        $this->assertTrue($setHourly);
    }
        
    public function testPlaneEntityIntTooSmallFailure(){
        $setNumber= $this->testTask->$setNumber(0);
        $setPrice= $this->testTask->$setPrice(0);
        $setSeats= $this->testTask->$setSeats(0);
        $setReach= $this->testTask->$setReach(0);
        $setCruise= $this->testTask->$setCruise(0);
        $setTakeoff= $this->testTask->$setTakeoff(0);
        $setHourly= $this->testTask->$setHourly(0);
        
        $this->assertFalse($setNumber);
        $this->assertFalse($setPrice);
        $this->assertFalse($setSeats);
        $this->assertFalse($setReach);
        $this->assertFalse($setCruise);
        $this->assertFalse($setTakeoff);
        $this->assertFalse($setHourly); 
    }
    
    public function testPlaneEntityEmptyStringFailure(){
        $setId = $this->testTask->setId('');
        $setManufacturer= $this->testTask->$setManufacturer('');
        $setModel= $this->testTask->$setModel('');
        
        $this->assertFalse($setId);
        $this->assertFalse($setManufacturer);
        $this->assertFalse($setModel);
        
    }
    public function testPlaneEntityLongStringFailure(){
        $setId = $this->testTask->setId('minoritetsladningsbærerdiffusjonskoeffisientmålingsapparatur');
        $setManufacturer= $this->testTask->$setManufacturer('Taumatawhakatangihangakoauauotamateaturipukakapikomaungahoronukupokaiwhenuakitanatahu');
        $setModel= $this->testTask->$setModel('miinibaashkiminasiganibiitoosijiganibadagwiingweshiganibakwezhigan');
        
        $this->assertFalse($setId);
        $this->assertFalse($setManufacturer);
        $this->assertFalse($setModel);   
    }
}

