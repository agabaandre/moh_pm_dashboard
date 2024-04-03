<?php echo form_open_multipart(base_url('dashboard/home/department_reporting'), array('id' => 'preview', 'class' => 'preview', 'method' => 'get')); ?>
<div class="row">

    <div class="form-group col-md-3 col-sm-12">

    <label for="focus_areas">Subject Areas:</label>
        <select class="form-control select2" name="subject_area" onchange="getkpis(this.value)">
            <option value="" Selected>View All</option>
            <?php
            $departments = Modules::run('dashboard/home/get_departments');
          
            foreach ($departments as $list) {

              
                

                ?>
                <option value="<?php echo $list->id; ?>" <?php if ($this->input->get('subject_area') == $list->id) {
                       echo "selected";
                   } ?>><?php echo $list->name; ?>
                </option>
            <?php } 
            
            ?>

        </select>
    </div>
       <div class="form-group col-md-6 col-sm-12">

        <label for="focus_areas">KPI:</label>
        <select class="form-control select2 performance_kpis" name="kpi_id" id="" multiple>
             <option value="<?php echo $this->input->get('kpi_id') ?>">
                <?=@getkpi_info($this->input->get('kpi_id'))->short_name ?>
            </option>
          
           
    
        </select>
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label for="financial_year">Financial Year:(*)</label>

    <select class="form-control selectize" name="financial_year" required>
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
                    <option value="<?php echo $financial_year; ?>" <?php if (($current_financial_year === $financial_year)|| ($financial_year===$this->input->get('financial_year)'))) {
                           echo "selected";
                       } ?>>
                        <?php echo $financial_year; ?>
                    </option>
                <?php } 
                
                ?>
     </select>

 
  
    </div>

</div>

  <button type="submit" class="btn btn-info waves-effect waves-themed"><i class=""></i>Submit</button>
  <a href="<?php echo base_url()?>dashboard/home/department_reporting" class="btn btn-success waves-effect waves-themed"><i class=""></i>View All</a>
  
  <button type="button" id="export_button" class="btn btn-info waves-effect waves-themed">Export</button>
    				
<?php


echo form_close();?>