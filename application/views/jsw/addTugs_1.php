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
                                        <select id="tgMonth" name="Month" placeholder="month" required="" class="form-control">
                                            <option value="">---Select Month---</option>
                                             <?php foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php }?>  
                                        </select>
                                    </th>

                                    <th> Select Year :<span class="required">*</span></th>
                                    <th>
                                        <select id="tgYear" name="Year" placeholder="year" required="" class="form-control">
                                            <option value="">---Select Year---</option>
                                            <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                            <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                            <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
<!--                                    <th>Financial Year :<span class="required">*</span></th>
                                    <th>
                                        <select id="tgFinYear" name="FinYear" placeholder="FinYear" required="" class="form-control">
                                            <option value="">--Select Financial Year--</option>
                                            <option value="<?php echo (date('Y')-1) . '-' . (date('Y'));?>"><?php echo (date('Y')-1) . '-' . (date('Y'));?></option>
                                            <option value="<?php echo date('Y') . '-' . (date('Y') + 1);?>"><?php echo date('Y') . '-' . (date('Y') + 1);?></option>
                                        </select>
                                    </th>-->

                                    <th>Tug Name :<span class="required">*</span> </th>
                                    <th>
                                        <select id="tgTugName" name="TugName" placeholder="TugName" required="" class="form-control">
                                            <option value="">---Select Tug Name---</option>
                                             <option value="BHIM">BHIM</option>
                                            <option value="BAJRANG">BAJRANG</option>
                                            <option value="BALRAM">BALRAM</option>
                                        </select>
                                    </th>
                                
                                    <th>Fuel Consumption:<span class="required">*</span></th>
                                    <th><input type="text" id="tgFuelConsumption" name="FuelConsumption" autocomplete="off" placeholder="Fuel Consumption" required="" class="form-control"></th>
                                </tr>
                                <tr>
                                    <th>Fuel Cost Per Ton of BL :<span class="required">*</span></th>
                                    <th><input type="text" id="tgFuelCostPerTonofBL" name="FuelCostPerTonofBL" autocomplete="off" placeholder="Fuel Cost Per Ton of BL" required="" class="form-control"></th>
                                
                                    <th>Other Costs Ton of BL :<span class="required">*</span></th>
                                    <th><input type="text" id="tgOtherCostsTonofBL" name="OtherCostsTonofBL" autocomplete="off" placeholder="Other Costs Ton of BL" required="" class="form-control"></th>

                                    
                                 </tr>  
                                <tr>
                                    <th colspan="4" style="text-align:center">
                                        <button type="button" name="save" id="saveTugs" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#saveTugs").click(function(){
      $("#saveTugs").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#tgMonth").val();
      $monthid= $("#tgMonth").find('option:selected').attr('data-id');
      $Year= $("#tgYear").val();
      $TugName= $("#tgTugName").val();
      $FuelConsumption= $("#tgFuelConsumption").val();
      $FuelCostPerTonofBL= $("#tgFuelCostPerTonofBL").val();
      $OtherCostsTonofBL= $("#tgOtherCostsTonofBL").val();
      $.post('<?php echo base_url();?>tugs/save', { Month: $Month,monthid:$monthid,Year:$Year,TugName:$TugName,FuelConsumption:$FuelConsumption,FuelCostPerTonofBL:$FuelCostPerTonofBL,OtherCostsTonofBL:$OtherCostsTonofBL}, function(data){
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Tugs Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveTugs").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>