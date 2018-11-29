<div class="row main-section">			
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="table form">                                                
                        <thead class="">

                            <tr>
                                <th> Select Month :<span class="required">*</span></th>
                                <th>
                                    <select id="Month" name="Month" placeholder="Month" required="" class="clsmon form-control">
                                        <option value="">---Select Month---</option>
                                         <?php foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php }?>  
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="year" name="year" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                        <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
<!--                                <th>Type :<span class="required">*</span></th>
                                <th>
                                     <select id="Type" name="Type" placeholder="Type" required="" class="form-control">
                                        <option value="">---Select Type---</option>
                                        <option value="MHS">MHS</option>
                                        <option value="HE">HE</option>
                                    </select>
                                </th>-->

                            <th>Equipment :<span class="required">*</span></th>
                                <th>
                                     <select id="Equipment" name="Equipment" placeholder="Equipment" required="" class="form-control">
                                          <option value="">---Select Equipment---</option>
                                         <?php $qry = "Select DISTINCT Equipment from TblMHSPerformanceEC where Type='HEME'";                                        
                                      $exist = $this->db->query($qry)->result_array();
                                      foreach($exist as $eqp){?>                                        
                                        <option value="<?php echo trim($eqp['Equipment']);?>"><?php echo trim($eqp['Equipment']);?></option>
                                      <?php } ?>                                        
                                    </select>
                                </th>
                            
                                 <th>RN :<span class="required">*</span></th>
                                <th>
                                    <input type="text" id="RN" name="RN" autocomplete="off" placeholder="RN" required="" class="form-control">
                                </th>
                                </tr>                           
                             <tr>
                                 <th>
                                     BD:<span class="required">*</span>
                                 </th>
                                  <th>
                                    <input type="text" id="BD" name="BD" autocomplete="off" placeholder="BD" required="" class="form-control">
                                </th>
                            
                                 <th>PM :<span class="required">*</span></th>
                                <th>
                                    <input type="text" id="PM" name="PM" autocomplete="off" placeholder="PM" required="" class="form-control">
                                </th>
                                 </tr>
                             <tr>
                                 <th>
                                     CM:<span class="required">*</span>
                                 </th>
                                  <th>
                                    <input type="text" id="CM" name="CM" autocomplete="off" placeholder="CM" required="" class="form-control">
                                </th>
                             
                                 <th>Remark :<span class="required">*</span></th>
                                <th>
                                    <textarea id="Remarks" name="Remarks" autocomplete="off" placeholder="Remarks" required="" class="form-control"></textarea>
                                </th>
                                </tr>
                              <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="saveHemePerformance" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
                                    <button type="reset" name="Reset" class="btn btn-info" value="reset"><i class="material-icons">replay</i> Reset</button>
                                </th>
                            </tr>

                        </thead>

                    </table>
                </form>
                </div>
            </div>
        </div>	


</div>
<script>
   $(document).ready(function(){
    $("#saveHemePerformance").click(function(){
      $("#saveHemePerformance").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#Month").val();
      $monthid= $("#Month").find('option:selected').attr('data-id');
      $year= $("#year").val();
      //$Type= $("#Type").val();
      $Equipment= $("#Equipment").val();
      $RN= $("#RN").val();
      $BD= $("#BD").val();
      $PM= $("#PM").val();
      $CM= $("#CM").val();
      $Remark= $("#Remarks").val();
      $.post('<?php echo base_url();?>hemePerformance/save', { Month: $Month,monthid:$monthid,year:$year,Equipment:$Equipment,RN:$RN,BD:$BD,PM:$PM,CM:$CM,Remark:$Remark }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> HEME Performance Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveHemePerformance").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>