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
<!-- <script src="<?php // echo base_url('assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script> -->
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
             interval: <?php echo $setting->slider_timer; ?>
         })
    });   
    
    ///full screen
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


	$(document).on("click", ".fullscreen-button", function toggleFullScreen() {

		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			$('body').addClass("fullscreen");
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
				$('body').removeClass("fullscreen");
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}

	});

 $(document).ready(function() {
  $(".sidebar-toggle").click(function() {

    var body = $("body").attr("class");
    if (body='fixed sidebar-mini  pace-donebody') {
          $(".logo.text").hide();
          $('.short-logo').show();
       
    } else {

         $(".logo.text").show();
         $('.short-logo').hide();
    
    }
    //console.log(body+"body");
  });

      var url = "<?php echo $this->uri->segment(2); ?>";
        if (url == "slider" || url == "summary" || url == "view_kpi_data" || url == "kpis" || url == "addkpi_data") {
            $('body').addClass('sidebar-collapse');
            $('#sidebar').toggleClass('active');
            $(".logo-text").hide();
            $('.short-logo').show();
        }
        else{
            $(".logo-text").show();
            $('.short-logo').hide();
        };
    

   Highcharts.setOptions({
      colors: ['#90ed7d', '#434348',  '#f7a35c', '#8085e9',  '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1',  '#1aadce', '#492970', '#f28f43', '#77a1e5', '#c42525',  '#a6c96a', '#4572A7', '#AA4643', '#89A54E', '#80699B',  '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92',  '#058DC7', '#50B432', '#ED561B', '#DDDF00']

    });
});

function getSubs(val){
   
        $.ajax({
            method: "GET",
            url: "<?php echo base_url(); ?>kpi/get_cat_subjects",
            data: val,
            success: function(data) {
                console.log(data);
                $(".cat_subject_areas").html(data);
            }
            //  console.log('iwioowiiwoow');
        });
}



</script>

<script type="text/javascript">
        setTimeout(function () {

            // Closing the alert
            $('alert').alert('close');
        }, 5000);
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