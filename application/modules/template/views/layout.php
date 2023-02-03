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
            <?php if($this->uri->segment(1)=='dashboard'){$margin=" background:#fff !important; ";}else{$margin="background:#fff !important;";} ?>
            <section class="content-header" style="<?php echo $margin;?> height:60px; border: 1px #979797 solid; border-bottom-left-radius:10px !important; border-bottom-right-radius:10px !important">
                <!-- <div class="header-icon"><i class="pe-7s-home"></i></div> -->
                <div class="header-title">
                    <?php if (($this->session->userdata('isAdmin'))||($this->session->userdata('user_type')=='admin')) { ?>
                    <div class="row" style="display:flex; float:right; margin-right:5px;"> 
                        <div class="dropdown">
                            <a href="<?php echo base_url(); ?>files/file"
                                class="btn btn-success btn-outline dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="true"
                                style="margin-right:5px;">
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
                            style="margin-right:5px; margin-top:0px  <?php if ($this->uri->segment(2) == "summary") { ?> display:none;<?php } ?>">
                            Upload Data
                        </a>

                        <?php } ?>
                        <button type="button" class="btn btn-success btn-outline" style="margin-right:5px; margin-top:0px  <?php if ($this->uri->segment(2) == "summary") { ?>
                        display:none;<?php } ?>" data-toggle="modal" data-target="#definition">
                            <?php echo display("definition"); ?>
                        </button>
            


                        </div>
                        </div>
            </section>

            <?php //print_r($this->session->userdata());?>
            <!-- Main content -->
            <div class="content row">
        

                <!-- load messages -->
                <?php include('includes/messages.php'); ?>
                <div class="se-pre-con">
                    
                </div>
                 <p><a href=" #"><i class="pe-7s-home"></i> Dashboard</a>
                            <?php if (!empty($uptitle)) {
                                echo ' - ' . urldecode($uptitle) .' - ( Finacial Year: '. $_SESSION['financial_year'].')';
                            } ?>
                </p>
                <!-- load custom page -->


                <?php


                echo $this->load->view($module . '/' . $page) ?>

            </div> <!-- /.content -->


        </div> <!-- /.content-wrapper -->


        <footer class="main-footer" style="text-align:center; font-size:11px;">
          
            <div class="">
                <?php echo (!empty($setting->address) ? $setting->address : null) ?>
            </div>

            <strong>
                <?php echo (!empty($setting->footer_text) ? $setting->footer_text : null) ?>
            </strong>
            <a href="<?php echo current_url() ?>">
                <?php echo (!empty($setting->title) ? $setting->title : null) ?> <?php echo "-".date('Y'); ?>
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
                                <td style=" background-color:gray;"></td>
                                <td>Above Performance</td>
                            </tr>
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


    <!-- <switch year> -->

     <!-- Modal -->
    <div class="modal fade" id="switchYear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Financial Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">   

            <form action="<?php echo base_url(); ?>dashboard/auth/financialYear" enctype="multipart/form-data" method="post" accept-charset="utf-8">
         
                    <div class="form-group">
                               <?php  $years = $this->db->query("SELECT distinct financial_year from new_data")->result(); ?>
                          <label for="cumulative" class="col-form-label">Choose Year</label>
                      
                           <select name="financial_year" class="form-control codeigniterselect">
                             <option value="" disabled>ALL</option>
                            <?php foreach($years as $value): ?>
                             <option value="<?php echo $value->financial_year; ?>">
                                <?php echo $value->financial_year; ?>
                             </option>
                            <?php endforeach; ?>
                            </select>  
                        </div>              
                        </div>
                        
                  
        <div class="modal-footer">
                           <div class="form-group text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-primary w-md m-b-5">Cancel</button>
            <button type="submit" class="btn btn-success w-md m-b-5">Confirm</button>
        </div>

              </form>
               
                </div>

         

                </div>
            </div>
        </div>
    </div>


    <!-- <switch year> -->


    <!-- Start Core Plugins-->
    <?php require('includes/js.php'); ?>


</body>

</html>