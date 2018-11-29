<?php $data_info = $this->db->get_where('dbo.tblPortOperationPerformance', array('id' => $param2))->result_array();
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
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>" <?php if(($row['Month'])==trim($mon['MonName'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo ($mon['MonName']);?></option>                                      
                                         <?php }?>  
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="year" name="year" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                       <option value="<?php echo $prev = (date('Y')-1);?>" <?php if(($row['Year'])== $prev){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo $curr = date('Y');?>" <?php if(($row['Year'])== $curr){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y');?></option>
                                        <option value="<?php echo $post = date('Y')+1;?>" <?php if(($row['Year'])== $post){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')+1;?></option>
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
                                        <option value="<?php echo ($eqpm['MainType']);?>" <?php if(($row['MainType'])== ($eqpm['MainType'])){ echo 'selected'; }else{ echo ''; } ?>><?php echo ($eqpm['MainType']);?></option>
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
                                        <option value="<?php echo ($eqp['Cargo']);?>" <?php if(($row['Cargo'])==($eqp['Cargo'])){ echo 'selected'; }else{ echo ''; } ?>><?php echo ($eqp['Cargo']);?></option>
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
                                        <option value="<?php echo ($eqp1['SubCargo']);?>" <?php if(($row['SubCargo'])==($eqp1['SubCargo'])){ echo 'selected'; }else{ echo ''; } ?>><?php echo ($eqp1['SubCargo']);?></option>
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
                                        <option value="<?php echo ($eqpt['Type']);?>" <?php if(($row['Type'])== ($eqpt['Type'])){ echo 'selected'; }else{ echo ''; } ?>><?php echo ($eqpt['Type']);?></option>
                                      <?php } ?> 
                                            
                                    </select>
                                </th>
                             </tr> 
                             <tr>
                                 <th>Budget :<span class="required">*</span></th>
                                <th>
                                    <input type="text" id="Budget" name="Budget" value="<?php echo ($row['Budget']);?>"  autocomplete="off" placeholder="Budget" required="" class="form-control">
                                </th>
                                 <th>
                                     Actual:<span class="required">*</span>
                                 </th>
                                  <th>
                                    <input type="text" id="Actual" name="Actual" value="<?php echo ($row['Actual']);?>"  autocomplete="off" placeholder="Actual" required="" class="form-control">
                                </th>
                             </tr>
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="editPortOperational" class="btn btn-success" value="save"><i class="material-icons">edit</i> Update</button>
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
    $("#editPortOperational").click(function(){
      $("#editPortOperational").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#Month").val();
      $monthid= $("#Month").find('option:selected').attr('data-id');
      $year= $("#year").val();
      $MainType= $("#MainType").val();
      $Cargo= $("#Cargo").val();
      $SubCargo= $("#SubCargo").val();
      $Type= $("#Type").val();
      $Budget= $("#Budget").val();
      $Actual= $("#Actual").val();
      $.post('<?php echo base_url();?>portOperational/Update/<?php echo $param2; ?>', { Month: $Month,monthid:$monthid,year:$year,MainType:$MainType,Cargo:$Cargo,SubCargo:$SubCargo,Type:$Type,Budget:$Budget,Actual:$Actual }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Port Operational Performance Details Updated Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#editPortOperational").html('<i class="material-icons">edit</i> Update');
                          }
		});
      
    });
});
</script>