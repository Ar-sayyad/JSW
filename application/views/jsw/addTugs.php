<style>
    .modal-dialog{
            width: 1350px;
    }
    .form-group {
    padding-bottom: 0px;
    margin: 0px 0 0 0;
}
.red {
    border: 1px solid red;
    color:red;
    background-color: red;
}
</style>
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
                                    <th colspan="4">
                            <table class="table table-striped table-bordered" style="margin-top:10px;margin-bottom: 10px;">
                                <thead>
                                    <tr>
                                        <th>
                                            Sr.
                                        </th>
                                        <th>
                                            Tug Name
                                        </th>
                                        <th>
                                            Fuel Consumption
                                        </th>
                                        <th>
                                            Monsoon PO
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>
                                        1
                                    </th>
                                    <th>
                                        BHIM<input type="hidden" name="TugName" value="BHIM" class="tgTugName" required=""/>
                                    </th>
                                    <th>
                                        <input type="text" id="tgFuelConsumption" name="tgFuelConsumption" autocomplete="off" placeholder="Fuel Consumption" required="" class="form-control tgFuelConsumption">
                                    </th>
                                    <th>
                                        <input type="text" id="tgMonsoonPO" name="tgMonsoonPO" autocomplete="off" placeholder="Monsoon FO" required="" class="form-control tgMonsoonPO">
                                    </th>
                                </tr>
                                 <tr>
                                     <th>
                                        2
                                    </th>
                                    <th>
                                        BAJRANG<input type="hidden" name="TugName" value="BAJRANG" class="tgTugName" required=""/>
                                    </th>
                                    <th>
                                        <input type="text" id="tgFuelConsumption" name="tgFuelConsumption" autocomplete="off" placeholder="Fuel Consumption" required="" class="form-control tgFuelConsumption">
                                    </th>
                                    <th>
                                        <input type="text" id="tgMonsoonPO" name="tgMonsoonPO" autocomplete="off" placeholder="Monsoon FO" required="" class="form-control tgMonsoonPO">
                                    </th>
                                </tr>
                                 <tr>
                                     <th>
                                        3
                                    </th>
                                    <th>
                                        BALRAM<input type="hidden" name="TugName" value="BHIM" class="tgTugName" required=""/>
                                    </th>
                                    <th>
                                        <input type="text" id="tgFuelConsumption" name="tgFuelConsumption" autocomplete="off" placeholder="Fuel Consumption" required="" class="form-control tgFuelConsumption">
                                    </th>
                                    <th>
                                        <input type="text" id="tgMonsoonPO" name="tgMonsoonPO" autocomplete="off" placeholder="Monsoon FO" required="" class="form-control tgMonsoonPO">
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                                    </th>
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
       var tgTugName = new Array();
        var sr=0;
        $(".tgTugName").each(function() {
            $top=$(this).val();
            if($top===''){
              $(this).css("border", "1px solid red");
              err('All Fields Required.');
            }else{
                 $(this).css("border", "1px solid green");
                tgTugName.push($top);
            }
            sr++;
        });
         var tgFuelConsumption = new Array();
        $(".tgFuelConsumption").each(function() {
               $tgFuelConsumption=$(this).val();
                if($tgFuelConsumption===''){
              $(this).css("border", "1px solid red");
              err('All Fields Required.');
            }else{
                $(this).css("border", "1px solid green");
                tgFuelConsumption.push($tgFuelConsumption);
            }
        });
        var tgMonsoonPO = new Array();
        $(".tgMonsoonPO").each(function() {
             $tgMonsoonPO=$(this).val();
                if($tgMonsoonPO===''){
              $(this).css("border", "1px solid red");
              err('All Fields Required.');
            }else{
                $(this).css("border", "1px solid green");
                tgMonsoonPO.push($tgMonsoonPO);
            }
        });
      //$TugName= $("#tgTugName").val();
     // $FuelConsumption= $("#tgFuelConsumption").val();
      $FuelCostPerTonofBL= $("#tgFuelCostPerTonofBL").val();
      $OtherCostsTonofBL= $("#tgOtherCostsTonofBL").val();
      
       if(tgTugName.length == sr && tgFuelConsumption.length==sr && tgMonsoonPO.length==sr){
      $.post('<?php echo base_url();?>tugs/save', { Month: $Month,monthid:$monthid,Year:$Year,TugName:tgTugName,FuelConsumption:tgFuelConsumption,MonsoonFO:tgMonsoonPO,FuelCostPerTonofBL:$FuelCostPerTonofBL,OtherCostsTonofBL:$OtherCostsTonofBL}, function(data){
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
            } else{
                    
                }   
        function err(val){                
            $(".error_msg").html(val);
            $(".error_msg").show();
            setTimeout(hidetab,2000);
            $("#saveTugs").html('<i class="material-icons">save</i> Save');
            return false;
        }
      
    });
});
</script>