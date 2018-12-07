<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mhsPerformance extends CI_Controller {

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
            $data['title'] = "MHS Performance";
            $data['icons'] = "brightness_high";
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');            
            $this->load->view('jsw/searchMhs',$data);;
	}     
        
         public function searchMhs(){            
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
                                'Type' => 'MHS');
                         $mhsPerformance_info= $this->jsw_model->check_data_info('dbo.TblMHSPerformanceEC',$cond);                         
                        $this->mhsPerformance($mhsPerformance_info);
                     }                   
            
        }
        
        
        public function mhsPerformance($mhsPerformance_info){
                        $data['title'] = "MHS Performance";
                        $data['icons'] = "brightness_high";
                        $data['mhsPerformance_info'] =  $mhsPerformance_info;
                        $this->load->view('jsw/mhsPerformance',$data);        
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
                                'Type' =>'MHS',
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
                                'Type' =>'MHS',
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
        
        public function getValues(){
            $this->form_validation->set_rules('Equipment', 'Equipment', 'required');
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            $data['errors']= validation_errors();
                            $data['err']= 1;
                            echo json_encode($data);  
                    }
                    else
                     {
             $Equipment = $this->input->post('Equipment');
             $Month = $this->input->post('Month');
             $year = $this->input->post('year');
             
            $qry="DECLARE @MON varchar(10)='$Month' ,@YEAR INT=$year, @eqptNm varchar(MAX)= '$Equipment'

SELECT eqpt,TYPE,SUM(actualdurmin) actualdurmin, SUM(actualdurmin)/60 actualdurhr ,A,B FROM(
select DISTINCT EqptNo
              ,MOTYPE
			  ,MONumber
			  ,(SELECT DISTINCT S.Equipment FROM tblEqptMasterSAP S WHERE S.EqptNo=h.EqptNo AND S.Equipment =@eqptNm) eqpt
			  ,h.SortField
			  ,CASE WHEN MOTYPE='JM01' THEN 'CM'
              WHEN MOTYPE='JM02' THEN 'PM'
			  WHEN MOTYPE='JM03' THEN 'BD'
			  END TYPE
			   
			  ,CAST(CAST(convert(date,actualstart,104) AS VARCHAR(10))+' ' + (case when left(actualtime,2)=24 then replace(actualtime,24,00) else actualtime end)  AS DATETIME) start_dttm
              ,CAST(CAST(convert(date,FinishDate,104) AS VARCHAR(10)) +' ' + (case when left(FinishTime,2)=24 then replace(FinishTime,24,00) else actualtime end)  AS DATETIME) END_dttm 
			  ,h.durUnit
			  ,h.ActualDur  ActualDur
			  ,case when h.durUnit='h' or h.durUnit='HR' then cast(ActualDur as float) *60.00 else  ActualDur end actualdurmin
			  ,DATENAME(MONTH,convert(date,FinishDate,104)) A
			  ,DATENAME(YEAR,convert(date,FinishDate,104)) B

from tblRunning_Hours H 
where  plantcode=5110  
AND DATENAME(MONTH,convert(date,FinishDate,104))=@MON 
AND DATENAME(YEAR,convert(date,FinishDate,104))=@YEAR
)A
GROUP BY eqpt,TYPE,A,B";
               $mhs_info =  $this->db->query($qry)->result_array();
                    $data['err']= 0;
               foreach ($mhs_info as $gv){
                   //$data['get_data']=array(); 
                   if(!empty($gv['eqpt']) && $gv['TYPE']=='BD'){ 
                       $data['bd'] = $gv['actualdurhr'];
                   }
                    elseif(!empty($gv['eqpt']) && $gv['TYPE']=='PM'){
                      $data['pm'] = $gv['actualdurhr'];
                   }
                   elseif(!empty($gv['eqpt']) && $gv['TYPE']=='CM'){   
                       $data['cm'] = $gv['actualdurhr'];
                   }
               }
                 echo json_encode($data);  
            }
               
        }

                public function delete($id){
                $where =array('id'=>$id);
                $this->jsw_model->delete_data_info('dbo.TblMHSPerformanceEC',$where);
                $this->session->set_flashdata('msg', ('<i class="material-icons">check_circle_outline</i>  MHS Performance Deleted Successfully'));
                redirect(base_url() . 'mhsPerformance');
        }
       
        
}
