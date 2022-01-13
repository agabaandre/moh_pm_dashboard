<div class="sidebar" style="overflow:auto;">
    <!-- Sidebar user panel -->
    <?php if ($this->uri->segment(2) !== 'User') { ?>
    <div class="user-panel text-center">
        <!-- <div class="image">
            <?php //$image = $this->session->userdata('image') ?>
            <img src="<?php //echo base_url((!empty($image) ? $image : 'assets/img/icons/default.jpg')) ?>"
                class="img-circle" alt="User Image">
        </div> -->
        <!-- <div class="info">
            <p><?php //echo $this->session->userdata('fullname') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i>
                <?php //echo $this->session->userdata('user_level') ?></a>
        </div> -->
    </div>
    <?php } ?>



    <!-- sidebar menu -->
    <ul class="sidebar-menu" style="overflow:auto;">

        <li class="treeview <?php echo (($this->uri->segment(2) == "home") ? "active" : null) ?>">
            <a href="<?php echo base_url('dashboard/home') ?>"> <i class="ti-dashboard"></i>
                <span><?php echo display('dashboard') ?></span>
            </a>
        </li>
        
        <li class="treeview <?php echo (($this->uri->segment(2) == "summary") ? "active" : null) ?>">
                    <a href="<?php echo base_url(); ?>kpi/summary">
                    <i class="fa fa-circle"></i>
                        <span><?php echo display("kpi_summary"); ?></span>
                    </a>
        </li>

<?php

//For  KPI Menu  from settings_helper
 require_once settings()->menu; 

//admin menu items
 require_once 'menus/admin_menu_items.php';

?>
<!-- ends of admin area -->

    </ul>
</div> 


<?php require_once 'switch_facility.php'; ?>


<!-- /.sidebar -->
<script type="text/javascript">
$(document).ready(function() {
    $("form :input").attr("autocomplete", "off");
})


function openUrl(targetURL) {
    window.location.href = targetURL;
}
</script>
