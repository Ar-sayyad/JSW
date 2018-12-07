<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class portPerformance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();        	
        $this->load->library('session');
	$this->load->library('form_validation');
        $this->load->model('jsw_model');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
         /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
        
       public function index()
	{
            $data['title'] = "Port Performance";
            $data['icons'] = "perm_data_setting";
            $this->load->view('jsw/index',$data);
	}     
        
       
        
}
