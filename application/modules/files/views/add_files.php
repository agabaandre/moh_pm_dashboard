<?php
$kpi_id = $this->input->get('kpi_id');
$period = $this->input->get('period');
$sfy = $this->input->get('financial_year');

// Fetch dimensions
$dimsk1 = Modules::run("files/fetch_dimensions1_keys", $kpi_id);
$dim1 = Modules::run("files/fetch_dimension1", $kpi_id);

$dimsk2 = Modules::run("files/fetch_dimensions2_keys", $kpi_id);
$dim2 = Modules::run("files/fetch_dimension2", $kpi_id);

$dimsk3 = Modules::run("files/fetch_dimensions3_keys", $kpi_id);
$dim3 = Modules::run("files/fetch_dimension3", $kpi_id);

// Fetch KPIs
$kpis = [];
$info_cat = $_SESSION['info_category'];
if (!empty($_SESSION['subject_area'])) {
    $id = implode(",", json_decode($_SESSION['subject_area']));
    $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in ($id)")->result();
} else {
    $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in (select id from subject_areas where info_category=$info_cat)")->result();
}
?>

<form method="get" action="" style="margin-bottom:60px; !important">
    <!-- Form fields for KPI selection, financial year, and period -->
     <div class="col-lg-4">
        <label for="kpi_id">Select KPI:</label>
        <select class="form-control" name="kpi_id" required>

            <?php
            $info_cat = $_SESSION['info_category'];
            if (!empty($_SESSION['subject_area'])) {
                @$id = implode(",", json_decode($_SESSION['subject_area']));

                $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in ($id)")->result();
            } else {
                $kpis = $this->db->query("SELECT * FROM `kpi` where subject_area in (select id from subject_areas where info_category=$info_cat)  ")->result();
            }
            foreach ($kpis as $row): ?>
                <option value="<?php echo $row->kpi_id; ?>" <?php if ($row->kpi_id == $kpi_id) {
                       echo "selected";
                   } ?>>
                    <?php echo $row->short_name . '(' . $row->kpi_id . ')'; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-4">
    
        <label for="financial_year">Financial Year:(*)</label>
    
        <select class="form-control select2" name="financial_year" required>
            <option value="">Select Financial Year</option>
            <?php

            $current_date = date('Y-m-d');
            $current_year = date('Y', strtotime($current_date));
            $next_year = $current_year + 1;
            if (date('m-d', strtotime($current_date)) < '06-30') {

                $current_year -= 1;
                $next_year -= 1;
            }
            $current_financial_year = $current_year . '-' . $next_year;
            $startdate = "2022"; // Start of available financial years
            $enddate = intval(date('Y') + 1); // End of available financial years
            $years = range($startdate, $enddate);

            foreach ($years as $year) {
                $financial_year = $year . '-' . ($year + 1);
                ?>
                <option value="<?php echo $financial_year; ?>" <?php if ($financial_year == $sfy) {
                       echo "selected";
                   } ?>>
                    <?php echo $financial_year; ?>
                </option>
            <?php }

            ?>
        </select>
    </div>
    <div class="col-lg-2">
        <label for="period">Period:(*)</label>
        <?php $quaters = array("Q1", "Q2", "Q3", "Q4"); ?>
        <select class="form-control selectize" name="period" required>
            <option value="">Select Period</option>
            <?php foreach ($quaters as $quater) { ?>
    
                <option value="<?php echo $quater; ?>" <?php if ($this->input->get('period') == $quater) {
                       echo "selected";
                   } ?>><?php echo $quater; ?>
                </option>
            <?php } ?>
    
        </select>
    </div>
    <div class="col-lg-2" style="margin-top:20px;">
        <label for="period"></label>
        <button type="submit" class="btn btn-primary">Preview</button>
    </div>
</form>


<form method="post" enctype="multipart/form-data"  action="<?php echo base_url(); ?>files/save_data">
<?php if (!empty($kpi_id) && !empty($period) && !empty($sfy)): ?>
    <div class="row col-lg-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>KPI DATA</h2>
                    <?php //print_r($this->uri->segment(2));?>
                </div>
            </div>
            <div class="col-md-12 text-align-center">
                <h2>Financial Year: <?= $sfy ?> - <?= $period ?> - <?=get_kpi_details($kpi_id)->short_name ?></h2>
            </div>
            <div class="panel-body">
                <div class="card-content body">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    <table class="table table-bordered" style="margin-top:10px">
                        <thead>
                            <tr>
                                <?php if (!empty($dimsk1->dimension1_key)) { ?>
                                <th>Dimension Label</th>
                                <th>Dimension Value</th>
                                <?php } ?>
                                   <?php if (!empty($dimsk2->dimension2_key)) { ?>
                                <th>Dim2 Label</th>
                                
                                <th>Dim Value</th>
                                <?php } ?>
                                  <?php if (!empty($dimsk3->dimension3_key)) { ?>
                                <th>Dim3 Label</th>
                                <th>Dim3 Value</th>
                                <?php } ?>
                                <th>Denominator</th>
                                <th>Numerator</th>
                                <th>Data Target</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                          
                            $count = count($kpi_datas);
                            $rows = max($count, 20); // Ensure at least 10 rows are displayed
                            for ($i = 0; $i < $rows; $i++):
                                $data = isset($kpi_datas[$i]) ? $kpi_datas[$i] : null;
                                if ((!empty($data->numerator)) && ($this->session->userdata('user_type') != 'admin')) {
                                    $disabled = "disabled";
                                    $readonly = "readonly";
                                }
                                $bg = ""; // Default background color is empty
                                if (!empty($data->numerator)) {
                                    $bg = "style='background:#90EE90;'"; // Set background to green if numerator is greater than 0
                                }

                                

                                // Get data for this row if available
                                ?>
                                    <tr <?=$bg?>>
  <!-- <input type="hidden" value="<?= @$data->id ?>" class="form-control" name="id[]"> -->
<input type="hidden" value="<?= @$kpi_id ?>" class="form-control" name="kpi_id[]">
<input type="hidden" value="<?= @$period ?>" class="form-control" name="period[]">
<input type="hidden" value="<?= @$sfy ?>" class="form-control" name="financial_year[]">
   <input type="hidden" value="<?= @getPeriodYear($sfy, $period) ?>" class="form-control" name="period_year[]">
                                   
<?php if (!empty($dimsk1->dimension1_key)) { ?>
<td>
                                  
                                 
                                 
                                        <input type="text" value="<?php if (!empty($data->dimension1_key)) {
                                            echo $data->dimension1_key;
                                        } else {
                                            echo $dimsk1->dimension1_key;
                                        } ?>" class="form-control"
                                            name="dimension1_key[]" <?=$readonly?> readonly>
                                    </td>
                                    <td>
                                        <select class="form-control" id="dimension1" name="dimension1[]" <?= $disabled ?>>
                                            <option value="">Select Dimension1</option>
                                            <?php foreach ($dim1 as $key) { ?>
                                                <option value="<?= $key->dimension1 ?>"<?php if ($key->dimension1 == $data->dimension1) {
                                                      echo "selected"; } ?>><?= $key->dimension1 ?></option>
                                            <?php }
                                            ?>

                                        </select>
                                    </td>
                                    <?php } ?>
                                    <?php if (!empty($dimsk2->dimension2_key)) { ?>
                                    <td>
                                        <input type="text" class="form-control" name="dimension2_key[]"
                                            value="<?php if (!empty($data->dimension2_key)) {
                                                echo $data->dimension2_key;
                                            }else{ echo $dimsk2->dimension2_key;}   ?>" <?= $readonly ?> readonly>
                                    </td>
                                    <td>
                                        <select class="form-control" id="dimension2" name="dimension2[]" <?= $disabled ?>>
                                            <option value="">Select Dimension2</option>
                                            <?php foreach ($dim2 as $key) { ?>
                                                <option value="<?= $key->dimension2 ?>"
                                                <?php if ($key->dimension2 == $data->dimension2) {
                                                    echo "selected";
                                                } ?>><?= $key->dimension2 ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <?php } ?>
                                    <?php if (!empty($dimsk3->dimension3_key)) { ?>
                                    <td>
                                        <input type="text" class="form-control" name="<?php if (!empty($data->dimension3_key)) {
                                            echo $data->dimension3_key;
                                        } else {
                                            echo $dimsk3->dimension3_key;
                                        } ?>" <?= $readonly ?> name="dimension3_key[]" readonly>
                                    </td>
                                    <td>
                                        <select class="form-control" id="dimension3" name="dimension3[]" <?= $disabled ?>>
                                            <option value="">Select Dimension3</option>
                                            <?php foreach ($dim3 as $key) { ?>
                                                <option value="<?= $key->dimension3 ?>"<?php if ($key->dimension3 == $data->dimension3) {
                                                      echo "selected";
                                                  } ?>><?= $key->dimension3 ?></option>
                                            <?php } ?>

                                        </select>
                                    </td>
                                    <?php } ?>
                                    <td><input type="text" class="form-control" name="denominator[]" value="<?=@$data->denominator;?>" <?= $readonly ?>></td>
                                    <td><input type="text" class="form-control" name="numerator[]" value="<?= @$data->numerator; ?>" <?= $readonly ?>></td>
                                    <td><input type="text" class="form-control" name="data_target[]" value="<?php if(!empty($data->data_target)){ echo @$data->data_target;} else{ echo @get_kpi_details($kpi_id)->current_target;}?>" <?= $readonly ?> readonly></td>
                                    <td><input type="text" class="form-control" name="comment[]" value="<?= @$data->comment; ?>" <?= $readonly ?>></td>

                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
 </form>
<?php else: ?>
    <div class="text-align-center col-md-12" style="color:red;">
    <table>
<tr>
        <h2>Please select KPI, Period, and Financial year</h2>
</tr>
    </table>
    </div>
<?php endif; ?>


<script>
$(document).ready(function() {
    // Handle form submission
    $("#dataform").submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            url: "<?php echo base_url('files/save_data'); ?>", // Change the URL to your CodeIgniter controller method
                type: "POST",
                data: formData,
                success: function (response) {
                    // Handle success response
                    console.log(response);
                    // Optionally, display a success message or perform other actions
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                    // Optionally, display an error message or perform other actions
                }
            });
        });
    });
</script>