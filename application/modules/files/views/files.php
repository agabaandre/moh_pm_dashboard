<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div> 
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                
                               <div class="card-content">
                                    <div class="col-md-6" >
                                        <h5  style="text-align:left; padding-bottom:1em; text-weight:bold;">KPI Data Upload</h5>
                                                
                                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>files/importcsv" >
                                        
                                            <div class="form-group">
                                                <label>Select CSV file</label>
                                                <input type="file" name="upload_csv_file" required class="btn btn-default">
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" style="margin-top:20px;" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                            </div>
                                            
                                        </form>
                                            
                                        </div>

                        
                               </div>
                           </div> 
                        </div>
                
                    <div class="col-sm-6">
                        <div class="card">
                
                               <div class="card-content">
                                    <div class="col-lg-6" >
                                        <h4  style="text-align:center; padding-bottom:1em; text-weight:bold;">Data Management</h4>
                                        <h5> KPI Data</h5>
                                        <a href="<?php echo base_url();?>cronjobs/truncate" class="btn btn-primary" target="_blank">Truncate KPI Data </a>
                                         <h5> Gauge Data</h5>
                                         <a href="<?php echo base_url();?>cronjobs/gaugedata" class="btn btn-primary" target="_blank">Current Gauge Data </a>
                                         <a href="<?php echo base_url();?>cronjobs/previousgaugedata" class="btn btn-primary" target="_blank">Previous Gauge Data </a>
                                         <h5>Dimension Data</h5>
                                         <a href="<?php echo base_url();?>cronjobs/dimension0" class="btn btn-primary" target="_blank">KPI Trend </a>
                                         <a href="<?php echo base_url();?>cronjobs/dimension1" class="btn btn-primary" target="_blank">Dimension 1 </a>
                                         <a href="<?php echo base_url();?>cronjobs/dimension2" class="btn btn-primary" target="_blank">Dimension 2 </a>
                                         <a href="<?php echo base_url();?>cronjobs/dimension3" class="btn btn-primary" target="_blank">Dimension 3 </a>

                                            
                                        </div>

                        
                               </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>