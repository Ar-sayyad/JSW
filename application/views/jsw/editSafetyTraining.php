<?php $data_info = $this->db->get_where('dbo.tblSafetyTopic_ref', array('id' => $param2))->result_array();
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
                                                        <th> Select Month :<span class="required">*</span></th>
                                                        <th>                                                            
                                                            <select id="SafetyTrainingMONTH" name="MONTH" placeholder="month" required="" class="form-control">
                                                                <option value="">---Select Month---</option>
                                                               <?php foreach($month_info as $mon){?>                                       
                                                                    <option data-id="<?php echo ($mon['FY_Order']);?>" value="<?php echo ($mon['MonName']);?>" <?php if(($row['Month'])==($mon['MonName'])){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo trim($mon['MonName']);?></option>                                      
                                                                     <?php }?>  
                                                            </select>
                                                        </th>

                                                        <th> Select Year :<span class="required">*</span></th>
                                                        <th>
                                                            <select id="SafetyTrainingYEAR" name="YEAR" placeholder="year" required="" class="form-control">
                                                                <option value="">---Select Year---</option>
                                                                <option value="<?php echo $prev = date('Y')-1;?>" <?php if(trim($row['yr'])== $prev){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')-1;?></option>
                                                                <option value="<?php echo $curr = date('Y');?>" <?php if(trim($row['yr'])== $curr){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y');?></option>
                                                                <option value="<?php echo $post = date('Y')+1;?>" <?php if(trim($row['yr'])== $post){ echo 'selected'; }else{ echo 'disabled'; } ?>><?php echo date('Y')+1;?></option>
                                                            </select>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Topic :<span class="required">*</span></th>
                                                        <th><input type="text" id="topic" name="topic" value="<?php echo $row['topic']; ?>" autocomplete="off" placeholder="Topic" required="" class="form-control"></th>

                                                        <th>Value :<span class="required">*</span> </th>
                                                        <th><input type="text" id="value" name="value" value="<?php echo $row['value']; ?>" autocomplete="off" placeholder="Value" required="" class="form-control"></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Target:<span class="required">*</span></th>
                                                        <th><input type="text" id="target" name="target" value="<?php echo $row['target']; ?>" autocomplete="off" placeholder="Target" required="" class="form-control"></th>

                                                        <th colspan="2">&nbsp;</th>
<!--                                                        <th>
                                                             <select id="type" name="type" required="" class="form-control type">                                                       
                                                                    <option value="T" <?php if($row['type']== 'T'){ echo 'selected'; } ?>>T</option>
                                                                    <option value="A" <?php if($row['type']== 'A'){ echo 'selected'; } ?>>A</option>
                                                                </select>
                                                        </th>-->
                                                    </tr>        
                                                   
                                                    <tr>
                                                        <th colspan="4" style="text-align:center">
                                                             <button type="button" name="save" id="editSafetyTraining" class="btn btn-success" value="update"><i class="material-icons">edit</i> Update</button>
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
    $("#editSafetyTraining").click(function(){
      $("#editSafetyTraining").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $MONTH= $("#SafetyTrainingMONTH").val();
      $monthid= $("#SafetyTrainingMONTH").find('option:selected').attr('data-id');
      $YEAR= $("#SafetyTrainingYEAR").val();
      $topic= $("#topic").val();
      $value= $("#value").val();
      $target= $("#target").val();
     // $type= $("#type").val();
      $.post('<?php echo base_url();?>safetyTraining/update/<?php echo $param2;?>', { MONTH: $MONTH,monthid:$monthid,YEAR:$YEAR,topic:$topic,value:$value,target:$target}, function(data){
                    if(data==1)
                          {                                  
                                $(".success_msg").html('<i class="material-icons">check_circle_outline</i> Safety Topic Details Updated Successfully');
                                $(".success_msg").show();
                                window.location.reload();
                                setTimeout(hidetab,4000);
                          }
                          else{
                                  $(".error_msg").html(data);
                                  $(".error_msg").show();
                                  setTimeout(hidetab,4000);
                                  $("#editSafetyTraining").html('<i class="material-icons">edit</i> Update');
                          }
		});
      
    });
});
</script>