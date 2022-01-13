

<!-- Modal -->
<div class="modal fade" id="swicthYear" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="margin-top: 50px;">
    <div class="modal-content">

    <form action="<?php echo base_url(); ?>data/switchFacility" enctype="multipart/form-data" method="post" accept-charset="utf-8">
               
      <div class="modal-header">
        <h4>Swicth Financial Year</h4>
      </div>
      
      <div class="modal-body">
      
         
                    <div class="form-group">
                        <?php  $years = ['2020','2021']; ?>
                          <label for="cumulative" class="col-form-label">Choose Year</label>
                      
                           <select name="category_two_id" class="form-control codeigniterselect">
                            <?php foreach($years as $key => $value): ?>
                             <option value="<?php echo $value; ?>">
                                <?php echo $value; ?>
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