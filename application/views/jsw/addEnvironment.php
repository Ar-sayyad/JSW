<div class="row main-section">			
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="table form">                                                
                        <thead class="">

                            <tr>
                                <th> Select Date :<span class="required">*</span></th>
                                <th><input type="date" id="date" name="date" autocomplete="off" placeholder="Date" required="" class="form-control"></th>

                                <th>NOX : <span class="required">*</span></th>
                                <th><input type="text" id="NOX" name="NOX" autocomplete="off" placeholder="NOX" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>CO :<span class="required">*</span> </th>
                                <th><input type="text" id="CO" name="CO" autocomplete="off" placeholder="CO" required="" class="form-control"></th>
                               <th>SO2 :<span class="required">*</span> </th>
                                <th><input type="text" id="SO2" name="SO2" autocomplete="off" placeholder="SO2" required="" class="form-control"></th>
                             </tr>  
                              <tr>
                                <th>PM10 :<span class="required">*</span> </th>
                                <th><input type="text" id="PM10" name="PM10" autocomplete="off" placeholder="PM10" required="" class="form-control"></th>
                               <th>RSPM :<span class="required">*</span> </th>
                                <th><input type="text" id="RSPM" name="RSPM" autocomplete="off" placeholder="RSPM" required="" class="form-control"></th>
                             </tr>  
                            <tr>
                                <th colspan="4" style="text-align:center">
                                    <button type="button" name="save" data-id="hello" id="saveEnvironment" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
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
    $("#saveEnvironment").click(function(){
      $("#saveEnvironment").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $date= $("#date").val();
      $NOX= $("#NOX").val();
      $CO= $("#CO").val();
      $SO2= $("#SO2").val();
      $PM10= $("#PM10").val();
      $RSPM= $("#RSPM").val();
      $.post('<?php echo base_url();?>environment/save', { date: $date,NOX:$NOX,CO:$CO,SO2:$SO2,PM10:$PM10,RSPM:$RSPM }, function(data){
            if(data==1)
                  {                                  
                        $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Environment Added Successfully');
                        $(".success_msg").show();
                        window.location.reload();
                        setTimeout(hidetab,4000);
                  }
                  else{
                          $(".error_msg").html(data);
                          $(".error_msg").show();
                          setTimeout(hidetab,4000);
                          $("#saveEnvironment").html('<i class="material-icons">save</i> Save');
                  }
        });      
    });
});
</script>