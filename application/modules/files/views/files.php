<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo (!empty($title) ? $title : null) ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">

                            <div class="card-content">
                                <div class="col-md-6">
                                    <h5 style="text-align:left; padding-bottom:1em; text-weight:bold;">KPI Data Upload
                                    </h5>

                                    <form method="post" enctype="multipart/form-data"
                                        action="<?php echo base_url(); ?>files/do_upload">

                                        <div class="form-group">
                                            <label>Select CSV file</label>
                                            <input type="file" name="upload_csv_file" required class="btn btn-default">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" style="margin-top:20px;" class="btn btn-success"><i
                                                    class="fa fa-upload"></i> Upload</button>
                                        </div>

                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">

                            <div class="card-content">
                                <div class="col-lg-6">
                                    <form method="get" 
                                        action="<?php echo base_url(); ?>files/generate_csv_file">
                                        <select class="form-control" name="kpi_id">

                                            <?php
                                            if (!isset($_SESSION['subject_area'])) {
                                            @$id = implode(",", json_decode($_SESSION['subject_area']));
                                           
                                                $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in ($id)")->result();
                                            } else {
                                                $kpis = $this->db->query("SELECT * FROM `kpi`")->result();
                                            }

                                            foreach ($kpis as $row): ?>
                                                <option value="<?php echo $row->kpi_id; ?>"><?php echo $row->short_name .'('.$row->kpi_id.')'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <br/>
                                        <button type="submit" class="btn btn-primary">Sample CSV File  </a>
                                            </form>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>