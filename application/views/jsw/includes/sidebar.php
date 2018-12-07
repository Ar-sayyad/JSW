 <div class="sidebar" data-color="blue" data-image="">
   
            <div class="logo">
                <a href="<?php echo base_url();?>" class="simple-text">
                   <image src="<?php echo base_url();?>site/content/img/logo.png" >
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                   <!-- <?php if($title=='Port Performance'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>portPerformance">
                            <i class="material-icons">perm_data_setting</i>
                            <p>Port Performance</p>
                        </a>
                    </li>-->
                    <?php if($title=='Vessel Performance'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>vesselPerformance">
                            <i class="material-icons">settings_applications</i>
                            <p>Vessel Performance</p>
                        </a>
                    </li>
                    <?php if($title=='Marine Performance'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>marinePerformance">
                            <i class="material-icons">waves</i>
                            <p>Marine Performance</p>
                        </a>
                    </li>
                   <?php if($title=='Marine Performance - MBCs'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>mbcs">
                            <i class="material-icons">format_align_left</i>
                            <p>Marine Performance - MBCs </p>
                        </a>
                    </li>
                   <?php if($title=='Marine Performance - Tugs'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>tugs">
                            <i class="material-icons">format_align_center</i>
                            <p>Marine Performance - Tugs </p>
                        </a>
                    </li>
                   
                    <?php if($title=='Port Operational Performance'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>portOperational">
                            <i class="material-icons text-gray">build</i>
                            <p>Port Operational Performance </p>
                        </a>
                    </li>
                    <?php if($title=='Maintenance Cost'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>maintenanceCost">
                            <i class="material-icons">attach_money</i>
                            <p> Maintenance Cost </p>
                        </a>
                    </li>
                    <?php if($title=='Power Consumption'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>powerConsumption">
                            <i class="material-icons">power_off</i>
                            <p> Power Consumption</p>
                        </a>
                    </li>
                    <?php if($title=='MHS Performance'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>mhsPerformance">
                            <i class="material-icons">brightness_high</i>
                            <p> MHS Performance</p>
                        </a>
                    </li>
                     <?php if($title=='HEME Performance'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>hemePerformance">
                            <i class="material-icons">brightness_low</i>
                            <p> HEME Performance </p>
                        </a>
                    </li>
                     <?php if($title=='Safety'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>safety">
                            <i class="material-icons">security</i>
                            <p> Safety </p>
                        </a>
                    </li>
                    <?php if($title=='Safety Training'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>safetyTraining">
                            <i class="material-icons">accessibility_new</i>
                            <p> Safety Training</p>
                        </a>
                    </li>
                    <!-- <?php if($title=='Safety Training (Visuals)'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>safetyTrainingVisuals">
                            <i class="material-icons">transfer_within_a_station</i>
                            <p> Safety Training (Visuals)</p>
                        </a>
                    </li>-->
                     <?php if($title=='Environment'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>environment">
                            <i class="material-icons">bubble_chart</i>
                            <p> Environment</p>
                        </a>
                    </li>
                     <?php if($title=='Environment Report'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>environmentReport">
                            <i class="material-icons">format_list_numbered</i>
                            <p> Environment Report</p>
                        </a>
                    </li>
                     <!--<?php if($title=='Environment (Visuals)'){?>
                    <li class="active">
                    <?php } else { ?><li> <?php }?>
                        <a href="<?php echo base_url();?>environmentVisuals">
                            <i class="material-icons">table_chart</i>
                            <p> Environment (Visuals)</p>
                        </a>
                    </li>-->
                  
                </ul>
            </div>
        
		
</div>
<?php include 'modal.php';?>