    <script type="text/javascript">
	function showAjaxModal(url)
	{
            $.post(url, { id: '1' }, function(data){
            
			if(data)
			{
                            jQuery('#modal_ajax .modal-body').html(data);
				//$("#popup").html(data);
			}
                    });
                     jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:120px;"><img src="<?php echo base_url();?>site/content/img/loading.gif" style="height:80px;" /></div>');
//		
//		// LOADING THE AJAX MODAL
                    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
//                
       
	}        
     
	
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax" style="">
        <div class="modal-dialog" style="width: 950px;max-width: 1000px;">
            <div class="modal-content" style="width: 100%;">
                
                <div class="modal-header">
                    <button type="button" class="card-close close" data-dismiss="modal" aria-hidden="true" data-dismiss="alert"><i class="material-icons">close</i></button>
                    <h4 class="modal-title"><img style="height: 50px;" src="<?php echo base_url();?>site/content/img/logo.png">
                        <div class="success_msg" style="display: none"></div><div class="error_msg" style="display: none"></div> 
                    </h4>                   
                </div>
                
                <div class="modal-body" style="min-height:650px; overflow:auto;margin-top: -10px;">                
                    
                    
                </div>
                
<!--                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>
    
    
   

    
    
    <script type="text/javascript">
	function confirm_modal(delete_url , post_refresh_url)
	{
		$('#preloader-delete').html('');
		jQuery('#modal_delete').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute("onClick" , "delete_data('" + delete_url + "' , '" + post_refresh_url + "')" );
		document.getElementById('delete_link').focus();
	}
        
	 function checkDelete()
    {
        var chk=confirm("Are You Sure To Delete This !");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
    
     function hidetab(){    
            //$('#mssg').hide();
            $('.success_msg').hide();
            $('.error_msg').hide();  
          }
            //setTimeout(hidetab,5000);
</script>
    
    <!-- (Normal Modal)-->
    