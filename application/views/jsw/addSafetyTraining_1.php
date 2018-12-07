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
                                    <select id="SafetyTrainingMONTH" name="MONTH" placeholder="month" required="" class="form-control">
                                        <option value="">---Select Month---</option>
                                        <?php foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php }?> 
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="SafetyTrainingYEAR" name="YEAR" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                        <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>LNG & Its Hazards :<span class="required">*</span></th>
                                <th><input type="text" id="SafetyTrainingLNGhazards" name="LNGhazards" autocomplete="off" placeholder="LNG & Its Hazards" required="" class="form-control"></th>

                                <th>Confined Space Entry :<span class="required">*</span> </th>
                                <th><input type="text" id="SafetyTrainingConfinedSpaceEntry" name="ConfinedSpaceEntry" autocomplete="off" placeholder="Confined Space Entry" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>Awareness Tools Tackles Calibration :<span class="required">*</span></th>
                                <th><input type="text" id="SafetyTrainingAwarenessToolsTacklesCalibration" name="AwarenessToolsTacklesCalibration" autocomplete="off" placeholder="Awareness Tools Tackles Calibration" required="" class="form-control"></th>

                                <th>Awareness Fire tender Operation :<span class="required">*</span></th>
                                <th><input type="text" id="SafetyTrainingAwarenessFiretenderOperation" name="AwarenessFiretenderOperation" autocomplete="off" placeholder="Awareness Fire tender Operation" required="" class="form-control"></th>
                            </tr>        
                            <tr>
                                <th>Type :<span class="required">*</span></th>
                                <th><input type="text" id="SafetyTrainingType" name="Type" autocomplete="off" placeholder="Type" required="" class="form-control"></th>

                                <th colspan="2">&nbsp;</th>
                             </tr>  
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" id="saveSafetyTraining" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#saveSafetyTraining").click(function(){
      $("#saveSafetyTraining").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $MONTH= $("#SafetyTrainingMONTH").val();
      $YEAR= $("#SafetyTrainingYEAR").val();
      $LNGhazards= $("#SafetyTrainingLNGhazards").val();
      $ConfinedSpaceEntry= $("#SafetyTrainingConfinedSpaceEntry").val();
      $AwarenessToolsTacklesCalibration= $("#SafetyTrainingAwarenessToolsTacklesCalibration").val();
      $AwarenessFiretenderOperation= $("#SafetyTrainingAwarenessFiretenderOperation").val();
      $Type= $("#SafetyTrainingType").val();
      $.post('<?php echo base_url();?>safetyTraining/save', { MONTH: $MONTH,YEAR:$YEAR,LNGhazards:$LNGhazards,ConfinedSpaceEntry:$ConfinedSpaceEntry,AwarenessToolsTacklesCalibration:$AwarenessToolsTacklesCalibration,AwarenessFiretenderOperation:$AwarenessFiretenderOperation,Type:$Type}, function(data){
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Safety Topic Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveSafetyTraining").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>