<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hemePerformance extends CI_Controller {

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
            $data['title'] = "HEME Performance";
            $data['icons'] = "brightness_low";
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');            
            $this->load->view('jsw/searchHeme',$data);
	}     
        
        public function searchHeme(){            
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() . 'mhsPerformance');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                      $cond = array('Month' => trim($this->input->post('month')),
                                'Year' => trim($this->input->post('year')),
                                'Type' => 'HEME');
                         $hemePerformance_info= $this->jsw_model->check_data_info('dbo.TblMHSPerformanceEC',$cond);                         
                        $this->hemePerformance($hemePerformance_info);
                     }                   
            
        }
        
        
        public function hemePerformance($hemePerformance_info){
                        $data['title'] = "HEME Performance";
                        $data['icons'] = "brightness_low";
                        $data['hemePerformance_info'] =  $hemePerformance_info;
                        $this->load->view('jsw/hemePerformance',$data);        
        }
       
   public function save(){
            $this->form_validation->set_rules('Equipment', 'Equipment', 'required');
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('RN', 'RN', 'required');
            $this->form_validation->set_rules('BD', 'BD', 'required');
            $this->form_validation->set_rules('PM', 'PM', 'required');            
            $this->form_validation->set_rules('CM', 'CM', 'required');
            $this->form_validation->set_rules('Remark', 'Remark', 'required');
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
                            'Equipment' => trim($this->input->post('Equipment')));
                         $exist = $this->jsw_model->check_data_info('dbo.TblMHSPerformanceEC',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                               // redirect(base_url() . 'tugs');
                         }else{
                            $data= array(
                                'Equipment' => trim($this->input->post('Equipment')),
                                'Type' =>'HEME',
                                'RN' => trim($this->input->post('RN')),
                                'BD' => trim($this->input->post('BD')),
                                'PM' => trim($this->input->post('PM')),
                                'CM' => trim($this->input->post('CM')),
                                'Month' => trim($this->input->post('Month')),
                                'Year' =>trim($this->input->post('year')),
                                'monthid' =>$monthid,
                                'FinYear' => $FinYear,
                                'Remark' => trim($this->input->post('Remark')),
                            );
                            $this->jsw_model->save_data_info('dbo.TblMHSPerformanceEC',$data);
                           echo 1;
                         }
                    }
            
            
        }
        
        public function update($id){
             $this->form_validation->set_rules('Equipment', 'Equipment', 'required');
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('RN', 'RN', 'required');
            $this->form_validation->set_rules('BD', 'BD', 'required');
            $this->form_validation->set_rules('PM', 'PM', 'required');            
            $this->form_validation->set_rules('CM', 'CM', 'required');
            $this->form_validation->set_rules('Remark', 'Remark', 'required');
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
                                'Equipment' => trim($this->input->post('Equipment')),
                                'Type' =>'HEME',
                                'RN' => trim($this->input->post('RN')),
                                'BD' => trim($this->input->post('BD')),
                                'PM' => trim($this->input->post('PM')),
                                'CM' => trim($this->input->post('CM')),
                                'Month' => trim($this->input->post('Month')),
                                'Year' =>trim($this->input->post('year')),
                                'monthid' =>$monthid,
                                'FinYear' => $FinYear,
                                'Remark' => trim($this->input->post('Remark')),
                            );
                            
                             $where =array('id'=>$id);
                            $this->jsw_model->update_data_info('dbo.TblMHSPerformanceEC',$data,$where);
                            echo 1;
                    }
            
            
        }
        
        public function delete($id){
                $where =array('id'=>$id);
                $this->jsw_model->delete_data_info('dbo.TblMHSPerformanceEC',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i>  HEME Performance Deleted Successfully'));
                redirect(base_url() . 'hemePerformance');
        }
       
        
}
