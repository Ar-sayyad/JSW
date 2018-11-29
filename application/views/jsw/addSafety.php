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
                                    <select id="safetyMONTH" name="MONTH" placeholder="month" required="" class="form-control">
                                        <option value="">---Select Month---</option>
                                         <?php foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php }?> 
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="safetyYEAR" name="YEAR" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                        <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>Near Miss :<span class="required">*</span></th>
                                <th><input type="text" id="safetyNearmiss" name="Nearmiss" autocomplete="off" placeholder="Near Miss" required="" class="form-control"></th>

                                <th>General :<span class="required">*</span> </th>
                                <th><input type="text" id="safetyGeneral" name="General" autocomplete="off" placeholder="General" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>First Aid / Injury :<span class="required">*</span></th>
                                <th><input type="text" id="safetyFirstAid_Injury" name="FirstAid_Injury" autocomplete="off" placeholder="First Aid / Injury" required="" class="form-control"></th>

                                <th>Fatal :<span class="required">*</span></th>
                                <th><input type="text" id="safetyFatal" name="Fatal" autocomplete="off" placeholder="Fatal" required="" class="form-control"></th>
                            </tr>                                                    
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" id="saveSafety" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#saveSafety").click(function(){
      $("#saveSafety").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $MONTH= $("#safetyMONTH").val();
      $monthid= $("#safetyMONTH").find('option:selected').attr('data-id');
      $YEAR= $("#safetyYEAR").val();
      $Nearmiss= $("#safetyNearmiss").val();
      $General= $("#safetyGeneral").val();
      $FirstAid_Injury= $("#safetyFirstAid_Injury").val();
      $Fatal= $("#safetyFatal").val();
      $.post('<?php echo base_url();?>safety/save', { MONTH: $MONTH,monthid:$monthid,YEAR:$YEAR,Nearmiss:$Nearmiss,General:$General,FirstAid_Injury:$FirstAid_Injury,Fatal:$Fatal}, function(data){
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Safety Details Added Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveSafety").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>