

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add Institution Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        <form action="<?php echo base_url(); ?>kpi/addinstitution" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                   
                       <div class="form-group row">
                           
                            <label for="award_name" class="col-sm-3 col-form-label">
                            Institution</label>
                            <div class="col-sm-9">
                           <input type="text" name="name" placeholder="Info Institution Category" class=" form-control">
                               
                            </div>
                           
                        </div>
                         
                        
                          
                        
                    
     
             
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                            <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>