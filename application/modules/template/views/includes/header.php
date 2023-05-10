<a href="<?php echo base_url('dashboard/home') ?>" class="logo">

    <?php //menu tiltle ?>
    <p class="logo-text" style="margin:10px; font-size:15px; font-weight:bold;">
        <?php echo "MoH PM DASHBOARD" ?>
    </p>
    <p class="short-logo" style="margin-left:0px; margin-top:20px; font-size:13px; font-weight:bold;">
        <?php echo "PMD" ?>
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

            <li><a href="#" class="full-screen fullscreen-button full-screen-link menu-icons fullscreen"><i
                        class="pe-7s-expand1"></i></a>
            </li>
            
            <?php if ($this->session->userdata('allow_all_categories') == 1) { ?>
            <li><a href="#switchData" data-toggle="modal"><i class="pe-7s-look"></i></a>
            </li>
            <?php } ?>
            <li><a href="#switchYear" data-toggle="modal"><i class="pe-7s-date"></i></a>
            </li>

            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle btn btn-sm btn-default" data-toggle="dropdown" style="border:0px;">
                    <?php echo $this->session->userdata('fullname') ?> <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">

                    <?php if (($this->session->userdata('user_type') == 'admin') || ($this->session->userdata('isAdmin'))) { ?>
                        <li><a href="<?php echo base_url('users/form') ?>"><i class="pe-7s-add-user"></i> New User
                            </a>
                        </li>
                        <li><a href="<?php echo base_url('users') ?>"><i class="pe-7s-filter"></i>
                                <?php echo display('user_list') ?>
                            </a>
                        </li>
                        <hr>
                    <?php } ?>

        
                    <li><a href="<?php echo base_url('dashboard/home/setting') ?>"><i class="pe-7s-settings"></i>
                            <?php echo display('profile') ?>
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


</nav>