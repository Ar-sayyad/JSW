<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class marinePerformance extends CI_Controller {

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
            $data['title'] = "Marine Performance";
            $data['icons'] = "waves";
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');
            $this->load->view('jsw/searchmarine',$data);
	}     
        
       
            
        public function marineSearch(){
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                              //$this->session->set_flashdata('msg',
                                redirect(base_url() . 'marinePerformance');
                    }
                    else
                     { 
                        $month = $this->input->post('month');
                        $year = $this->input->post('year');
                       
                        if($month==12){
                            $tmonth = 1;
                            $tyear = $year+1;
                        }else{
                            $tmonth = $month+1;
                            $tyear = $year;
                        }                        
                        
                        $fromdate = ($year.'-'.$month.'-01 07:00');
                        $todate = ($tyear.'-'.$tmonth.'-01 07:00');                        
                        
                        $qry = "DECLARE  @fromdate datetime='$fromdate' , @Todate datetime='$todate'

SELECT  A.VESSEL_NAME
       ,A.VAN_ID
       ,A.VAN_NUM
       ,A.VESSEL_CATEGORY
       ,A.BERTH_NAME
       ,A.CARGO_TYPE
       ,DATEDIFF(MINUTE,A.BERTH,A.AF) POB_AF
       ,CAST((DATEDIFF(MINUTE,A.BERTH,A.AF)/60) AS VARCHAR) +':'+ CAST((DATEDIFF(MINUTE,A.BERTH,A.AF)%60) AS VARCHAR) D_POB_AF
       ,DATEDIFF(MINUTE,AF,COMNCED) AF_COMM
       ,CAST((DATEDIFF(MINUTE,AF,COMNCED)/60) AS VARCHAR) +':'+ CAST((DATEDIFF(MINUTE,AF,COMNCED)%60) AS VARCHAR) D_AF_COMM
       ,DATEDIFF(MINUTE,COMPLT,POB_UNBERTHING) COMM_POB
       ,CAST((DATEDIFF(MINUTE,COMPLT,POB_UNBERTHING)/60) AS VARCHAR) +':'+ CAST((DATEDIFF(MINUTE,COMPLT,POB_UNBERTHING)%60) AS VARCHAR) D_COMM_POB
       ,DATEDIFF(MINUTE,POB_UNBERTHING,CO) COMM
       ,CAST((DATEDIFF(MINUTE,POB_UNBERTHING,CO)/60) AS VARCHAR) +':'+ CAST((DATEDIFF(MINUTE,POB_UNBERTHING,CO)%60) AS VARCHAR) D_COMM
       ,(select distinct remarks from tbl_MarinePerformRemarks M WHERE M.VAN_ID=A.VAN_ID) Remarks
 FROM (
SELECT DISTINCT V.VESSEL_NAME, 
       V.VAN_ID,
       v.VAN_NUM,
       STUFF((select DISTINCT ',' + commodity_type from tblVesselwiseOperation W WHERE W.VAN_ID=V.VAN_ID FOR XML PATH('')),1,1,'') CARGO_TYPE,
       (SELECT DISTINCT VD.VESSEL_CATEGORY_NAME FROM tblVesselCallNumber VD WHERE VD.ID=V.VAN_ID ) VESSEL_CATEGORY,
       (SELECT DISTINCT VD.ACTUAL_BERTH FROM tblPilotageRec VD WHERE VD.VAN_ID=V.VAN_ID  AND OPERATION_MOVEMENT='BERTHING') BERTH_NAME,
       (SELECT DISTINCT MIN(VD.PILOT_BOARD_TIME) FROM tblPilotageRec VD WHERE VD.VAN_ID=V.VAN_ID  AND OPERATION_MOVEMENT='BERTHING') BERTH,
       (SELECT DISTINCT MIN(VD.ALL_FAST_TIME) FROM tblPilotageRec VD WHERE VD.VAN_ID=V.VAN_ID AND VD.ALL_FAST_TIME IS NOT NULL) AF,
 
       V.DISCHRG_CMNCD_ANCHRG_TM COMNCED,
       V.DISCHARGE_COMPLETED_TIME COMPLT,
       isnull((SELECT DISTINCT max(VD.LAST_LINE_CAST_OFF) FROM tblPilotageRec VD WHERE VD.VAN_ID=V.VAN_ID AND OPERATION_MOVEMENT='UNBERTHING'), @Todate)  CO,
      
       (SELECT DISTINCT ISNULL(max(VD.PILOT_BOARD_TIME),@Todate) FROM tblPilotageRec VD WHERE VD.VAN_ID=V.VAN_ID AND OPERATION_MOVEMENT='UNBERTHING') POB_UNBERTHING
     
        FROM tblVesselDetailLDUD V
WHERE 
V.DISCHARGE_COMPLETED_TIME BETWEEN @fromdate AND @Todate
AND V.VAN_ID NOT IN (SELECT DISTINCT ID FROM tblVesselCallNumber N WHERE N.VESSEL_CATEGORY_CODE='MBC')
AND V.PORTDETAIL_CODE=5110
GROUP BY V.VESSEL_NAME, 
       V.VAN_ID,
       V.ID,
       V.DISCHRG_CMNCD_ANCHRG_TM,
       V.DISCHARGE_COMPLETED_TIME,
       V.LAST_LINE_CAST_OFF,v.VAN_NUM
)A";
                        //echo $qry;
                       // die();
                         
                          //$data['title'] = "Marine Performance - MBCs";
                          //$data['icons'] = "format_align_left";
                          //$data['mbcs_info'] =  $this->db->query($qry)->result_array();
                          $this->marine($qry);
                         //$this->load->view('jsw/mbcs',$data);
                     }
                    
            
        }
        function marine($qry){
                       // $data['qry']=$qry;
                        $data['title'] = "Marine Performance";
                        $data['icons'] = "waves";
                        $data['marinePerformance_info'] =  $this->db->query($qry)->result_array();
                        //print_r($data);
                        $this->load->view('jsw/marinePerformance',$data);
        }
        
         public function save(){
            $this->form_validation->set_rules('van_id', '', 'required');
            $this->form_validation->set_rules('van_num', '', 'required');
            $this->form_validation->set_rules('vessel_name', '', 'required');
            $this->form_validation->set_rules('Remarks', 'Remarks', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {   
                           $cond = array('van_id' => trim($this->input->post('van_id')),
                                'van_num' => trim($this->input->post('van_num')));
                         $exist = $this->jsw_model->check_data_info('dbo.tbl_MarinePerformRemarks',$cond);                         
                         if($exist){
                                 $data= array(
                                'van_num' => trim($this->input->post('van_num')),
                                'vessel_name' => trim($this->input->post('vessel_name')),
                                'Remarks' => trim($this->input->post('Remarks'))
                            );
                                $where =array('van_id'=>trim($this->input->post('van_id')));
                            $this->jsw_model->update_data_info('dbo.tbl_MarinePerformRemarks',$data,$where);
                            echo 1;
                         }else{
                            $data= array(
                                'van_id' => trim($this->input->post('van_id')),
                                'van_num' => trim($this->input->post('van_num')),
                                'vessel_name' => trim($this->input->post('vessel_name')),
                                'Remarks' => trim($this->input->post('Remarks'))
                            );
                            $this->jsw_model->save_data_info('dbo.tbl_MarinePerformRemarks',$data);
                           echo 1;
                    }
                     }
            
            
        }
       
        
}
