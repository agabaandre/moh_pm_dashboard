  <a href="<?php echo base_url(); ?>files/file" class="btn btn-success btn-outline"
        style="margin-right:5px; margin-top:0px  <?php if ($this->uri->segment(2) == "summary") { ?> display:none;<?php } ?>">
        Upload Data
    </a>
<?php if ($this->session->userdata('user_type') == 'admin') { ?>

    <div class="dropdown">


        <a href="<?php echo base_url(); ?>files/file" class="btn btn-success btn-outline dropdown-toggle"
            data-toggle="dropdown" aria-expanded="true" style="margin-right:5px;">
            Admin Settings
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo base_url(); ?>kpi/view_kpi_data">
                    <span>
                        <?php echo "KPI Data" ?>
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>kpi/subject">
                    <span>
                        <?php echo "Subject Areas" ?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>kpi/info_category">
                    <span>
                        <?php echo "Info Category" ?>
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
    </div>
  
<?php } ?>