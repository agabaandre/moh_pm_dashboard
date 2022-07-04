

        
        <?php if ($this->session->userdata('isAdmin')) { ?>



        <li
            class="treeview <?php echo (($this->uri->segment(2) == "user" ) ? "active" : null) ?>">
            <a href="<?php echo base_url();?>files/file">

                <i class="fa fa-upload"></i><span><?php echo "Upload KPI Data" ?></span>
               
              
            </a>
        </li>
        <!-- <li
            class="treeview <?php //echo (($this->uri->segment(2) == "addKpiData" ) ? "active" : null) ?>">
            <a href="<?php //echo base_url();?>kpi/addKpiData">

                <i class="fa fa-plus"></i><span><?php //echo "Add KPI Data" ?></span>
               
              
            </a>
        </li> -->


        <li
            class="treeview <?php echo (($this->uri->segment(2) == "user" ||  $this->uri->segment(2) == "language" || $this->uri->segment(2) == "backup_restore" || $this->uri->segment(2) == "setting" ) ? "active" : null) ?>">
            <a href="#">

                <i class="ti-settings"></i><span><?php echo display('setting') ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="treeview <?php echo (($this->uri->segment(2) == "user") ? "active" : null) ?>">
                    <a href="#">
                        <span><?php echo display('user') ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a
                                href="<?php echo base_url('dashboard/user/form') ?>"><?php echo display('add_user') ?></a>
                        </li>
                        <li><a
                                href="<?php echo base_url('dashboard/user/index') ?>"><?php echo display('user_list') ?></a>
                        </li>
                    </ul>
                </li>

            
               <li class="treeview <?php echo (($this->uri->segment(2) == "setting") ? "active" : null) ?>">
                    <a href="<?php echo base_url(); ?>kpi/subject">
                        <span><?php echo "Subject Areas" ?></span>
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2) == "setting") ? "active" : null) ?>">
                    <a href="<?php echo base_url(); ?>kpi/categoryTwo">
                        <span><?php echo "Objectives /  Category Two" ?></span>
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2) == "setting") ? "active" : null) ?>">
                    <a href="<?php echo base_url(); ?>kpi/kpis">
                        <span><?php echo "Performance Indicators" ?></span>
                    </a>
                </li>

                   <li class="treeview <?php echo (($this->uri->segment(2) == "setting") ? "active" : null) ?>">
                    <a href="<?php echo base_url(); ?>kpi/kpiDisplay">
                        <span><?php echo "Kpi Display Control" ?></span>
                    </a>
                </li>                    

                <li class="treeview <?php echo (($this->uri->segment(2) == "setting") ? "active" : null) ?>">
                    <a href="<?php echo base_url('dashboard/setting') ?>">
                        <span><?php echo display('application_setting') ?></span>
                    </a>
                </li>
             
                <li class="treeview <?php echo (($this->uri->segment(2) == "language") ? "active" : null) ?>">
                    <a href="<?php echo base_url('dashboard/language') ?>">
                        <span><?php echo display('language') ?></span>
                    </a>
                </li>

                <li class="treeview <?php echo (($this->uri->segment(2) == "backup_restore") ? "active" : null) ?>">
                    <a href="<?php echo base_url('dashboard/backup_restore/index') ?>">
                        <span><?php echo display('backup_and_restore') ?></span>
                    </a>
                </li>



            </ul>

        </li>

  <?php } ?>