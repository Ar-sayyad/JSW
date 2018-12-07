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
                                    <select id="maintenanceCostMonth" name="MONTH" placeholder="month" required="" class="clsmon form-control">
                                        <option value="">---Select Month---</option>
                                         <?php foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php }?>  
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="maintenanceCostYear" name="YEAR" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                        <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>Department :<span class="required">*</span></th>
                                <th>
                                     <select id="maintenanceCostDept" name="Dept" placeholder="Dept" required="" class="form-control">
                                        <option value="">---Select Department---</option>
                                        <option data-main="Maintenance" value="Electrical">Electrical</option>
                                        <option data-main="Maintenance" value="Mechanical">Mechanical</option>
                                        <option data-main="Maintenance" value="Civil">Civil</option>
                                        <option data-main="Water" value="Water">Water</option>
                                    </select>
                                </th>
                                 <th>Type :<span class="required">*</span></th>
                                <th>
                                    <select id="maintenanceCostType" name="Type" placeholder="Type" required="" class="form-control">
                                        <option value="">---Select Type---</option>
                                        <option value="Actual" <?php if($param2=='Actual'){ echo 'Selected';}else { echo 'disabled'; } ?>>Actual</option>
                                        <option value="Budget" <?php if($param2=='Budget'){ echo 'Selected';}else { echo 'disabled'; } ?>>Budget</option>
                                    </select>
                                </th>
                               </tr>
                            <tr>
                                <th>Value:<span class="required">*</span> </th>
                                <th><input type="text" id="maintenanceCostBudget" name="maintenanceCostBudget" autocomplete="off" placeholder="Value" required="" class="form-control"></th>
                            
                                <th colspan="2">&nbsp;</th>
                             </tr>  
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="saveMaintenanceCost" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#saveMaintenanceCost").click(function(){
      $("#saveMaintenanceCost").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#maintenanceCostMonth").val();
      $monthid= $("#maintenanceCostMonth").find('option:selected').attr('data-id');
      $Year= $("#maintenanceCostYear").val();
      $MainDept= $("#maintenanceCostDept").find('option:selected').attr('data-main');
      $Dept= $("#maintenanceCostDept").val();
      $Budget= $("#maintenanceCostBudget").val();
      $Type= $("#maintenanceCostType").val();
      $.post('<?php echo base_url();?>maintenanceCost/save', { Month: $Month,monthid:$monthid,year:$Year,MainDept:$MainDept,Dept:$Dept,Budget:$Budget,Type:$Type }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Maintenance Cost Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveMaintenanceCost").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>