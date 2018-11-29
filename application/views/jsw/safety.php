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
                                      <button data-toggle="modal" onclick="showAjaxModal('<?php echo base_url();?>home/popup/jsw/addsafety');" class="btn btn-info" style="float: right" > <i class="material-icons">add_circle_outline</i> Add Safety Data</button>
                             </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SR.</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th>Near Miss</th>
                                                    <th>General</th>
                                                    <th>First Aid / Injury</th>
                                                    <th>Fatal</th>
                                                    <th style="text-align: left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sr=1; foreach($safety_info as $row){?>
                                                <tr>
                                                    <td><?php echo $sr;?></td>
                                                    <td><?php echo $row['MONTH'];?></td>
                                                    <td><?php echo $row['YEAR'];?></td>
                                                    <td><?php echo $row['NearMiss'];?></td>
                                                    <td><?php echo $row['General'];?></td>
                                                    <td><?php echo $row['FirstAid_Injury'];?></td>
                                                    <td><?php echo $row['Fatal'];?></td>
                                                    <td style="text-align: left">                                                       
                                                        
                                                        <a style="cursor:pointer" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm" onclick="showAjaxModal('<?php echo base_url();?>home/popup/jsw/editSafety/<?php echo $row['ID'];?>');">
                                                        <i class="material-icons">edit</i>
                                                        </a>
                                                        
                                                        <a rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return checkDelete();" href="<?php echo base_url(); ?>safety/delete/<?php echo $row['ID'];?>">
                                                          <i class="material-icons">close</i>
                                                      
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