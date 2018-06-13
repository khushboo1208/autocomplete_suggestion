<?php

class Hotel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getHotels($input='')
    {
        if($input == '') {
            return false;
        }

        $this->load->database();

        $data = $this->db->select(array('name','address','city','state','country'))->like('name',$input)->or_like('address',$input)->or_like('city',$input)->or_like('state',$input)->or_like('country',$input)->limit(5)->get('hotel')->result_array();

        $this->db->close();
        return $data;
    }

}