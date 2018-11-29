
<div class="row main-section">			
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="table form">                                                
                        <thead class="">
                        <input type="hidden" id="van_id" name="van_id" value="<?php echo $param2; ?>"/>
                        <input type="hidden" id="van_num" name="van_num" value="<?php echo $param3; ?>"/>
                        <input type="hidden" id="vessel_name" name="vessel_name" value="<?php echo str_replace('%20', ' ', $param4); ?>"/>
                          
                             <tr>
                                <th>Remarks: <span class="required">*</span></th>
                                <th>
                                    <textarea id="Remarks" name="Remarks" autocomplete="off" required="" class="form-control" placeholder="Remarks"><?php echo str_replace('%20', ' ', $param5); ?></textarea>
                                </th>
                            </tr>
                           
                            <tr>
                                <th colspan="2" style="text-align:center">
                                    <button type="button" name="save" id="saveMarine" class="btn btn-success" value="save"><i class="material-icons">save</i> Update</button>
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
    $("#saveMarine").click(function(){
      $("#saveMarine").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $van_id= $("#van_id").val();
      $van_num= $("#van_num").val();
      $vessel_name= $("#vessel_name").val();
      $Remarks= $("#Remarks").val();
      $.post('<?php echo base_url();?>marinePerformance/save', { van_id: $van_id,van_num:$van_num,vessel_name:$vessel_name,Remarks:$Remarks }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Marine Performance Details Updated Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveMarine").html('<i class="material-icons">save</i> Update');
                          }
		});
      
    });
});
</script>