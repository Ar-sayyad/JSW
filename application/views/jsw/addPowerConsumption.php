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
                                <th>Mode :<span class="required">*</span></th>
                                <th>
                                     <select id="Mode" name="Mode" placeholder="Mode" required="" class="form-control">
                                        <option value="">---Select Mode---</option>
                                        <?php $qry = "Select DISTINCT Mode from tblMaintenancePowerConsumption";                                        
                                      $exist = $this->db->query($qry)->result_array();
                                      foreach($exist as $md){?>                                        
                                        <option value="<?php echo trim($md['Mode']);?>"><?php echo trim($md['Mode']);?></option>
                                      <?php } ?>                                        
                                    </select>
                                </th>

                            <th>Cargo :<span class="required">*</span></th>
                                <th>
                                     <select id="Cargo" name="Cargo" placeholder="Cargo" required="" class="form-control">
                                        <option value="">---Select Cargo---</option>
                                        <?php $crg = "Select DISTINCT Cargo from tblMaintenancePowerConsumption";                                        
                                      $crgo = $this->db->query($crg)->result_array();
                                      foreach($crgo as $cr){?>                                        
                                        <option value="<?php echo trim($cr['Cargo']);?>"><?php echo trim($cr['Cargo']);?></option>
                                      <?php } ?> 
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>Berth :<span class="required">*</span></th>
                                <th>
                                     <select id="Berth" name="Berth" placeholder="Berth" required="" class="form-control">
                                        <option value="">---Select Berth---</option>
                                        <?php $Berth = "Select DISTINCT Berth from tblMaintenancePowerConsumption";                                        
                                      $Bert= $this->db->query($Berth)->result_array();
                                      foreach($Bert as $Ber){?>                                        
                                        <option value="<?php echo trim($Ber['Berth']);?>"><?php echo trim($Ber['Berth']);?></option>
                                      <?php } ?> 
                                    </select>
                                </th>
                                <th>Target :<span class="required">*</span></th>
                                <th>
                                    <input type="text" id="Target" name="Target" autocomplete="off" placeholder="Target" required="" class="form-control">
                                </th>
                             </tr> 
                             <tr>
                                 <th>
                                     Actual:<span class="required">*</span>
                                 </th>
                                  <th>
                                    <input type="text" id="Actual" name="Actual" autocomplete="off" placeholder="Actual" required="" class="form-control">
                                </th>
                                 <th colspan="2">&nbsp;</th>
                             </tr>
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="savePowerConsumption" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#savePowerConsumption").click(function(){
      $("#savePowerConsumption").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#Month").val();
      $monthid= $("#Month").find('option:selected').attr('data-id');
      $year= $("#year").val();
      $Mode= $("#Mode").val();
      $Cargo= $("#Cargo").val();
      $Berth= $("#Berth").val();
      $Target= $("#Target").val();
      $Actual= $("#Actual").val();
      $.post('<?php echo base_url();?>powerConsumption/save', { Month: $Month,monthid:$monthid,year:$year,Mode:$Mode,Cargo:$Cargo,Berth:$Berth,Target:$Target,Actual:$Actual }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Power Consumption Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#savePowerConsumption").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>