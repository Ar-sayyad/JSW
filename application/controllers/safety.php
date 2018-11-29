<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class safety extends CI_Controller {

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
            $data['title'] = "Safety";
            $data['icons'] = "security";
            $data['safety_info'] = $this->jsw_model->select_data_info('dbo.tblsafety');
            $this->load->view('jsw/safety',$data);
	}
        
        public function save(){
            $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required|numeric');
            $this->form_validation->set_rules('Nearmiss', 'Near Miss', 'required|numeric');
            $this->form_validation->set_rules('General', 'General', 'required|numeric');
            $this->form_validation->set_rules('FirstAid_Injury', 'First Aid / Injury', 'required|numeric');
            $this->form_validation->set_rules('Fatal', 'Fatal', 'required|numeric');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo  validation_errors();
                            //redirect(base_url() . 'safety');
                    }
                    else
                     {
                         $monthid = $this->input->post('monthid');
                            $year = $this->input->post('YEAR');                      
                         //$month1= $month-3;
                             if ( $monthid < 10) {
                                $FinYear = ($year)."-".($year+1);
                            }
                            else {
                                 $FinYear = ($year-1)."-".($year);
                            }
                           
                            
                        $cond = array('MONTH' => trim($this->input->post('MONTH')),
                                'YEAR' => trim($this->input->post('YEAR')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblsafety',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                                //redirect(base_url() . 'safety');
                         }else{
                            $data= array(
                                'MONTH' => trim($this->input->post('MONTH')),
                                'YEAR' => trim($this->input->post('YEAR')),
                                'NearMiss' =>trim($this->input->post('Nearmiss')),
                                'General' =>trim($this->input->post('General')),
                                'FirstAid_Injury' =>trim($this->input->post('FirstAid_Injury')),
                                'Fatal' =>trim($this->input->post('Fatal')),
                                'FinYear' =>$FinYear
                            );
                            
                            $this->jsw_model->save_data_info('dbo.tblsafety',$data);
                            echo 1;
                           // $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Details Added Successfully'));
                            //redirect(base_url() . 'safety');
                         }
                    }
            
            
        }
        
        public function update($id){
            $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required');
            $this->form_validation->set_rules('Nearmiss', 'Near Miss', 'required|numeric');
            $this->form_validation->set_rules('General', 'General', 'required|numeric');
            $this->form_validation->set_rules('FirstAid_Injury', 'First Aid / Injury', 'required|numeric');
            $this->form_validation->set_rules('Fatal', 'Fatal', 'required|numeric');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo  validation_errors();
                            //redirect(base_url() . 'safety');
                    }
                    else
                     {
                         $monthid = $this->input->post('monthid');
                            $year = $this->input->post('YEAR');                      
                         //$month1= $month-3;
                             if ( $monthid < 10) {
                                $FinYear = ($year)."-".($year+1);
                            }
                            else {
                                 $FinYear = ($year-1)."-".($year);
                            }
                            
//                            $cond = array('MONTH' => trim($this->input->post('MONTH')),
//                                'YEAR' => trim($this->input->post('YEAR')));
//                         $exist = $this->jsw_model->check_data_info('dbo.tblsafety',$cond);
//                         if($exist){
//                                $this->session->set_flashdata('err_msg', '<i class="material-icons">close</i> Record Already Exist..!');
//                                redirect(base_url() . 'safety');
//                         }else{
                             $data= array(
                                'MONTH' =>trim($this->input->post('MONTH')),
                                'YEAR' =>trim($this->input->post('YEAR')),
                                'NearMiss' =>trim($this->input->post('Nearmiss')),
                                'General' =>trim($this->input->post('General')),
                                'FirstAid_Injury' =>trim($this->input->post('FirstAid_Injury')),
                                'Fatal' =>trim($this->input->post('Fatal')),
                                'FinYear' =>$FinYear
                            );
                            
                             $where =array('ID'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblsafety',$data,$where);
                            echo 1;
                            //$this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Details Updated Successfully'));
                            //redirect(base_url() . 'safety');
                        // }
                    }
            
            
        }
        
        public function delete($id){
                $where =array('ID'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblsafety',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Details Deleted Successfully'));
                redirect(base_url() . 'safety');
        }
       
        
}
