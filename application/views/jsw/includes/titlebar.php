

<div class="card card-plain">
							
    <div class="card-header" data-background-color="blue">
            <h4 class="title"><i class="material-icons"><?php echo $icons;?> </i> <?php echo $title;?> </h4>
     </div>                       
</div>
<?php if ($this->session->flashdata('msg')){?>
<div id="mssg" class="success_msg" style="">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <i class="fa fa-times-circle fa-fw fa-lg" style="color:green"></i>
        </button><?php echo $this->session->flashdata('msg'); ?>
    </div>  
<?php $this->session->set_flashdata('msg', '');}?>
    
    <?php if ($this->session->flashdata('err_msg')){?>
<div id="mssg" class="error_msg" style="">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <i class="fa fa-times-circle fa-fw fa-lg" style="color:RED"></i>
        </button><?php echo$this->session->flashdata('err_msg'); ?>
    </div> 
<?php $this->session->set_flashdata('err_msg', '');}?>