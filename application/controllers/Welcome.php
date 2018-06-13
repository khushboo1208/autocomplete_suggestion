<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        if($this->input->is_ajax_request()) {
            $string = $this->input->post('string');
            if(!empty($string)) {
                $this->load->model('hotel');
                $response = $this->hotel->getHotels($string);
                if(empty($response)) {
                    $data = array(
                        'success' => false,
                        'message' => 'No response'
                    );
                }
                else {
                    $data = array(
                        'success' => true,
                        'list' => $response
                    );
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            else {
                $this->output->set_output(json_encode(array(
                    'success' => false,
                    'message' => 'No input'
                )));
            }
        }
        else {
            $this->load->view('search');
        }
    }
}
