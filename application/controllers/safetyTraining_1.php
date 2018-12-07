<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class safetyTraining extends CI_Controller {

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
            $data['title'] = "Safety Training";
            $data['icons'] = "accessibility_new";
            $data['safetyTraining_info'] = $this->jsw_model->select_data_info('dbo.tblSafetyTopic');
            $this->load->view('jsw/safetyTraining',$data);
	}     
        
         public function save(){
            $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required|numeric');
            $this->form_validation->set_rules('LNGhazards', 'LNG Hazards', 'required|numeric');
            $this->form_validation->set_rules('ConfinedSpaceEntry', 'Confined Space Entry', 'required|numeric');
            $this->form_validation->set_rules('AwarenessToolsTacklesCalibration', 'Awareness Tools Tackles Calibration', 'required|numeric');
            $this->form_validation->set_rules('AwarenessFiretenderOperation', 'Awareness Fire tender Operation', 'required|numeric');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'safetyTraining');
                    }
                    else
                     {
                        $cond = array('Month' => trim($this->input->post('MONTH')),
                                'year' => trim($this->input->post('YEAR')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblSafetyTopic',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                                //redirect(base_url() . 'safetyTraining');
                         }else{
                            $data= array(
                                'Month' => trim($this->input->post('MONTH')),
                                'year' => trim($this->input->post('YEAR')),
                                'LNGhazards' =>trim($this->input->post('LNGhazards')),
                                'ConfinedSpaceEntry' =>trim($this->input->post('ConfinedSpaceEntry')),
                                'AwarenessToolsTacklesCalibration' =>trim($this->input->post('AwarenessToolsTacklesCalibration')),
                                'AwarenessFiretenderOperation' =>trim($this->input->post('AwarenessFiretenderOperation')),
                                'Type' => strtoupper(trim($this->input->post('Type')))
                            );
                            
                            $this->jsw_model->save_data_info('dbo.tblSafetyTopic',$data);
                            echo 1;
                            //$this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Topic Details Added Successfully'));
                            //redirect(base_url() . 'safetyTraining');
                         }
                    }
            
            
        }
        
        public function update($id){
            $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required|numeric');
            $this->form_validation->set_rules('LNGhazards', 'LNG Hazards', 'required|numeric');
            $this->form_validation->set_rules('ConfinedSpaceEntry', 'Confined Space Entry', 'required|numeric');
            $this->form_validation->set_rules('AwarenessToolsTacklesCalibration', 'Awareness Tools Tackles Calibration', 'required|numeric');
            $this->form_validation->set_rules('AwarenessFiretenderOperation', 'Awareness Fire tender Operation', 'required|numeric');
            $this->form_validation->set_rules('Type', 'Type', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo  validation_errors();
                            //redirect(base_url() . 'safetyTraining');
                    }
                    else
                     {
//                            $cond = array('Month' => trim($this->input->post('MONTH')),
//                                'year' => trim($this->input->post('YEAR')));
//                         $exist = $this->jsw_model->check_data_info('dbo.tblSafetyTopic',$cond);
//                         if($exist){
//                                $this->session->set_flashdata('err_msg', '<i class="material-icons">close</i> Record Already Exist..!');
//                                redirect(base_url() . 'safetyTraining');
//                         }else{
                             $data= array(
                                'Month' => trim($this->input->post('MONTH')),
                                'year' => trim($this->input->post('YEAR')),
                                'LNGhazards' =>trim($this->input->post('LNGhazards')),
                                'ConfinedSpaceEntry' =>trim($this->input->post('ConfinedSpaceEntry')),
                                'AwarenessToolsTacklesCalibration' =>trim($this->input->post('AwarenessToolsTacklesCalibration')),
                                'AwarenessFiretenderOperation' =>trim($this->input->post('AwarenessFiretenderOperation')),
                                'Type' =>strtoupper(trim($this->input->post('Type')))
                            );
                            
                             $where =array('id'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblSafetyTopic',$data,$where);
                            echo 1;
                            //$this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Topic Details Updated Successfully'));
                            //redirect(base_url() . 'safetyTraining');
                         //}
                    }
            
            
        }
        
        public function delete($id){
                $where =array('id'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblSafetyTopic',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Topic Details Deleted Successfully'));
                redirect(base_url() . 'safetyTraining');
        }
       
       
        
}
