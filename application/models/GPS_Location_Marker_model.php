<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GPS_Location_Marker_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

    }

    public function add_drawing($data){
        if(empty($data)){
            return false;
        }

        return $this ->db->insert('gps_location_marker',$data);
    }
}