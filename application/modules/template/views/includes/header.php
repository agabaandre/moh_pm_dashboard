<a href="<?php echo base_url('dashboard/home') ?>" class="logo">

    <?php //menu tiltle ?>
    <p style="margin:10px; font-size:15px; font-weight:bold;"><?php echo "MoH PM DASHBOARD" ?>
    </p>

</a>
<div class="se-pre-con"></div>
<!-- Header Navbar -->
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"
        style="border: #fff 0px; margin-right:3px;z-index:100; background:#fff;">
        <!-- Sidebar toggle button-->
        <span class="sr-only">Toggle navigation</span>
        <span class="fa fa-th"></span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav" style="margin:0 auto;">
            <?php if ($this->session->userdata('isAdmin')) { ?>
            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> KPI DATA</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(); ?>files/file">Upload KPI DATA</a>
                    </li>

                </ul>
            </li>
            <?php } ?>

            <?php if ($this->session->userdata('isAdmin')) { ?>
            <li class="dropdown open">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    KPIs
                </a>
                <ul class="dropdown-menu">

                    <li>
                        <a href="<?php echo base_url(); ?>kpi/subject">
                            <span>
                                <?php echo "Subject Areas" ?>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>kpi/categoryTwo">
                            <span>
                                <?php echo "Objectives /  Category Two" ?>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>kpi/kpis">
                            <span>
                                <?php echo "Performance Indicators" ?>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>kpi/kpiDisplay">
                            <span>
                                <?php echo "Kpi Display Control" ?>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('dashboard/setting') ?>">
                            <span>
                                <?php echo display('application_setting') ?>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('dashboard/language') ?>">
                            <span>
                                <?php echo display('language') ?>
                            </span>
                        </a>
                    </li>

                    <li class="treeview <?php echo (($this->uri->segment(2) == "backup_restore") ? "active" : null) ?>">
                        <a href="<?php echo base_url('dashboard/backup_restore/index') ?>">
                            <span>
                                <?php echo display('backup_and_restore') ?>
                            </span>
                        </a>
                    </li>

                </ul>
            </li> <!-- settings -->
            <?php } ?>
            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle btn btn-sm btn-default" data-toggle="dropdown" style="border:0px;">
                    <?php echo $this->session->userdata('fullname') ?> <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('dashboard/user/form') ?>">
                            <?php echo display('add_user') ?>
                        </a>
                    </li>
                    <li><a href="<?php echo base_url('dashboard/user/index') ?>">
                            <?php echo display('user_list') ?>
                        </a>
                    </li>
                    <hr>
                    <li><a href="#swicthYear" data-toggle="modal"><i class="pe-7s-shuffle"></i> Switch Year</a>
                    </li>
                    <li><a href="<?php echo base_url('dashboard/home/profile') ?>"><i class="pe-7s-users"></i>
                            <?php echo display('profile') ?>
                        </a></li>
                    <li><a href="<?php echo base_url('dashboard/home/setting') ?>"><i class="pe-7s-settings"></i>
                            <?php echo display('setting') ?>
                        </a></li>
                    <li><a href="<?php echo base_url('logout') ?>"><i class="pe-7s-key"></i>
                            <?php if ($this->session->userdata('fullname')) {
                                echo display('logout');
                            } else {
                                echo display('login');
                            } ?>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Messages -->

        </ul>

    </div>
    <span class="dropdown messages-menu"
        style="font-size:21px; text-align:center; font-weight:bold; float:left; margin-left:19%; margin-top:15px;">

        <span>
            <?php echo $setting->title ?>
        </span>
    </span>
</nav>