<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tugs extends CI_Controller {

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
            $data['title'] = "Marine Performance - Tugs";
            $data['icons'] = "format_align_center";
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');            
            $this->load->view('jsw/searchtugs',$data);
	}     
        
        public function searchtugs(){            
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                                redirect(base_url() . 'tugs');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                       
                      $cond = array('Month' => trim($this->input->post('month')),
                                'Year' => trim($this->input->post('year')));
                         $tugs_info = $this->jsw_model->check_data_info('dbo.tblFlotillaPerformance',$cond);                         
                        $this->tugs($tugs_info);
                     }                   
            
        }
        
        
        public function tugs($tugs_info){
                        $data['title'] = "Marine Performance - Tugs";
                        $data['icons'] = "format_align_center";
                        $data['tugs_info'] =  $tugs_info;
                        $this->load->view('jsw/tugs',$data);        
        }

        public function save(){
            $this->form_validation->set_rules('Month', 'MONTH', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('Year', 'YEAR', 'required|numeric');
           // $this->form_validation->set_rules('TugName', 'Tug Name', 'required');
           // $this->form_validation->set_rules('FuelConsumption', 'Fuel Consumption', 'required');
            $this->form_validation->set_rules('FuelCostPerTonofBL', 'Fuel Cost Per Ton of BL', 'required');
            $this->form_validation->set_rules('OtherCostsTonofBL', 'Other Costs Ton of BL', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {
                         $monthid = $this->input->post('monthid');
                            $year = $this->input->post('Year');
                            if ( $monthid < 10 ) {
                                $FinYear = ($year).'-'.($year + 1);
                            }
                            else {
                                $FinYear = ($year-1).'-'.($year);
                            }
                            
                           $TugName= $this->input->post('TugName');
                           $TugName_entries = array();
                           $num_tug = sizeof($TugName);
                           
                        $cond = array('Month' => trim($this->input->post('Month')),
                                'Year' => trim($this->input->post('Year')));
                         $exist = $this->jsw_model->check_data_info('dbo.tblFlotillaPerformance',$cond);
                         if($exist){
                                echo '<i class="material-icons">close</i> Record Already Exist..!';
                               // redirect(base_url() . 'tugs');
                         }else{
                            
                                for ($i = 0; $i < $num_tug; $i++)
                            {
                                $data= array(
                                    'Month' => trim($this->input->post('Month')),
                                    'Year' => trim($this->input->post('Year')),
                                    'FinYear' =>$FinYear,
                                    'TugName' => strtoupper($this->input->post('TugName')[$i]),
                                    'FuelConsumption' =>$this->input->post('FuelConsumption')[$i],
                                    'MonsoonFO' =>$this->input->post('MonsoonFO')[$i],
                                    'FuelCostPerTonofBL' =>$this->input->post('FuelCostPerTonofBL'),
                                    'OtherCostsTonofBL' => $this->input->post('OtherCostsTonofBL')
                                );

                                $this->jsw_model->save_data_info('dbo.tblFlotillaPerformance',$data);
                            }
                            echo 1;
                            
                            
                            //$this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Tugs Details Added Successfully'));
                            //redirect(base_url() . 'tugs');
                         }
                    }
            
            
        }
        
        public function update($id){
            $this->form_validation->set_rules('Month', 'MONTH', 'required');
            $this->form_validation->set_rules('monthid', 'Month id', 'required');
            $this->form_validation->set_rules('Year', 'YEAR', 'required|numeric');
            $this->form_validation->set_rules('TugName', 'Tug Name', 'required');
            $this->form_validation->set_rules('FuelConsumption', 'Fuel Consumption', 'required');
            $this->form_validation->set_rules('tgMonsoonFO', 'tgMonsoonFO', 'required');
            $this->form_validation->set_rules('FuelCostPerTonofBL', 'Fuel Cost Per Ton of BL', 'required');
            $this->form_validation->set_rules('OtherCostsTonofBL', 'Other Costs Ton of BL', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {
                        $monthid = $this->input->post('monthid');
                            $year = $this->input->post('Year');
                            if ( $monthid < 10 ) {
                                $FinYear = ($year).'-'.($year + 1);
                            }
                            else {
                                $FinYear = ($year-1).'-'.($year);
                            }
//                            $cond = array('MONTH' => trim($this->input->post('MONTH')),
//                                'YEAR' => trim($this->input->post('YEAR')));
//                         $exist = $this->jsw_model->check_data_info('dbo.tblFlotillaPerformance',$cond);
//                         if($exist){
//                                $this->session->set_flashdata('err_msg', '<i class="material-icons">close</i> Record Already Exist..!');
//                                redirect(base_url() . 'tugs');
//                         }else{
                             $data= array(
                                'Month' => trim($this->input->post('Month')),
                                'Year' => trim($this->input->post('Year')),
                                'FinYear' =>$FinYear,
                                'TugName' => strtoupper($this->input->post('TugName')),
                                'FuelConsumption' =>trim($this->input->post('FuelConsumption')),
                                'MonsoonFO' =>trim($this->input->post('tgMonsoonFO')),
                                'FuelCostPerTonofBL' =>trim($this->input->post('FuelCostPerTonofBL')),
                                'OtherCostsTonofBL' => trim($this->input->post('OtherCostsTonofBL'))
                            );
                            
                             $where =array('ID'=>$id);
                            $this->jsw_model->update_data_info('dbo.tblFlotillaPerformance',$data,$where);
                            echo 1;
                           // $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Tugs Details Updated Successfully'));
                           // redirect(base_url() . 'tugs');
                         //}
                    }
            
            
        }
        
        public function delete($id){
                $where =array('ID'=>$id);
                $this->jsw_model->delete_data_info('dbo.tblFlotillaPerformance',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i> Tugs Details Deleted Successfully'));
                redirect(base_url() . 'tugs');
        }
       
       
        
}
