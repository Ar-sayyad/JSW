<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class portOperational extends CI_Controller {

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
            $data['title'] = "Port Operational Performance";
            $data['icons'] = "build";
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');            
            $this->load->view('jsw/searchOperational',$data);
           // $data['portOperational_info'] = $this->jsw_model->select_data_info('dbo.tblPortOperationPerformance');
            
	} 
        
        public function searchOperational(){            
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() . 'portOperational');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                        $Type = $this->input->post('Type');
                      $cond = array('Month' => ($this->input->post('month')),
                                'Year' => ($this->input->post('year')),
                                'Type' => ($this->input->post('Type')));
                         $portOperational_info = $this->jsw_model->check_data_info('dbo.tblPortOperationPerformance',$cond);                         
                        $this->portOperational($portOperational_info,$Type);
                     }                   
            
        }
        
        
        public function portOperational($portOperational_info,$Type){
                        $data['title'] = "Port Operational Performance";
                        $data['icons'] = "build";
                        $data['Type'] = $Type;
                        $data['portOperational_info'] =  $portOperational_info;
                        $this->load->view('jsw/portOperational',$data);        
        }


                public function save(){
            $this->form_validation->set_rules('MainType', 'Main Type', 'required');
            $this->form_validation->set_rules('Cargo', 'Cargo', 'required');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            $this->form_validation->set_rules('Budget', 'Budget', 'required');
            $this->form_validation->set_rules('Actual', 'Actual', 'required');
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {   
                            $monthid = $this->input->post('monthid');
                            $year = $this->input->post('year');
                            if ( $monthid < 10 ) {
                                $FinYear = ($year).'-'.($year + 1);
                            }
                            else {
                                $FinYear = ($year-1).'-'.($year);
                            }
                            $cond = array('Month' => ($this->input->post('Month')),
                                'Year' => ($this->input->post('year')),
                                'Cargo' => ($this->input->post('Cargo')),
                                'SubCargo' => ($this->input->post('SubCargo')),
                            'MainType' => ($this->input->post('MainType')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblPortOperationPerformance',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                               // redirect(base_url() . 'tugs');
                         }else{
                            $data= array(
                                'Cargo' => ($this->input->post('Cargo')),
                                'SubCargo' => ($this->input->post('SubCargo')),                                
                                'Type' =>($this->input->post('Type')),
                                'Budget' => ($this->input->post('Budget')),                                
                                'Actual' => ($this->input->post('Actual')),
                                'FinYear' => $FinYear,   
                                'Month' => ($this->input->post('Month')),
                                'Year' =>($year),                       
                                'MainType' => ($this->input->post('MainType')),
                                'monthid' => ($monthid)
                            );
                            $this->jsw_model->save_data_info('dbo.tblPortOperationPerformance',$data);
                           echo 1;
                         }
                    }
            
            
        }
       
        public function update($id){
             $this->form_validation->set_rules('MainType', 'Main Type', 'required');
            $this->form_validation->set_rules('Cargo', 'Cargo', 'required');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            $this->form_validation->set_rules('Budget', 'Budget', 'required');
            $this->form_validation->set_rules('Actual', 'Actual', 'required');
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {
                      $monthid = $this->input->post('monthid');
                            $year = $this->input->post('year');
                            if ( $monthid < 10 ) {
                                $FinYear = ($year).'-'.($year + 1);
                            }
                            else {
                                $FinYear = ($year-1).'-'.($year);
                            }
                            $data= array(
                                'Cargo' => ($this->input->post('Cargo')),
                                'SubCargo' => ($this->input->post('SubCargo')),                                
                                'Type' =>($this->input->post('Type')),
                                'Budget' => ($this->input->post('Budget')),                                
                                'Actual' => ($this->input->post('Actual')),
                                'FinYear' => $FinYear,   
                                'Month' => ($this->input->post('Month')),
                                'Year' =>($year),                       
                                'MainType' => ($this->input->post('MainType')),
                                'monthid' => ($monthid)
                            );
                            
                             $where =array('id'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblPortOperationPerformance',$data,$where);
                            echo 1;
                    }
            
            
        }
        
        public function delete($id){
                $where =array('id'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblPortOperationPerformance',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Port Operational Performance Deleted Successfully'));
                redirect(base_url() . 'portOperational');
        }
       
       
        
}
