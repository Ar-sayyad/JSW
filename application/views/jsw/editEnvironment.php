<?php $data_info = $this->db->get_where('dbo.tblEnvironment', array('ID' => $param2))->result_array();
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
                                <th> Select Date :<span class="required">*</span></th>
                                <th><input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" autocomplete="off" placeholder="Date" required="" class="form-control"></th>

                                <th>NOX :<span class="required">*</span> </th>
                                <th><input type="text" id="NOX" name="NOX" value="<?php echo $row['NOX']; ?>" autocomplete="off" placeholder="NOX" required="" class="form-control"></th>
                            </tr>
                            <tr>
                                <th>CO :<span class="required">*</span> </th>
                                <th><input type="text" id="CO" name="CO" value="<?php echo $row['CO']; ?>" autocomplete="off" placeholder="CO" required="" class="form-control"></th>
                               <th>SO2 : <span class="required">*</span></th>
                                <th><input type="text" id="SO2" name="SO2" value="<?php echo $row['SO2']; ?>" autocomplete="off" placeholder="SO2" required="" class="form-control"></th>
                             </tr>  
                              <tr>
                                <th>PM10 :<span class="required">*</span> </th>
                                <th><input type="text" id="PM10" name="PM10" value="<?php echo $row['PM10']; ?>" autocomplete="off" placeholder="PM10" required="" class="form-control"></th>
                               <th>RSPM : <span class="required">*</span></th>
                                <th><input type="text" id="RSPM" name="RSPM" value="<?php echo $row['RSPM']; ?>" autocomplete="off" placeholder="RSPM" required="" class="form-control"></th>
                             </tr>  
                            <tr>
                                <th colspan="4" style="text-align:center">
                                     <button type="button" name="save" data-id="hello" id="editEnvironment" class="btn btn-success" value="save"><i class="material-icons">edit</i> Update</button>
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
    $("#editEnvironment").click(function(){
      $("#editEnvironment").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $date= $("#date").val();
      $NOX= $("#NOX").val();
      $CO= $("#CO").val();
      $SO2= $("#SO2").val();
      $PM10= $("#PM10").val();
      $RSPM= $("#RSPM").val();
      $.post('<?php echo base_url();?>environment/update/<?php echo $param2;?>', { date: $date,NOX:$NOX,CO:$CO,SO2:$SO2,PM10:$PM10,RSPM:$RSPM }, function(data){
            if(data==1)
                  {                                  
                        $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Environment Updated Successfully');
                        $(".success_msg").show();
                        window.location.reload();
                        setTimeout(hidetab,4000);
                  }
                  else{
                          $(".error_msg").html(data);
                          $(".error_msg").show();
                          setTimeout(hidetab,4000);
                          $("#editEnvironment").html('<i class="material-icons">edit</i> Update');
                  }
        });      
    });
});
</script>