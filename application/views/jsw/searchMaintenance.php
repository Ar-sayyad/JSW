<?php include 'includes/header.php';?>

<body>
    <div class="wrapper">
         <?php include 'includes/sidebar.php';?> 
		
        <div class="main-panel">
            
         <?php //include 'includes/nav.php';?>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php include 'includes/titlebar.php';?> 
                    
                      <div class="row main-section">
                          <div class="col-lg-4 col-md-12"></div>
        <div class="col-lg-4 col-md-12">
            <div class="card">

                <div class="card-content" style="background-color: rgba(255,255,255,.15); padding: 30px;border: 1px solid #d6d6ea;">
                <form action="<?php echo base_url();?>maintenanceCost/searchMaintenance" method="POST" enctype="multipart/form-data">
                    <table class="table form">                                                
                        <thead class="">

                            <tr>
                                 <th> Month :<span class="required">*</span></th>
                                <th>
                                    <select id="month" name="month" placeholder="month" required="" class="clsmon form-control">
                                        <option value="">---Select Month---</option>
                                         <?php $sr=1; foreach($month_info as $mon){?>                                       
                                        <option data-id="<?php echo trim($mon['FY_Order']);?>" value="<?php echo trim($mon['MonName']);?>"><?php echo trim($mon['MonName']);?></option>                                      
                                         <?php $sr++;}?>  
                                    </select>
                                </th>
                            </tr>
                        <tr>
                                <th> Year :<span class="required">*</span></th>
                                <th>
                                    <select id="year" name="year" placeholder="year" required="" class="form-control">
                                        <option value="">---Select Year---</option>
                                        <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                        <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                    </select>
                                </th>
                        </tr>
                        
                        <tr>
                                <th> Type :<span class="required">*</span></th>
                                <th>
                                    <select id="Type" name="Type" placeholder="Type" required="" class="form-control">
                                        <option value="">---Select Type---</option>
                                        <option value="Budget">Budget</option>
                                        <option value="Actual">Actual</option>
                                    </select>
                                </th>
                        </tr>
                                
                                   <tr>
                         
                         
                                <th colspan="4" style="text-align:center">
                                    <button type="submit" name="save" data-id="hello" id="saveEnvironment" class="btn btn-success" value="save"> 
                                        <i class="material-icons">search</i> Search</button>
                                     <button type="reset" name="Reset" class="btn btn-info" value="reset"><i class="material-icons">replay</i> Reset</button>
                                </th>
                            </tr>

                        </thead>

                    </table>
                </form>
                </div>
            </div>
        </div>	
  <div class="col-lg-4 col-md-12"></div>

</div>
                        
<!--			<-->
					
                    </div>
                </div>
                
               <?php include 'includes/footer.php';?> 
            </div>
    </div>
    </div>
</body>	
            
 <?php include 'includes/footer-min.php';?> 
     
    