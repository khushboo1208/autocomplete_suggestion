<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Rest {

    public function __construct() {
        parent::__construct();
    }

    public function hotelList_get()
    {
        $string = $this->get('string');

        if(!empty($string)) {
            $this->load->model('hotel');
            $response = $this->hotel->getHotels($string);
            if(empty($response)) {
                $data = array(
                    'success' => false,
                    'message' => 'Not found'
                );
            }
            else {
                $data = array(
                    'success' => true,
                    'list' => $response
                );
            }
            $this->response($data);
        }
        else {
            $this->response(array(
                'success' => false,
                'message' => 'No input'
            ));
        }
    }
}
