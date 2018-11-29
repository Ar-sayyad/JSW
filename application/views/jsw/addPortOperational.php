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
                                     <select id="MainType" name="MainType" placeholder="MainType" required="" class="form-control">
                                        <option value="">---Select Main Type---</option>
                                         <?php $qrym = "Select DISTINCT MainType from tblPortOperationPerformance";                                        
                                      $existm = $this->db->query($qrym)->result_array();
                                      foreach($existm as $eqpm){?>                                        
                                        <option value="<?php echo ($eqpm['MainType']);?>"><?php echo ($eqpm['MainType']);?></option>
                                      <?php } ?> 
                                    </select>
                                </th>

                            <th>Cargo :<span class="required">*</span></th>
                                <th>
                                     <select id="Cargo" name="Cargo" placeholder="Cargo" required="" class="form-control">
                                        <option value="">---Select Cargo---</option>
                                         <?php $qry = "Select DISTINCT Cargo from tblPortOperationPerformance";                                        
                                      $exist = $this->db->query($qry)->result_array();
                                      foreach($exist as $eqp){?>                                        
                                        <option value="<?php echo ($eqp['Cargo']);?>"><?php echo ($eqp['Cargo']);?></option>
                                      <?php } ?>  
                                       
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>Berth :<span class="required"></span></th>
                                <th>
                                     <select id="SubCargo" name="SubCargo" placeholder="SubCargo" required="" class="form-control">
                                        <option value="">---Select Berth---</option>
                                        <?php $qry1 = "Select DISTINCT SubCargo from tblPortOperationPerformance";                                        
                                      $exist1 = $this->db->query($qry1)->result_array();
                                      foreach($exist1 as $eqp1){?>                                        
                                        <option value="<?php echo ($eqp1['SubCargo']);?>"><?php echo ($eqp1['SubCargo']);?></option>
                                      <?php } ?> 
                                    </select>
                                </th>
                                
                                <th>Type :<span class="required">*</span></th>
                                <th>
                                     <select id="Type" name="Type" placeholder="Type" required="" class="form-control">
                                        <!--<option value="">---Select Type---</option>-->
                                        <?php $qryt = "Select DISTINCT Type from tblPortOperationPerformance";                                        
                                      $existt = $this->db->query($qryt)->result_array();
                                      foreach($existt as $eqpt){?>                                        
                                        <option value="<?php echo ($eqpt['Type']);?>" <?php if(($eqpt['Type'])== $param2){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo ($eqpt['Type']);?></option>
                                      <?php } ?> 
                                            
                                    </select>
                                </th>
                             </tr> 
                             <tr>
                                 <th>Budget :<span class="required">*</span></th>
                                <th>
                                    <input type="text" id="Budget" name="Budget" autocomplete="off" placeholder="Budget" required="" class="form-control">
                                </th>
                                 <th>
                                     Actual:<span class="required">*</span>
                                 </th>
                                  <th>
                                    <input type="text" id="Actual" name="Actual" autocomplete="off" placeholder="Actual" required="" class="form-control">
                                </th>
                             </tr>
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="savePortOperational" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#savePortOperational").click(function(){
      $("#savePortOperational").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#Month").val();
      $monthid= $("#Month").find('option:selected').attr('data-id');
      $year= $("#year").val();
      $MainType= $("#MainType").val();
      $Cargo= $("#Cargo").val();
      $SubCargo= $("#SubCargo").val();
      $Type= $("#Type").val();
      $Budget= $("#Budget").val();
      $Actual= $("#Actual").val();
      $.post('<?php echo base_url();?>portOperational/save', { Month: $Month,monthid:$monthid,year:$year,MainType:$MainType,Cargo:$Cargo,SubCargo:$SubCargo,Type:$Type,Budget:$Budget,Actual:$Actual }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Port Operational Performance Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#savePortOperational").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>