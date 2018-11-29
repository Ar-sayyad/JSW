<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class powerConsumption extends CI_Controller {

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
            $data['title'] = "Power Consumption";
            $data['icons'] = "power_off";
             $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');            
            $this->load->view('jsw/searchConsumption',$data);           
	}     
        
        
        public function searchConsumption(){            
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('Mode', 'Mode', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() . 'powerConsumption');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                        $Mode = $this->input->post('Mode');
                      $cond = array('Month' => trim($this->input->post('month')),
                                'Year' => trim($this->input->post('year')),
                                'Mode' => trim($this->input->post('Mode')));
                         $powerConsumption_info = $this->jsw_model->check_data_info('dbo.tblMaintenancePowerConsumption',$cond);                         
                        $this->powerConsumption($powerConsumption_info);
                     }                   
            
        }
        
        
        public function powerConsumption($powerConsumption_info){
                        $data['title'] = "Power Consumption";
                        $data['icons'] = "power_off";
                        $data['powerConsumption_info'] =  $powerConsumption_info;
                        $this->load->view('jsw/powerConsumption',$data);        
        }
        
        
      public function save(){
            $this->form_validation->set_rules('Mode', 'Mode', 'required');
            $this->form_validation->set_rules('Cargo', 'Cargo', 'required');
            $this->form_validation->set_rules('Berth', 'Berth', 'required');
            $this->form_validation->set_rules('Target', 'Target', 'required');
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
                            $cond = array('Month' => trim($this->input->post('Month')),
                                'year' => trim($this->input->post('year')),
                                'Mode' => trim($this->input->post('Mode')),
                                'Cargo' => trim($this->input->post('Cargo')),
                                'Berth' => trim($this->input->post('Berth')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblMaintenancePowerConsumption',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                               // redirect(base_url() . 'tugs');
                         }else{
                            $data= array(
                                'Mode' => trim($this->input->post('Mode')),
                                'Cargo' => trim($this->input->post('Cargo')),
                                'Berth' => trim($this->input->post('Berth')),
                                'Target' =>trim($this->input->post('Target')),
                                'Actual' =>trim($this->input->post('Actual')),
                                'Month' => trim($this->input->post('Month')),
                                'year' =>trim($this->input->post('year')),
                                'monthid' =>$monthid,
                                'Finyear' => $FinYear
                            );
                            $this->jsw_model->save_data_info('dbo.tblMaintenancePowerConsumption',$data);
                           echo 1;
                         }
                    }
            
            
        }
        
        public function update($id){
             $this->form_validation->set_rules('Mode', 'Mode', 'required');
            $this->form_validation->set_rules('Cargo', 'Cargo', 'required');
            $this->form_validation->set_rules('Berth', 'Berth', 'required');
            $this->form_validation->set_rules('Target', 'Target', 'required');
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
                                'Mode' => trim($this->input->post('Mode')),
                                'Cargo' => trim($this->input->post('Cargo')),
                                'Berth' => trim($this->input->post('Berth')),
                                'Target' =>trim($this->input->post('Target')),
                                'Actual' =>trim($this->input->post('Actual')),
                                'Month' => trim($this->input->post('Month')),
                                'year' =>trim($this->input->post('year')),
                                'monthid' =>$monthid,
                                'Finyear' => $FinYear
                            );
                            
                             $where =array('ID'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblMaintenancePowerConsumption',$data,$where);
                            echo 1;
                    }
            
            
        }
        
        public function delete($id){
                $where =array('ID'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblMaintenancePowerConsumption',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Power Consumption Details Deleted Successfully'));
                redirect(base_url() . 'maintenanceCost');
        }
       
       
        
}
