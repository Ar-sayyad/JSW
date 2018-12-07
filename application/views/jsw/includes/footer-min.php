        
<!--   Core JS Files   -->

<script src="<?php echo base_url();?>site/content/js/lib/data-table/datatables.min.js"></script>
<script src="<?php echo base_url();?>site/content/js/lib/data-table/datatables-init.js"></script>

<script src="<?php echo base_url();?>site/content/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>site/content/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>site/content/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="<?php echo base_url();?>site/content/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="<?php echo base_url();?>site/content/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="<?php echo base_url();?>site/content/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url();?>site/content/js/bootstrap-notify.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url();?>site/content/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url();?>site/content/js/demo.js"></script>


<!----->
<!--<script type="text/javascript" src="<?php echo base_url();?>site/content/js/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>site/content/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>site/content/js/daterangepicker.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>site/content/css/daterangepicker.css" />-->


 
<!----->

<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in content/js/demos.js
        demo.initDashboardPageCharts();

    });
       $(document).ready(function() {
           function hidetab(){    
            $('#mssg').hide();
            
          }
            setTimeout(hidetab,4000);
       });
    </script>

</html>