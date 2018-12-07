<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class maintenanceCost extends CI_Controller {

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
            $data['title'] = "Maintenance Cost";
            $data['icons'] = "attach_money";
            $data['Type'] = '';
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');   
            $this->load->view('jsw/searchMaintenance',$data);
	}     
        
         public function searchMaintenance(){            
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() . 'maintenanceCost');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                        $Type = $this->input->post('Type');
                      $cond = array('Month' => trim($this->input->post('month')),
                                'Year' => trim($this->input->post('year')),
                                'Type' => trim($this->input->post('Type')));
                         $maintenanceCost_info = $this->jsw_model->check_data_info('dbo.tblMaintenance',$cond);                         
                        $this->maintenanceCost($maintenanceCost_info,$Type);
                     }                   
            
        }
        
        
        public function maintenanceCost($maintenanceCost_info,$Type){
                        $data['title'] = "Maintenance Cost";
                        $data['icons'] = "attach_money";
                        $data['Type'] = $Type;
                        $data['maintenanceCost_info'] =  $maintenanceCost_info;
                        $this->load->view('jsw/maintenanceCost',$data);        
        }
        
        
      public function save(){
            $this->form_validation->set_rules('Dept', 'Department', 'required');
            $this->form_validation->set_rules('Budget', 'Budget', 'required');
            $this->form_validation->set_rules('Type', 'Type', 'required');
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
                                'Dept' => trim($this->input->post('Dept')),
                                'Type' => trim($this->input->post('Type')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblMaintenance',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                               // redirect(base_url() . 'tugs');
                         }else{
                            $data= array(
                                'MainDept' => trim($this->input->post('MainDept')),
                                'Dept' => trim($this->input->post('Dept')),
                                'Budget' => trim($this->input->post('Budget')),
                                'Type' =>trim($this->input->post('Type')),
                                'Month' => trim($this->input->post('Month')),
                                'year' =>trim($this->input->post('year')),
                                'monthid' =>$monthid,
                                'FinYear' => $FinYear
                            );
                            $this->jsw_model->save_data_info('dbo.tblMaintenance',$data);
                           echo 1;
                         }
                    }
            
            
        }
        
        public function update($id){
              $this->form_validation->set_rules('Dept', 'Department', 'required');
            $this->form_validation->set_rules('Budget', 'Budget', 'required');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
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
                                'MainDept' => trim($this->input->post('MainDept')),
                                'Dept' => trim($this->input->post('Dept')),
                                'Budget' => trim($this->input->post('Budget')),
                                'Type' =>trim($this->input->post('Type')),
                                'Month' => trim($this->input->post('Month')),
                                'year' =>trim($this->input->post('year')),
                                'monthid' =>$monthid,
                                'FinYear' => $FinYear
                            );
                            
                             $where =array('ID'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblMaintenance',$data,$where);
                            echo 1;
                    }
            
            
        }
        
        public function delete($id){
                $where =array('ID'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblMaintenance',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Maintenance Cost Details Deleted Successfully'));
                redirect(base_url() . 'maintenanceCost');
        }
       
       
        
}
