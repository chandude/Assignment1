<?php
/**
 * Created by PhpStorm.
 * User: chand
 * Date: 2017-10-06
 * Time: 12:02 PM
 */

class Fleet extends CI_Model
{

    var $data = array(
        '1'	 => array(  'id'	 => 'King Vulture I',
                        'manufacturer'	 => 'Beechcraft',
                        'model' => 'King Air C90',
                        'price' => '3900',
                        'seats' => '12',
                        'reach' => '2446',
                        'cruise' => '500',
                        'takeoff' => '1402',
                        'hourly' => '990'),
        '2'	 => array(  'id'	 => 'King Vulture II',
                        'manufacturer'	 => 'Beechcraft',
                        'model' => 'King Air C90',
                        'price' => '3900',
                        'seats' => '12',
                        'reach' => '2446',
                        'cruise' => '500',
                        'takeoff' => '1402',
                        'hourly' => '990'),
      /**  '3'	 => array(  'id'	 => 'Baron Von Vulture',
                        'manufacturer'	 => 'Beechcraft',
                        'model' => 'Baron',
                        'price' => '1350',
                        'seats' => '4',
                        'reach' => '1948',
                        'cruise' => '373',
                        'takeoff' => '701',
                        'hourly' => '340'),
       * **/
    );



    // Constructor
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