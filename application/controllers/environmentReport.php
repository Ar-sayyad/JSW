<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class environmentReport extends CI_Controller {

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
            $data['title'] = "Environment Report";
            $data['icons'] = "format_list_numbered";
            $data['environmentReport_info'] = $this->jsw_model->select_data_info('dbo.tblPlantation');
            $this->load->view('jsw/environmentReport',$data);
	}     
        
     public function save(){
            $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required|numeric');
            $this->form_validation->set_rules('SaplingPlanted', 'Sapling Planted', 'required|numeric');
            $this->form_validation->set_rules('Survival', 'Survival', 'required|numeric');
            $this->form_validation->set_rules('Area', 'Area', 'required|numeric');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {  
                            $cond = array('MONTH' => trim($this->input->post('MONTH')),
                                'YEAR' => trim($this->input->post('YEAR')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblPlantation',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                                //redirect(base_url() . 'safety');
                         }else{
                             $data= array(
                                'MONTH' => trim($this->input->post('MONTH')),
                                'YEAR' => trim($this->input->post('YEAR')),
                                'SaplingPlanted' => trim($this->input->post('SaplingPlanted')),
                                'Survival' =>trim($this->input->post('Survival')),
                                'Area' => trim($this->input->post('Area'))
                            );
                            $this->jsw_model->save_data_info('dbo.tblPlantation',$data);
                           echo 1;
                         }
                    }
            
            
        }
        
        public function update($id){
              $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required|numeric');
            $this->form_validation->set_rules('SaplingPlanted', 'Sapling Planted', 'required|numeric');
            $this->form_validation->set_rules('Survival', 'Survival', 'required|numeric');
            $this->form_validation->set_rules('Area', 'Area', 'required|numeric');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {
                       $data= array(
                                'MONTH' => trim($this->input->post('MONTH')),
                                'YEAR' => trim($this->input->post('YEAR')),
                                'SaplingPlanted' => trim($this->input->post('SaplingPlanted')),
                                'Survival' =>trim($this->input->post('Survival')),
                                'Area' => trim($this->input->post('Area'))
                            );
                            
                             $where =array('ID'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblPlantation',$data,$where);
                            echo 1;
                    }
            
            
        }
        
        public function delete($id){
                $where =array('ID'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblPlantation',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Environment Report Deleted Successfully'));
                redirect(base_url() . 'environmentReport');
        }
       
       
        
}
