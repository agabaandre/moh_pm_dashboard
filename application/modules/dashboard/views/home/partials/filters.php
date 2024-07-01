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
        <button type="submit" class="btn btn-info waves-effect waves-themed"><i class=""></i>Submit</button>
        <a href="<?php echo base_url() ?>dashboard/home/department_reporting"
            class="btn btn-success waves-effect waves-themed"><i class=""></i>View All</a>
        
        <button type="button" id="export_button" class="btn btn-info waves-effect waves-themed">Export</button>

 
  
    </div>

</div>

 				
<?php


echo form_close();?>