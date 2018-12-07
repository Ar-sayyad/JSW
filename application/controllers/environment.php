<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class environment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
        $this->load->library('excel');
        $this->load->library('session');
	$this->load->library('form_validation');
        $this->load->model('jsw_model');
        //$this->load->model('import_model', 'import');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
         /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
        
       public function index()
	{
            $data['title'] = "Environment";
            $data['icons'] = "bubble_chart";
            $data['environment_info'] = $this->jsw_model->select_data_info('dbo.tblEnvironment');
            $this->load->view('jsw/environment',$data);
	}     
        
       public function save(){
            $this->form_validation->set_rules('date', 'date', 'required');
            $this->form_validation->set_rules('CO', 'CO', 'required|callback_weight_check');
            $this->form_validation->set_rules('NOX', 'NOX', 'required|callback_weight_check');
            $this->form_validation->set_rules('SO2', 'SO2', 'required|callback_weight_check');
            $this->form_validation->set_rules('PM10', 'PM10', 'required|callback_weight_check');
            $this->form_validation->set_rules('RSPM', 'RSPM', 'required|callback_weight_check');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {  
                         $cond = array('date' => trim($this->input->post('date')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblEnvironment',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                               // redirect(base_url() . 'tugs');
                         }else{
                            $data= array(
                                'date' => trim($this->input->post('date')),
                                'CO' => trim($this->input->post('CO')),
                                'NOX' => trim($this->input->post('NOX')),
                                'SO2' =>trim($this->input->post('SO2')),
                                'PM10' => trim($this->input->post('PM10')),
                                'RSPM' => trim($this->input->post('RSPM'))
                            );
                            $this->jsw_model->save_data_info('dbo.tblEnvironment',$data);
                           echo 1;
                         }
                    }
            
            
        }
        
        public function update($id){
             $this->form_validation->set_rules('date', 'date', 'required');
            $this->form_validation->set_rules('CO', 'CO', 'required|callback_weight_check');
            $this->form_validation->set_rules('NOX', 'NOX', 'required|callback_weight_check');
            $this->form_validation->set_rules('SO2', 'SO2', 'required|callback_weight_check');
            $this->form_validation->set_rules('PM10', 'PM10', 'required|callback_weight_check');
            $this->form_validation->set_rules('RSPM', 'RSPM', 'required|callback_weight_check');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {
                         $data= array(
                                'date' => trim($this->input->post('date')),
                                'CO' => trim($this->input->post('CO')),
                                'NOX' => trim($this->input->post('NOX')),
                                'SO2' =>trim($this->input->post('SO2')),
                                'PM10' => trim($this->input->post('PM10')),
                                'RSPM' => trim($this->input->post('RSPM'))
                            );
                             $where =array('ID'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblEnvironment',$data,$where);
                            echo 1;
                    }
            
            
        }
        
        public function delete($id){
                $where =array('ID'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblEnvironment',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Environment Deleted Successfully'));
                redirect(base_url() . 'environment');
        }
        
        
         public function weight_check($val)
        {
            if ( ! (int)($val==$val) || ! (float)($val==$val))
		{
			  $this->form_validation->set_message('weight_check', '{field} field must be number or decimal.');
                          return FALSE;
		}                
                else{
                       return TRUE;
                }
                
//                if ((int) $val == $val || (float) $val == $val ) {                
//                return TRUE;
//            } else {
//                $this->form_validation->set_message('weight_check', '{field} field must be number or decimal.');
//                return TRUE;
//            }
        }
       
        
        function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				 $highestRow = $worksheet->getHighestRow();
                                
				$highestColumn = $worksheet->getHighestColumn();
                                $SheetDataKey = array();
				for($row=2; $row<=$highestRow; $row++)
				{		
                                   
                                    $getdate = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); 
                                    $strdate = PHPExcel_Shared_Date::ExcelToPHP($getdate);
                                    $date = date('Y-m-d',$strdate);  
                                   // $td = date('Y-m-d'
                                    $NOX = $worksheet->getCellByColumnAndRow(1, $row)->getValue();                                  
                                    $CO = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                    $SO2 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                                    $PM10 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                                    $RSPM = $worksheet->getCellByColumnAndRow(5, $row)->getValue();   
                                     
                    
                                        $cond = array('date' => $date);
                                         $exist = $this->jsw_model->check_data_info('dbo.tblEnvironment',$cond);
                                         if($exist){
                                                //SKIP REPEATED ENTRIES
                                         }else{
                                             $data= array(
                                                    'date' => $date,
                                                    'CO' => $CO,
                                                    'NOX' => $NOX,
                                                    'SO2' =>$SO2,
                                                    'PM10' => $PM10,
                                                    'RSPM' => $RSPM
                                                );      
                                               $this->jsw_model->save_data_info('dbo.tblEnvironment',$data);
                                        }
                                        
                  
                                }           
			}
                         
                        if(!empty($data)){                            
                                              
                            $this->session->set_flashdata('msg','<i class="material-icons">check_circle_outline</i> Environment List Uploaded Successfully.');
                           redirect(base_url().'environment');
                        }else{
                            $this->session->set_flashdata('err_msg', '<i class="material-icons">close</i> Please Import the Valid and Required File Data');
                        redirect(base_url() . 'environment');
                        }
		}	
	}
       
        
}
