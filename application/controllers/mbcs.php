<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mbcs extends CI_Controller {

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
            $data['title'] = "Marine Performance - MBCs";
            $data['icons'] = "format_align_left";                    
            $data['month_info'] = $this->jsw_model->select_data_info('dbo.tblMonth');
            $this->load->view('jsw/searchmbcs',$data);
	}     
        
        public function mbcsSearch(){
            $this->form_validation->set_rules('month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                              $this->session->set_flashdata('err_msg',validation_errors());
                              //$this->session->set_flashdata('msg',
                                redirect(base_url() . 'mbcs');
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
                        
                         //$month1= $month-3;
                             if ( $month > 3 ) {
                                $FinYear = ($year);
                            }
                            else {
                                $FinYear = ($year - 1);
                            }
                        
                        $fromdate = ($year.'-'.$month.'-01 07:00');
                        $todate = ($tyear.'-'.$tmonth.'-01 07:00');
                        $finfromdate = ($FinYear.'-04-01 00:00');
                        $fintodate = (($FinYear+1).'-03-01 00:00');                     
                        
                        $qry = "DECLARE  @fromdate datetime='$fromdate' , @Todate datetime='$todate' , @FinFromDate DATETIME='$finfromdate'

SELECT     MON, VESSEL_NAME,
(select distinct Trip from tbl_MarineMBCRemarks M where M.MONTH=MON AND M.YEAR=YEAR AND M.FinYear=FinYear AND M.MBCName=Vessel_name)  TRIP,
  (select distinct Quantity from tbl_MarineMBCRemarks M where M.MONTH=MON AND M.YEAR=YEAR AND M.FinYear=FinYear AND M.MBCName=Vessel_name) QTY,year , Finyear
        ,(select distinct Remarks from tbl_MarineMBCRemarks M where M.MONTH=MON AND M.YEAR=YEAR AND M.FinYear=FinYear AND M.MBCName=Vessel_name) Remarks
        ,(select distinct id from tbl_MarineMBCRemarks M where M.MONTH=MON AND M.YEAR=YEAR AND M.FinYear=FinYear AND M.MBCName=Vessel_name) RID
        ,(select distinct Cost from tbl_MarineMBCRemarks M where M.MONTH=MON AND M.YEAR=YEAR AND M.FinYear=FinYear AND M.MBCName=Vessel_name) COST
FROM         (
SELECT DISTINCT DATENAME(MONTH, DISCHARGE_COMPLETED_TIME) AS MON, VESSEL_NAME
                   , VAN_NUM, VAN_ID, TOTAL_DISCHARGE_QUANTITY AS QTY , DATENAME(year, DISCHARGE_COMPLETED_TIME) AS year
                   ,CASE WHEN Month(DISCHARGE_COMPLETED_TIME)  >= 4 and day(DISCHARGE_COMPLETED_TIME)<> 1  
                         THEN Cast( Year( DISCHARGE_COMPLETED_TIME) AS VARCHAR) + '-' + Cast(Year( DISCHARGE_COMPLETED_TIME) + 1 AS VARCHAR) 
                         WHEN Month(DISCHARGE_COMPLETED_TIME)  = 4 and day(DISCHARGE_COMPLETED_TIME)=1  AND CAST(DISCHARGE_COMPLETED_TIME AS TIME) <'7:00'
                         then Cast(Year( DISCHARGE_COMPLETED_TIME) - 1 AS VARCHAR) + '-' + Cast(Year( DISCHARGE_COMPLETED_TIME) AS VARCHAR)
                         WHEN Month(DISCHARGE_COMPLETED_TIME)  >= 4 and day(DISCHARGE_COMPLETED_TIME)= 1  AND CAST(DISCHARGE_COMPLETED_TIME AS TIME) >='7:00'
                         THEN Cast( Year( DISCHARGE_COMPLETED_TIME) AS VARCHAR) + '-' + Cast(Year( DISCHARGE_COMPLETED_TIME) + 1 AS VARCHAR) 
                         When Month(DISCHARGE_COMPLETED_TIME) < 4 
                         THEN Cast(Year( DISCHARGE_COMPLETED_TIME) - 1 AS VARCHAR) + '-' + Cast(Year( DISCHARGE_COMPLETED_TIME) AS VARCHAR) 
                         END FinYear

                       FROM          tblVesselwiseOperation AS V
                       WHERE      (DISCHARGE_COMPLETED_TIME BETWEEN @fromdate AND @Todate) AND (VESSEL_NAME IN ('MV JSW RAIGAD', 'MV JSW PRATAPGAD'))
                       ) AS A
GROUP BY MON, VESSEL_NAME,year,Finyear
UNION ALL
SELECT     'YTD' AS MON, VESSEL_NAME, COUNT(VAN_NUM) AS TRIP, SUM(QTY) AS QTY, year,FinYear
              ,(select distinct Remarks from tbl_MarineMBCRemarks M where M.MONTH='YTD' AND M.FinYear=FinYear AND M.MBCName=Vessel_name) Remarks
              ,(select distinct id from tbl_MarineMBCRemarks M where M.MONTH='YTD' AND M.FinYear=FinYear AND M.MBCName=Vessel_name) RID
              ,(select distinct Cost from tbl_MarineMBCRemarks M where M.MONTH='YTD' AND M.FinYear=FinYear AND M.MBCName=Vessel_name) COST

FROM         (SELECT DISTINCT VESSEL_NAME, VAN_NUM, VAN_ID, TOTAL_DISCHARGE_QUANTITY AS QTY , datename (year,@FinFromDate) year 
            , cast (datename (year,@FinFromDate) as varchar(4))+'-'+  cast (datename (year,@FinFromDate)+1 as varchar(4)) FinYear
                       FROM          tblVesselwiseOperation AS V
                       WHERE      (DISCHARGE_COMPLETED_TIME BETWEEN @FinFromDate AND @Todate) AND (VESSEL_NAME IN ('MV JSW RAIGAD', 'MV JSW PRATAPGAD'))) 
                      AS A_1
GROUP BY VESSEL_NAME,year,FinYear";
                      
                         
                          $this->mbcs($qry);
                     }
                    
            
        }
        function mbcs($qry){
                        $data['title'] = "Marine Performance - MBCs";
                        $data['icons'] = "format_align_left";
                        $data['mbcs_info'] =  $this->db->query($qry)->result_array();
                        $this->load->view('jsw/mbcs',$data);
        }
        
         public function save(){
            $this->form_validation->set_rules('Month', 'Month', 'required');
            $this->form_validation->set_rules('year', 'year', 'required');
            $this->form_validation->set_rules('Finyear', 'Finyear', 'required');
            $this->form_validation->set_rules('Cost', 'Cost', 'required');
            $this->form_validation->set_rules('Trip', 'Trip', 'required');
            $this->form_validation->set_rules('Quantity', 'Quantity', 'required');
            $this->form_validation->set_rules('MBCName', 'MBCName', 'required');
            $this->form_validation->set_rules('Remarks', 'Remarks', 'required');
            if ($this->form_validation->run() == FALSE)
                     {
                            echo validation_errors();
                            //redirect(base_url() . 'tugs');
                    }
                    else
                     {   
                        $ID = $this->input->post('RID');
                        if(!empty($ID)){
                           $cond = array('ID' => trim($this->input->post('RID')));
                         $exist = $this->jsw_model->check_data_info('dbo.tbl_MarineMBCRemarks',$cond);
                         if($exist){
                               $data= array(
                                'Trip' =>trim($this->input->post('Trip')),
                                'Quantity' => trim($this->input->post('Quantity')),
                                'Cost' =>trim($this->input->post('Cost')),
                                'Remarks' => trim($this->input->post('Remarks'))
                            );
                               $where =array('ID' => trim($this->input->post('RID')));
                            $this->jsw_model->update_data_info('dbo.tbl_MarineMBCRemarks',$data,$where);
                            echo 1;
                         }
                        }else{
                            $data= array(
                                'Month' => trim($this->input->post('Month')),
                                'year' => trim($this->input->post('year')),
                                'Finyear' => trim($this->input->post('Finyear')),
                                'Cost' =>trim($this->input->post('Cost')),
                                'Trip' =>trim($this->input->post('Trip')),
                                'Quantity' => trim($this->input->post('Quantity')),
                                'Remarks' => trim($this->input->post('Remarks')),
                                'MBCName' => trim($this->input->post('MBCName'))
                            );
                            $this->jsw_model->save_data_info('dbo.tbl_MarineMBCRemarks',$data);
                           echo 1;
                    }
                     }
            
            
        }
       
        
}
