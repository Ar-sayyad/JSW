<?php $data_info = $this->db->get_where('dbo.tblFlotillaPerformance', array('ID' => $param2))->result_array();
 foreach ($data_info as $row) {
?>
<div class="row main-section">
                            <!--<div class="col-lg-1 col-md-12"></div>-->			
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">

                                        <div class="card-content">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <table class="table form">                                                
                                                <thead class="">
                                                   
                                                    <tr>
                                                        <th> Select Month :<span class="required">*</span></th>
                                                        <th>
                                                            <select id="tgMonth" name="Month" placeholder="month" required="" class="form-control">
                                                                <option value="">---Select Month---</option>
                                                                 <?php foreach($month_info as $mon){?>                                       
                                                                    <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>" <?php if(trim($row['Month'])==trim($mon['MonName'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo trim($mon['MonName']);?></option>                                      
                                                                     <?php }?>  
                                                            </select>
                                                        </th>

                                                        <th> Select Year :<span class="required">*</span></th>
                                                        <th>
                                                            <select id="tgYear" name="Year" placeholder="year" required="" class="form-control">
                                                                <option value="">---Select Year---</option>
                                                                <option value="<?php echo $prev = (date('Y')-1);?>" <?php if(trim($row['Year'])== $prev){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')-1;?></option>
                                                                 <option value="<?php echo $curr = date('Y');?>" <?php if(trim($row['Year'])== $curr){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y');?></option>
                                                                <option value="<?php echo $post = date('Y')+1;?>" <?php if(trim($row['Year'])== $post){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')+1;?></option>
                                                            </select>
                                                        </th>
                                                    </tr>
                                                    <tr>
<!--                                                        <th>Financial Year :<span class="required">*</span></th>
                                                        <th>
                                                            <select id="tgFinYear" name="FinYear" placeholder="FinYear" required="" class="form-control">
                                                                <option value="">--Select Financial Year--</option>
                                                                <option value="<?php echo $pref = (date('Y')-1). '-' .(date('Y'));?>" <?php if(trim($row['FinYear'])== $pref){ echo 'selected'; }else{} ?>><?php echo (date('Y')-1). '-' .(date('Y'));?></option>
                                                                <option value="<?php echo $posf = date('Y').'-'.(date('Y') + 1);?>" <?php if(trim($row['FinYear'])== $posf){ echo 'selected'; }else{} ?>><?php echo date('Y').'-'.(date('Y') + 1);?></option>
                                                            </select>
                                                        </th>-->

                                                        <th>Tug Name :<span class="required">*</span> </th>
                                                        <th>
                                                            <select id="tgTugName" name="TugName" placeholder="TugName" required="" class="form-control">
                                                                <option value="">---Select Tug Name---</option>
                                                                 <option value="BHIM" <?php if(trim($row['TugName'])=="BHIM"){ echo 'selected'; }else{echo 'disabled';} ?>>BHIM</option>
                                                                <option value="BAJRANG" <?php if(trim($row['TugName'])== "BAJRANG"){ echo 'selected'; }else{echo 'disabled';} ?>>BAJRANG</option>
                                                                <option value="BALRAM" <?php if(trim($row['TugName'])== "BALRAM"){ echo 'selected'; }else{echo 'disabled';} ?>>BALRAM</option>
                                                            </select>
                                                        </th>
                                                    
                                                        <th>Fuel Consumption:<span class="required">*</span></th>
                                                        <th><input type="text" id="tgFuelConsumption" name="FuelConsumption" value="<?php echo $row['FuelConsumption'];?>" autocomplete="off" placeholder="Fuel Consumption" required="" class="form-control"></th>
                                                        </tr>
                                                    <tr>
                                                         <th>Monsoon FO :<span class="required">*</span></th>
                                                        <th><input type="text" id="tgMonsoonFO" name="MonsoonFO" value="<?php echo $row['MonsoonFO'];?>" autocomplete="off" placeholder="Monsoon FO" required="" class="form-control"></th>
                                                    
                                                        <th>Fuel Cost Per Ton of BL :<span class="required">*</span></th>
                                                        <th><input type="text" id="tgFuelCostPerTonofBL" name="FuelCostPerTonofBL" value="<?php echo $row['FuelCostPerTonofBL'];?>" autocomplete="off" placeholder="Fuel Cost Per Ton of BL" required="" class="form-control"></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Other Costs Ton of BL :<span class="required">*</span></th>
                                                        <th><input type="text" id="tgOtherCostsTonofBL" name="OtherCostsTonofBL" value="<?php echo $row['OtherCostsTonofBL'];?>" autocomplete="off" placeholder="Other Costs Ton of BL" required="" class="form-control"></th>
                                                        <th colspan="2">&nbsp;</th>
                                                        
                                                     </tr>  
                                                    <tr>
                                                        <th colspan="4" style="text-align:center">
                                                           <button type="button" name="save" id="editTugs" class="btn btn-success" value="update"><i class="material-icons">edit</i> Update</button>
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
    $("#editTugs").click(function(){
      $("#editTugs").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#tgMonth").val();
      $monthid= $("#tgMonth").find('option:selected').attr('data-id');
      $Year= $("#tgYear").val();
      $TugName= $("#tgTugName").val();
      $FuelConsumption= $("#tgFuelConsumption").val();
      $tgMonsoonFO=$("#tgMonsoonFO").val();
      $FuelCostPerTonofBL= $("#tgFuelCostPerTonofBL").val();
      $OtherCostsTonofBL= $("#tgOtherCostsTonofBL").val();
      $.post('<?php echo base_url();?>tugs/update/<?php echo $param2; ?>', { Month: $Month,monthid:$monthid,Year:$Year,TugName:$TugName,FuelConsumption:$FuelConsumption,tgMonsoonFO:$tgMonsoonFO,FuelCostPerTonofBL:$FuelCostPerTonofBL,OtherCostsTonofBL:$OtherCostsTonofBL}, function(data){
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Tugs Details Updated Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#editTugs").html('<i class="material-icons">edit</i> Update');
                          }
		});
      
    });
});
</script>