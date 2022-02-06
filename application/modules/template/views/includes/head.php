<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

        <title><?php echo $setting->title ?> - <?php echo (!empty($title)?$title:null) ?></title>
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url($setting->favicon); ?>">
        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
        <!-- jquery ui css -->
        <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap --> 
         
        
       <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
        <?php if (!empty($setting->site_align) && $setting->site_align == "RTL") {  ?>
        <!-- THEME RTL -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <!-- Font Awesome 4.7.0 -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- semantic css -->
        <link href="<?php echo base_url(); ?>assets/css/semantic.min.css" rel="stylesheet" type="text/css"/> 
        <!-- sliderAccess css -->
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
        <!-- slider  -->
        <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
        <!-- DataTables CSS -->
           <!-- pe-icon-7-stroke -->
        <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- themify icon css -->
        <link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- Pace css -->
        <link href="<?php echo base_url('assets/css/flash.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/js/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- summernote css -->
        <link href="<?php echo base_url('assets/plugins/summernote/summernote.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/datetimepicker.css') ?>" rel="stylesheet" type="text/css"/>
        <?php if (!empty($setting->site_align) && $setting->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/DataTables/datatables.min.css') ?>"/>

        <!-- jQuery  -->
         <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js?v=3.4.1') ?>" type="text/javascript"></script>
        <!-- adapter js -->
        <!-- summernote js -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script src="<?php echo base_url('assets/js/jquery.blockUI.js') ?>" type="text/javascript"></script>


<?php
      $dimsub=Modules::run("Data/getSubject",$this->uri->segment(3));
?>




 

