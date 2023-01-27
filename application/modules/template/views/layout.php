<?php defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('includes/head.php'); ?>
</head>

<body class="hold-transition fixed sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <?php require('includes/header.php'); ?>
        </header>


        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar -->
            <?php $this->load->view('includes/sidebar.php') ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!-- <div class="header-icon"><i class="pe-7s-home"></i></div> -->
                <div class="header-title">
                    <h4>


                        <p><a href=" #"><i class="pe-7s-home"></i> Dashboard</a>
                            <?php if (!empty($uptitle)) {
                                echo ' - ' . urldecode($uptitle);
                            } ?>
                        </p>

                    </h4>

                    <?php if ($this->session->userdata('isAdmin')) { ?>
                    <div class="row" style="display:flex; float:right; margin-right:5px; margin-top:-40px;">
                        <a href="<?php echo base_url(); ?>dashboard/slider/department_reporting" class="btn btn-success btn-outline"
                                style="margin-right:5px; margin-top:-40px position: relative; <?php if ($this->uri->segment(2) == "summary") { ?> display:none;<?php } ?>">
                             Reporting Rates
                        </a>
                        <div class="dropdown">
                            <a href="<?php echo base_url(); ?>files/file"
                                class="btn btn-success btn-outline dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="true"
                                style="margin-right:5px; margin-top:-40px position: relative; <?php if ($this->uri->segment(2) == "summary") { ?> display:none;<?php } ?>">
                                Admin Settings
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

                                <li
                                    class="treeview <?php echo (($this->uri->segment(2) == "backup_restore") ? "active" : null) ?>">
                                    <a href="<?php echo base_url('dashboard/backup_restore/index') ?>">
                                        <span>
                                            <?php echo display('backup_and_restore') ?>
                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <a href="<?php echo base_url(); ?>files/file" class="btn btn-success btn-outline"
                            style="margin-right:5px; margin-top:-40px position: relative; <?php if ($this->uri->segment(2) == "summary") { ?> display:none;<?php } ?>">
                            Upload Data
                        </a>

                        <?php } ?>
                        <button type="button" class="btn btn-success btn-outline" style="margin-right:5px; margin-top:-40px position: relative; <?php if ($this->uri->segment(2) == "summary") { ?>
                        display:none;<?php } ?>" data-toggle="modal" data-target="#definition">
                            <?php echo display("definition"); ?>
                        </button>
                        <div>


                        </div>
            </section>


            <!-- Main content -->
            <div class="content row">

                <!-- load messages -->
                <?php include('includes/messages.php'); ?>
                <div class="se-pre-con"></div>
                <!-- load custom page -->


                <?php


                echo $this->load->view($module . '/' . $page) ?>

            </div> <!-- /.content -->


        </div> <!-- /.content-wrapper -->


        <footer class="main-footer">
            <span class="pull-right">
                <img src="<?php echo base_url((!empty($setting->logo) ? $setting->logo : 'assets/img/icons/mini-logo.png')) ?>"
                    style="width:5%; float:right;" alt="">
            </span>
            <div class="pull-right hidden-xs">
                <?php echo (!empty($setting->address) ? $setting->address : null) ?>
            </div>

            <strong>
                <?php echo (!empty($setting->footer_text) ? $setting->footer_text : null) ?>
            </strong>
            <a href="<?php echo current_url() ?>">
                <?php echo (!empty($setting->title) ? $setting->title : null) ?>
            </a>
        </footer>


    </div> <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="definition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Defintions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6"></div>
                    <h3>Gauge Color Themes</h3>
                    <table class="table tabble-reposnive">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>definition</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style=" background-color:green;"></td>
                                <td>Good Performance</td>
                            </tr>
                            <tr>
                                <td style=" background-color:orange;"></td>
                                <td>Average Performance</td>
                            </tr>
                            <tr>
                                <td style=" background-color:red;"></td>
                                <td>Bad Performance</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="col-md-6"></div>
                    <h3>Arrows</h3>
                    <p><i class="fa fa-arrow-down" style="color:red;"></i> A decline in the current period value
                        compared to the previous period value </p>
                    <p><i class="fa fa-arrow-up" style="color:green;"></i> A improvement in the current period value
                        compared to the previous period value </p>
                    <p><i class="fa fa-arrow-right" style="color:orange;"></i> No change in the current period value
                        compared to the previous period value </p>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <!-- Start Core Plugins-->
    <?php require('includes/js.php'); ?>


</body>

</html>