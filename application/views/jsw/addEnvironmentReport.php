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
                                    <select id="envReportMONTH" name="MONTH" placeholder="month" required="" class="clsmon form-control">
                                        <option value="">---Select Month---</option>
                                         <?php foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php }?>  
                                    </select>
                                </th>

                                <th> Select Year :<span class="required">*</span></th>
                                <th>
                                    <select id="envReportYEAR" name="YEAR" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                        <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>Sapling Planted :<span class="required">*</span> </th>
                                <th><input type="text" id="SaplingPlanted" name="SaplingPlanted" autocomplete="off" placeholder="SaplingPlanted" required="" class="form-control"></th>
                                
                                <th>Survival :<span class="required">*</span> </th>
                                <th><input type="text" id="Survival" name="Survival" autocomplete="off" placeholder="Survival" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>Area :<span class="required">*</span> </th>
                                <th><input type="text" id="Area" name="Area" autocomplete="off" placeholder="Area" required="" class="form-control"></th>
                                <th colspan="2">&nbsp;</th>
                             </tr>  
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="saveEnvironmentReport" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#saveEnvironmentReport").click(function(){
      $("#saveEnvironmentReport").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $MONTH= $("#envReportMONTH").val();
      $YEAR= $("#envReportYEAR").val();
      $SaplingPlanted= $("#SaplingPlanted").val();
      $Survival= $("#Survival").val();
      $Area= $("#Area").val();
      $.post('<?php echo base_url();?>environmentReport/save', { MONTH: $MONTH,YEAR:$YEAR,SaplingPlanted:$SaplingPlanted,Survival:$Survival,Area:$Area }, function(data){
            if(data==1)
                  {                                  
                        $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Environment Report Added Successfully');
                        $(".success_msg").show();
                        window.location.reload();
                        setTimeout(hidetab,4000);
                  }
                  else{
                          $(".error_msg").html(data);
                          $(".error_msg").show();
                          setTimeout(hidetab,4000);
                          $("#saveEnvironmentReport").html('<i class="material-icons">save</i> Save');
                  }
        });      
    });
});
</script>