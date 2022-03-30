

<!-- Modal -->
<div class="modal fade" id="swicthdepartment" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="margin-top: 50px;">
    <div class="modal-content">

    <form action="<?php echo base_url(); ?>limits/setYear" enctype="multipart/form-data" method="post" accept-charset="utf-8">
               
      <div class="modal-header">
        <h4>Browse Department Data</h4>
      </div>
      
      <div class="modal-body">
      
         
                    <div class="form-group">
                        <?php  $years = $this->db->query("SELECT distinct financial_year from new_data")->result(); ?>
                          <label for="cumulative" class="col-form-label">Choose Department</label>
                         
                           <select name="financial_year" class="form-control codeigniterselect">
                           <?php $deps=Modules::run('kpi/subjectData'); ?>
                             <option value="">ALL</option>
                            <?php foreach ($deps as $dep): ?>
                             <option value="<?php echo $dep->subject_id; ?>">
                                <?php echo $dep->name; ?>
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
      </div>
      
      </form>
    </div>
  </div>
</div>