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
            $data['safetyTraining_info'] = $this->jsw_model->select_data_info('dbo.tblSafetyTopic_ref');
            $this->load->view('jsw/safetyTraining',$data);
	}     
        
         public function save(){
            $this->form_validation->set_rules('MONTH', 'MONTH', 'required');
            $this->form_validation->set_rules('YEAR', 'YEAR', 'required|numeric');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'safetyTraining');
                    }
                    else
                     {
                        $topic = $this->input->post('topic');
                           $topic_entries = array();
                           $num_topic = sizeof($topic);
                           
                            $monthid = $this->input->post('monthid');
                            $year = $this->input->post('YEAR');                      
                         //$month1= $month-3;
                             if ( $monthid < 10) {
                                $FinYear = ($year)."-".($year+1);
                            }
                            else {
                                 $FinYear = ($year-1)."-".($year);
                            }
                           
                            
                       /* $cond = array('Month' => trim($this->input->post('MONTH')),
                                'year' => $FinYear);
                         $exist = $this->jsw_model->check_data_info('dbo.tblSafetyTopic_ref',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                                //redirect(base_url() . 'safetyTraining');
                         }else{*/
                              for ($i = 0; $i < $num_topic; $i++)
                            {
                                $data= array(
                                    'Month' => trim($this->input->post('MONTH')),
                                    'year' => $FinYear,
                                    'yr' => $year,
                                    'topic'=> $this->input->post('topic')[$i],
                                    'value'=> $this->input->post('value')[$i],
                                    'target'=> $this->input->post('target')[$i]
                                   // 'type'=> $this->input->post('type')[$i]
                                );
                                $this->jsw_model->save_data_info('dbo.tblSafetyTopic_ref',$data);
                            }
                            echo 1;
                            //$this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Topic Details Added Successfully'));
                            //redirect(base_url() . 'safetyTraining');
                        // }
                    }
            
            
        }
        
        public function update($id){
            $this->form_validation->set_rules('topic', 'Topic', 'required');
            $this->form_validation->set_rules('value', 'Value', 'required');
            $this->form_validation->set_rules('target', 'Target', 'required');
            //$this->form_validation->set_rules('type', 'Type', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo  validation_errors();
                            //redirect(base_url() . 'safetyTraining');
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
                            
//                            $cond = array('Month' => trim($this->input->post('MONTH')),
//                                'year' => trim($this->input->post('YEAR')));
//                         $exist = $this->jsw_model->check_data_info('dbo.tblSafetyTopic',$cond);
//                         if($exist){
//                                $this->session->set_flashdata('err_msg', '<i class="material-icons">close</i> Record Already Exist..!');
//                                redirect(base_url() . 'safetyTraining');
//                         }else{
                             $data= array(
                                    //'Month' => trim($this->input->post('MONTH')),
                                    //'year' => $FinYear,
                                    'topic'=> $this->input->post('topic'),
                                    'value'=> $this->input->post('value'),
                                    'target'=> $this->input->post('target'),
                                    //'type'=> $this->input->post('type')
                                     );                            
                             $where =array('id'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblSafetyTopic_ref',$data,$where);
                            echo 1;
                            //$this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Topic Details Updated Successfully'));
                            //redirect(base_url() . 'safetyTraining');
                         //}
                    }
            
            
        }
        
        public function delete($id){
                $where =array('id'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblSafetyTopic_ref',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Safety Topic Details Deleted Successfully'));
                redirect(base_url() . 'safetyTraining');
        }
       
       
        
}
