<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        
        public function portPerformance()
	{
            $data['title'] = "Port Performance";
            $data['icons'] = "perm_data_setting";
            $this->load->view('jsw/index',$data);
	}    
        
        public function vesselPerformance()
	{
            $data['title'] = "Vessel Performance";
            $data['icons'] = "settings_applications";
            $this->load->view('jsw/vesselPerformance',$data);
	}        
        
        public function marinePerformance()
	{
            $data['title'] = "Marine Performance";
            $data['icons'] = "waves";
            $this->load->view('jsw/marinePerformance',$data);
	}
        
        public function mbcs()
	{
            $data['title'] = "Marine Performance - MBCs";
            $data['icons'] = "format_align_left";
            $this->load->view('jsw/mbcs',$data);
	}
        
        public function tugs()
	{
            $data['title'] = "Marine Performance - Tugs";
            $data['icons'] = "format_align_center";
            $this->load->view('jsw/tugs',$data);
	}
        
        public function portOperational()
	{
            $data['title'] = "Port Operational Performance";
            $data['icons'] = "build";
            $this->load->view('jsw/portOperational',$data);
	}
        
         public function maintenanceCost()
	{
            $data['title'] = "Maintenance Cost";
            $data['icons'] = "attach_money";
            $this->load->view('jsw/maintenanceCost',$data);
	}
        
         public function mhsPerformance()
	{
            $data['title'] = "MHS Performance";
            $data['icons'] = "brightness_high";
            $this->load->view('jsw/mhsPerformance',$data);
	}
        
         public function hemePerformance()
	{
            $data['title'] = "HEME Performance";
            $data['icons'] = "brightness_low";
            $this->load->view('jsw/hemePerformance',$data);
	}
        
         public function safety()
	{
            $data['title'] = "Safety";
            $data['icons'] = "security";
            //$data['environment_info'] = $this->test_model->select_safety_info();
            $this->load->view('jsw/safety',$data);
	}
        
         public function safetyTraining()
	{
            $data['title'] = "Safety Training";
            $data['icons'] = "accessibility_new";
            $this->load->view('jsw/safetyTraining',$data);
	}
        
         public function safetyTrainingVisuals()
	{
            $data['title'] = "Safety Training (Visuals)";
            $data['icons'] = "transfer_within_a_station";
            $this->load->view('jsw/safetyTrainingVisuals',$data);
	}
        
         public function environment()
	{
            $data['title'] = "Environment";
            $data['icons'] = "bubble_chart";
            $this->load->view('jsw/environment',$data);
	}
        
         public function environmentReport()
	{
            $data['title'] = "Environment Report";
            $data['icons'] = "format_list_numbered";
            $this->load->view('jsw/environmentReport',$data);
	}
        
         public function environmentVisuals()
	{
            $data['title'] = "Environment (Visuals)";
            $data['icons'] = "table_chart";
            $this->load->view('jsw/environmentVisuals',$data);
	}        
        
          public function popup($account_type = '', $page_name = '', $param2 = '', $param3 = '', $param4 = '',$param5 = '',$param6 = '')
	{
                //$account_type               =	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;
                $page_data['param3']		=	$param3;
                $page_data['param4']		=	$param4;
                $page_data['param5']		=	$param5;
                $page_data['param6']		=	$param6;
                $page_data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');
		//echo "hello";
		$this->load->view($account_type.'/'.$page_name,$page_data);		
	}
}
