<script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<!-- jquery-ui -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- lobipanel -->
<script src="<?php echo base_url() ?>assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- Pace js -->
<script src="<?php echo base_url() ?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<!-- bootstrap timepicker -->
<script src="<?php echo base_url() ?>assets/js/jquery-ui-sliderAccess.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script>
<!-- select2 js -->
<script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/sparkline.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.counterup.min.js') ?>" type="text/javascript"></script>
<!-- ChartJs JavaScript -->
<script src="<?php echo base_url('assets/js/Chart.min.js?v=2.5') ?>" type="text/javascript"></script>
<!-- DataTables JavaScript -->

<script type="text/javascript" src="<?php echo base_url('assets/css/DataTables/datatables.min.js'); ?>"></script>
<!-- Table Head Fixer -->
<script src="<?php echo base_url() ?>assets/js/tableHeadFixer.js" type="text/javascript"></script>
<!-- Admin Script -->
<script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/datetimepicker.js') ?>" type="text/javascript"></script>


<!-- End Core Plugins -->
<!-- Start Page Lavel Plugins
        =====================================================================-->

<!-- End Page Lavel Plugins
        =====================================================================-->

<!-- Dashboard js -->
<script src="<?php echo base_url('assets/js/dashboard.js') ?>" type="text/javascript"></script>

<!-- End Theme label Script-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();

    });
</script>
<script type='text/javascript'>
    $(document).ready(function() {
         $('.carousel').carousel({
             interval: 4000
         })
    });   
    
    //full screen
            function cancelFullScreen() {
            var el = document;
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen||el.webkitExitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }

        function toggleFullScreen(el) {
            if (!el) {
                el = document.body; // Make the body go full screen.
            }
            var isInFullScreen = (document.fullScreenElement && document.fullScreenElement !== null) ||  (document.mozFullScreen || document.webkitIsFullScreen);

            if (isInFullScreen) {
                cancelFullScreen();
            } else {
                requestFullScreen(el);
            }
            return false;
        }
</script>



<!-- Include module Script -->
<?php
$path = 'application/modules/';
$map = directory_map($path);
if (is_array($map) && sizeof($map) > 0)
    foreach ($map as $key => $value) {
        $js = str_replace("\\", '/', $path . $key . 'assets/js/script.js');
        if (file_exists($js)) {
            echo "<script src=" . base_url($js) . " type=\"text/javascript\"></script>";
        }
    }
?>