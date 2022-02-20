

<a href="<?php echo base_url('dashboard/home') ?>" class="logo"> 

<?php //menu tiltle ?>
<p style="margin:10px; font-size:15px; font-weight:bold;"><?php echo "MoH PM DASHBOARD" ?></p>
  
</a>
<div class="se-pre-con"></div>
<!-- Header Navbar -->
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="border: #fff 0px; margin-right:3px;z-index:100; background:#fff;"> <!-- Sidebar toggle button-->
        <span class="sr-only">Toggle navigation</span>
        <span class="fa fa-th"></span>
    </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav" style="margin:0 auto;">
          
            <!-- settings -->
            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle btn btn-sm btn-default" data-toggle="dropdown" style="border:0px;"><?php echo $this->session->userdata('fullname') ?> <i class="fa fa-user"></i></a>
                <ul class="dropdown-menu">
                <li><a href="#swicthYear" data-toggle="modal"><i class="pe-7s-shuffle"></i> Switch Year</a></li>
                    <li><a href="<?php echo base_url('dashboard/home/profile') ?>"><i class="pe-7s-users"></i> <?php echo display('profile') ?></a></li>
                    <li><a href="<?php echo base_url('dashboard/home/setting') ?>"><i class="pe-7s-settings"></i> <?php echo display('setting') ?></a></li>
                    <li><a href="<?php echo base_url('logout') ?>"><i class="pe-7s-key"></i> <?php if($this->session->userdata('fullname')){ echo display('logout');}else{echo display('login');} ?></a></li>
                </ul>
            </li>

              <!-- Messages -->
            
        </ul>
        
    </div>
    <span class="title-phone" style="font-size:21px; text-align:center; font-weight:bold; float:left; margin-left:19%; margin-top:15px;">
           
           <span ><?php  echo $setting->title ?></span>
   </span>
</nav>