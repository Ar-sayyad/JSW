<?php if(!empty($param6)){
     $data_info = $this->db->get_where('dbo.tbl_MarineMBCRemarks', array('ID' => $param6))->result_array();
 foreach ($data_info as $row) {
      $Trip = $row['Trip'];
      $Quantity = $row['Quantity'];
      $costt = $row['Cost'];
      $Remark = $row['Remarks'];
 }
}else{
     $Trip = '';
     $Quantity = '';
     $costt = '';
     $Remark = '';
}
 ?>
<div class="row main-section">			
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="table form">                                                
                        <thead class="">
                        <input type="hidden" id="Month" name="Month" value="<?php echo $param2; ?>"/>
                        <input type="hidden" id="year" name="year" value="<?php echo $param3; ?>"/>
                        <input type="hidden" id="Finyear" name="Finyear" value="<?php echo $param4; ?>"/>
                        <input type="hidden" id="MBCName" name="MBCName" value="<?php echo str_replace('%20', ' ', $param5); ?>"/>                        
                        <input type="hidden" id="RID" name="RID" value="<?php echo $param6; ?>"/> 
                            <tr>
                                <th>Trip:<span class="required">*</span> </th>
                                <th><input type="text" id="Trip" name="Trip" value="<?php echo $Trip; ?>" autocomplete="off" placeholder="Trip" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>Quantity:<span class="required">*</span> </th>
                                <th><input type="text" id="Quantity" name="Quantity" value="<?php echo $Quantity; ?>" autocomplete="off" placeholder="Quantity" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>Cost:<span class="required">*</span> </th>
                                <th><input type="text" id="Cost" name="Cost" value="<?php echo $costt; ?>" autocomplete="off" placeholder="Cost" required="" class="form-control"></th>
                            </tr>
                             <tr>
                                <th>Remarks:<span class="required">*</span> </th>
                                <th>
                                    <textarea id="Remarks" name="Remarks"  autocomplete="off" required="" class="form-control" placeholder="Remarks"><?php echo $Remark; ?></textarea>
                                </th>
                            </tr>
                           
                            <tr>
                                <th colspan="2" style="text-align:center">
                                    <button type="button" name="save" id="saveMcbs" class="btn btn-success" value="save"><i class="material-icons">save</i> Save</button>
                                    <button type="reset" name="Reset" class="btn btn-info" value="reset"><i class="material-icons">replay</i> reset</button>
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
    $("#saveMcbs").click(function(){
      $("#saveMcbs").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $Month= $("#Month").val();
      $Year= $("#year").val();
      $Finyear= $("#Finyear").val();
      $Cost= $("#Cost").val();
      $Trip= $("#Trip").val();
      $Quantity= $("#Quantity").val();
      $RID= $("#RID").val();
       $MBCName= $("#MBCName").val();
      $Remarks= $("#Remarks").val();
      $.post('<?php echo base_url();?>mbcs/save', { Month: $Month,year:$Year,Finyear:$Finyear,Cost:$Cost,Trip:$Trip,Quantity:$Quantity,MBCName:$MBCName,RID:$RID,Remarks:$Remarks }, function(data){
          //alert(data);
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Maintenance MBCs Details Updated Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#saveMcbs").html('<i class="material-icons">save</i> Save');
                          }
		});
      
    });
});
</script>