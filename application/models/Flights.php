<?php
/**
 * Created by PhpStorm.
 * User: chand
 * Date: 2017-10-06
 * Time: 12:01 PM
 */

class Flights extends CI_Model
{
    var $data = array(
        '1'	 => array(  'id'	 => 'V001',
                        'plane'	 => 'King Vulture I',
                        'departure airport' => 'YYE',
                        'destination' => 'YDL',
                        'departure time' => '0800',
                        'arrival time' => ''),
        '2'	 => array(  'id'	 => 'V002',
                        'plane'	 => 'King Vulture I',
                        'departure airport' => 'YDL',
                        'destination' => 'YXJ',
                        'departure time' => '',
                        'arrival time' => ''),
        '3'	 => array(  'id'	 => 'V003',
                        'plane'	 => 'King Vulture I',
                        'departure airport' => 'YXJ',
                        'destination' => 'YXX',
                        'departure time' => '',
                        'arrival time' => ''),
        '4'	 => array(  'id'	 => 'V004',
                        'plane'	 => 'King Vulture I',
                        'departure airport' => 'YXX',
                        'destination' => 'YYE',
                        'departure time' => '',
                        'arrival time' => ''),
        '5'	 => array(  'id'	 => 'V005',
                        'plane'	 => 'King Vulture II',
                        'departure airport' => 'YYE',
                        'destination' => 'YXX',
                        'departure time' => '',
                        'arrival time' => ''),
        '6'	 => array(  'id'	 => 'V006',
                        'plane'	 => 'King Vulture II',
                        'departure airport' => 'YXX',
                        'destination' => 'YXJ',
                        'departure time' => '',
                        'arrival time' => ''),
        '7'	 => array(  'id'	 => 'V007',
                        'plane'	 => 'King Vulture II',
                        'departure airport' => 'YXJ',
                        'destination' => 'YDL',
                        'departure time' => '',
                        'arrival time' => ''),
        '8'	 => array(  'id'	 => 'V003',
                        'plane'	 => 'King Vulture I',
                        'departure airport' => 'YDL',
                        'destination' => 'YYE',
                        'departure time' => '',
                        'arrival time' => '')
    );






    public function __construct()
    {
        parent::__construct();

        // inject each "record" key into the record itself, for ease of presentation
        foreach ($this->data as $key => $record)
        {
            $record['key'] = $key;
            $this->data[$key] = $record;
        }
    }

	// retrieve a single quote, null if not found
	public function get($which)
    {
        return !isset($this->data[$which]) ? null : $this->data[$which];
    }

	// retrieve all of the quotes
	public function all()
    {
        return $this->data;
    }
}