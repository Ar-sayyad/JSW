<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class vesselPerformance extends CI_Controller {

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
            $data['title'] = "Vessel Performance";
            $data['icons'] = "settings_applications";
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');
            $this->load->view('jsw/searchVessel',$data);
	}     
        
        
        
        public function searchVessel(){            
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                              //$this->session->set_flashdata('msg',
                                redirect(base_url() . 'marinePerformance');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                       
                        if($month==12){
                            $tmonth = 1;
                            $tyear = $year+1;
                        }else{
                            $tmonth = $month+1;
                            $tyear = $year;
                        }                        
                        
                        $fromdate = ($year.'-'.$month.'-01 07:00');
                        $todate = ($tyear.'-'.$tmonth.'-01 07:00');
                        
                         $data = $this->jsw_model->call_stored_procedure($fromdate,$todate);
//                         echo '<pre>'; print_r($data); echo '</pre>';
////                         print_r(json_encode($data));
//                         die();
//                         echo $data= count($data);
//                         die();
                         $this->vesselPerformance($data);
                     }
        }

        public function vesselPerformance($data){
                        $data['title'] = "Vessel Performance";
                        $data['icons'] = "settings_applications";
                        $data['vesselPerformance_info'] =  $data;
                        $this->load->view('jsw/vesselPerformance',$data);
        }
        
        public function save(){
            $this->form_validation->set_rules('van_id', '', 'required');
            $this->form_validation->set_rules('vessel_name', '', 'required');
            $this->form_validation->set_rules('Remarks', 'Remarks', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {   
                           $cond = array('van_id' => trim($this->input->post('van_id')));
                         $exist = $this->jsw_model->check_data_info('dbo.tbl_VesselPerformanceRemarks',$cond);                         
                         if($exist){
                                 $data= array(
                                'vessel_name' => trim($this->input->post('vessel_name')),
                                'Remarks' => trim($this->input->post('Remarks'))
                            );
                                $where =array('van_id'=>trim($this->input->post('van_id')));
                            $this->jsw_model->update_data_info('dbo.tbl_VesselPerformanceRemarks',$data,$where);
                            echo 1;
                         }else{
                            $data= array(
                                'van_id' => trim($this->input->post('van_id')),
                                'vessel_name' => trim($this->input->post('vessel_name')),
                                'Remarks' => trim($this->input->post('Remarks'))
                            );
                            $this->jsw_model->save_data_info('dbo.tbl_VesselPerformanceRemarks',$data);
                           echo 1;
                    }
                     }
            
            
        }
       
       
       
}
