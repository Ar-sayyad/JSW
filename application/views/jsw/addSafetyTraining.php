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
                                <th colspan="4" style="padding: 7px 7px;">
                                    <div class="col-md-12" id="invoice_entry" style="margin-bottom: 10px">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <div  class="col-md-4" style="padding: 2px;">
                                                    <input type="text" id="topic" name="topic[]" autocomplete="off" placeholder="Topic" required="" class="form-control topic">
                                                 </div>
                                              <div  class="col-md-3" style="padding: 2px;">
                                                    <input type="text" id="value" name="value[]" autocomplete="off" placeholder="Value" required="" class="form-control value">
                                              </div>
                                               <div  class="col-md-3" style="padding: 2px;">
                                                    <input type="text" id="target" name="target[]" autocomplete="off" placeholder="Target" required="" class="form-control target">
                                               </div>
<!--                                                <div  class="col-md-2" style="padding: 2px;">
                                                    <select id="type" name="type[]" required="" class="form-control type">
                                                        <option value="" selected="">Select</option>
                                                        <option value="T">T</option>
                                                        <option value="A">A</option>
                                                    </select>
                                                </div>-->
                                                <div  class="col-md-2" style="padding: 2px;">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteParentElement(this)">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                          <div class="basic-form">
                                            <center>
                                                <button type="button" class="btn btn-primary btn-sm" onClick="add_entry()"><i class="material-icons">control_point</i> Add More </button>
                                            </center>
                                          </div>
                                    </div>
                                </th>
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

    // CREATING BLANK INVOICE ENTRY
    var blank_invoice_entry = '';
    $(document).ready(function () {
        blank_invoice_entry = $('#invoice_entry').html();
        //$('#invoice_entry_temp').remove();
    });
    var count = 0;
    function add_entry()
    {
        if(count < 9) {
        $("#invoice_entry").append(blank_invoice_entry);
        count++;
        }
    }

    // REMOVING INVOICE ENTRY
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }
    
 
   $(document).ready(function(){
    $("#saveSafetyTraining").click(function(){
      $("#saveSafetyTraining").html('<img src="<?php echo base_url();?>site/content/img/loading.gif" style="width:25px;height:20px;" />');
      $MONTH= $("#SafetyTrainingMONTH").val();
      $monthid= $("#SafetyTrainingMONTH").find('option:selected').attr('data-id');
      $YEAR= $("#SafetyTrainingYEAR").val();      
        var topic = new Array();
        var sr=0;
        $(".topic").each(function() {
            $top=$(this).val();
            if($top===''){
              $(this).css("border", "1px solid red");
              err('All Fields Required.');
            }else{
                 $(this).css("border", "1px solid green");
                topic.push($top);
            }
            sr++;
        });
       // alert(sr);
       var value = new Array();
        $(".value").each(function() {
               $value=$(this).val();
                if($value===''){
              $(this).css("border", "1px solid red");
              err('All Fields Required.');
            }else{
                $(this).css("border", "1px solid green");
                value.push($value);
            }
        });
        var target = new Array();
        $(".target").each(function() {
             $target=$(this).val();
                if($target===''){
              $(this).css("border", "1px solid red");
              err('All Fields Required.');
            }else{
                $(this).css("border", "1px solid green");
                target.push($target);
            }
        });
//       var type = new Array();
//        $(".type").each(function() {
//             $type=$(this).val();
//                if($type===''){
//              $(this).css("border", "1px solid red");
//              err('All Fields Required.');
//            }else{
//                $(this).css("border", "1px solid green");
//                type.push($type);
//            }
//        });
       // alert(topic.length);
        if(topic.length == sr && value.length==sr && target.length==sr){
                $.post('<?php echo base_url();?>safetyTraining/save', { MONTH: $MONTH,monthid:$monthid,YEAR:$YEAR,topic:topic,value:value,target:target }, function(data){
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
                }else{
                    
                }
                
                function err(val){                
                    $(".error_msg").html(val);
                    $(".error_msg").show();
                    setTimeout(hidetab,2000);
                    $("#saveSafetyTraining").html('<i class="material-icons">save</i> Save');
                    return false;
                }
      
    });
});
</script>