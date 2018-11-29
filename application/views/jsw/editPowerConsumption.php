<?php $data_info = $this->db->get_where('dbo.tblMaintenancePowerConsumption', array('ID' => $param2))->result_array();
 foreach ($data_info as $row) {
?>
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
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>" <?php if(trim($row['Month'])==trim($mon['MonName'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo trim($mon['MonName']);?></option>                                      
                                          <?php }?>  
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="year" name="year" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo $prev = (date('Y')-1);?>" <?php if(trim($row['year'])== $prev){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo $curr = date('Y');?>" <?php if(trim($row['year'])== $curr){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y');?></option>
                                        <option value="<?php echo $post = date('Y')+1;?>" <?php if(trim($row['year'])== $post){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')+1;?></option>
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
                                        <option value="<?php echo trim($md['Mode']);?>" <?php if(trim($row['Mode'])== trim($md['Mode'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo trim($md['Mode']);?></option>
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
                                        <option value="<?php echo trim($cr['Cargo']);?>" <?php if(trim($row['Cargo'])== trim($cr['Cargo'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo trim($cr['Cargo']);?></option>
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
                                        <option value="<?php echo trim($Ber['Berth']);?>" <?php if(trim($row['Berth'])== trim($Ber['Berth'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo trim($Ber['Berth']);?></option>
                                      <?php } ?> 
                                    </select>
                                </th>
                                <th>Target :<span class="required">*</span></th>
                                <th>
                                    <input type="text" id="Target" name="Target" value="<?php echo ($row['Target']);?>" autocomplete="off" placeholder="Target" required="" class="form-control">
                                </th>
                             </tr> 
                             <tr>
                                 <th>
                                     Actual:<span class="required">*</span>
                                 </th>
                                  <th>
                                    <input type="text" id="Actual" name="Actual" value="<?php echo ($row['Actual']);?>" autocomplete="off" placeholder="Actual" required="" class="form-control">
                                </th>
                                 <th colspan="2">&nbsp;</th>
                             </tr>
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="editPowerConsumption" class="btn btn-success" value="save"><i class="material-icons">edit</i> Update</button>
                                     <!--<input type="reset" name="Reset" class="btn btn-info" value="reset">-->
                                </th>
                            </tr>

                        </thead>

                    </table>
                </form>
                </div>
            </div>
        </div>	


</div>
 <?php } ?>
<script>
   $(document).ready(function(){
    $("#editPowerConsumption").click(function(){
      $("#editPowerConsumption").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#Month").val();
      $monthid= $("#Month").find('option:selected').attr('data-id');
      $year= $("#year").val();
      $Mode= $("#Mode").val();
      $Cargo= $("#Cargo").val();
      $Berth= $("#Berth").val();
      $Target= $("#Target").val();
      $Actual= $("#Actual").val();
      $.post('<?php echo base_url();?>powerConsumption/update/<?php echo $param2;?>', { Month: $Month,monthid:$monthid,year:$year,Mode:$Mode,Cargo:$Cargo,Berth:$Berth,Target:$Target,Actual:$Actual }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Power Consumption Details Updated Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#editPowerConsumption").html('<i class="material-icons">edit</i> Update');
                          }
		});
      
    });
});
</script>