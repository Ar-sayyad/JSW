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
                    
                          <div class="row">
                        <div class="col-lg-12">
                           
                             <div class="card alert">
                                  <div class="addbtn">
                                      <a href ="<?php echo base_url();?>marinePerformance"> <button class="btn btn-info" style="float: left" > <i class="material-icons">arrow_back</i> Back</button></a>
                             </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SR.</th> 
                                                    <th>Vessel Name</th>
                                                    <th>Vessel Category</th>
                                                    <th>Berth </th>
                                                    <th>Cargo</th>
                                                     <th>Remarks</th>
                                                    <th style="text-align: left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sr=1; foreach($marinePerformance_info as $row){?>
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                    <td><?php echo $row['VESSEL_NAME'];?></td>
                                                    <td><?php echo $row['VESSEL_CATEGORY'];?></td> 
                                                    <td><?php echo $row['BERTH_NAME'];?></td>
                                                    <td><?php echo $row['CARGO_TYPE'];?></td> 
                                                     <td style="width: 20%"><?php echo $row['Remarks'];?></td> 
                                                    <td style="text-align: left">                                                       
                                                        
                                                        <a style="cursor:pointer" rel="tooltip" title="Update" class="btn btn-primary btn-link btn-sm" onclick="showAjaxModal('<?php echo base_url();?>home/popup/jsw/updateMarine/<?php echo $row['VAN_ID'];?>/<?php echo $row['VAN_NUM'];?>/<?php echo $row['VESSEL_NAME'];?>/<?php echo $row['Remarks'];?>');">
                                                        <i class="material-icons">edit</i>
                                                        </a>
                                                        
<!--                                                        <a rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return checkDelete();" href="<?php echo base_url(); ?>marinePerformance/delete/<?php echo $row['VAN_ID'];?>">
                                                          <i class="material-icons">close</i>-->
                                                      
                                                        </a>
                                                    </td>
                                                    
                                                </tr>
                                                <?php $sr++; }?>    
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
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
     
    