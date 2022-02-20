

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-full" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add KPI</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form  action="<?php echo base_url(); ?>kpi/addkpi" enctype="multipart/form-data" method="post" accept-charset="utf-8">
          
      <div class="modal-body">
              <div class="row">
                <div class="col-md-6">

                       <div class="form-group">
                            <label for="kpiid" class="col-form-label">
                            Indicator Identifier(KPI ID)</label>
                           <input type="text" name="kpi_id" placeholder="KPI-0" class=" form-control">
                        </div>

                        <div class="form-group">
                            <label for="shortname" class="col-form-label">
                            Short Name</label>
                           <input type="text"  name="short_name" placeholder="KPI Short Name" class=" form-control">
                        </div>
                        
                            <div class="form-group">
                                <label for="indiactor_statement" class="col-form-label">
                                Indicator Statement</label>
                              <textarea name="indicator_statement" class="form-control" id=""></textarea>    
                            </div>

                            <?php  if(uses_category()): ?>

                            <div class="form-group">
                              <label for="cumulative" class="col-form-label">
                                Objective</label>
                              <select name="category_two_id" class="form-control codeigniterselect">
                                <?php foreach($category_twos as $obj): ?>
                                  <option value="<?php echo $obj->id; ?>">
                                      <?php echo $obj->cat_name; ?>
                                  </option>
                                <?php endforeach; ?>
                                </select>  
                            </div>

                            <?php endif ; ?>

                            <div class="row">
                            
                                <div class="form-group col-lg-4">
                                  <label for="frequency" class="col-form-label"> Frequency</label>
                                    <select name="frequency" class="form-control codeigniterselect">
                                      <option value="Annualy" selected="selected">Annualy</option>
                                      <option value="Monthly" selected="selected">Monthly</option>
                                      <option value="Quarterly" selected="selected">Quarterly</option>
                                    </select>  
                                </div>

                                <?php  if(uses_category()): ?>

                                  <div class="form-group col-lg-4">
                                    <label for="kpi_type" class="col-form-label">
                                      Indicator Type</label>
                                    <select name="indicator_type_id" id="kpi_type" class="form-control codeigniterselect">
                                        <option value="1">Outcome</option>
                                        <option value="2">Output</option>
                                      </select>  
                                  </div>

                                  <?php endif ; ?>

                                  <div class="form-group col-lg-4">
                                    <label for="cumulative" class="col-form-label">
                                      Is Cumulative</label>
                                    <select name="is_cumulative" class="form-control codeigniterselect">
                                      <option value="0" selected="selected">No</option>
                                      <option value="1" selected="selected">Yes</option>
                                      </select>  
                                  </div>
                              </div>
                        <div class="form-group">
                           <label for="description" class="col-form-label">
                           Computation  Method</label>
                          <textarea name="computation" col="6" rows="3" class="form-control" id=""></textarea>
                        </div>
                       
                  </div>


                  <!--End divider -->
                  <div class="col-md-6">
                     
                          <div class="form-group">
                           
                            <label for="description" class="col-form-label">
                            Current Target</label>
                           <input type="number" name="current_target"  class="form-control" id="">
                           
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">
                            Indicator description</label>
                           <textarea name="description" col="10" rows="5" class="form-control" id=""></textarea>
                        </div>
                      
                          <div class="form-group">
                            <label for="description" class="col-form-label">
                            Data Sources</label>
                           <textarea name="data_sources" class="form-control" id=""></textarea>
                        </div>

                        <?php  if( !uses_category()): ?>
                        <div class="form-group">
                           
                          <label for="subject" class="col-form-label">
                            Subject Area</label>
                           <select name="subject_area" class="form-control codeigniterselect">
                             <?php    
                               $elements = Modules::run('Kpi/subjectData');
                              foreach($elements as $element):?>
                                <option value="<?php echo $element->id ?>" selected="selected"><?php echo $element->name ?></option>
                              <?php endforeach; ?>
                            </select>  
                        </div>
                        <?php endif ; ?>
                       
                    </div>
                </div>
       </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="reset" class="btn btn-primary w-md">Reset</button>
            <button type="submit" class="btn btn-success w-md">Save</button>
         </div>
         </div>
        </form>
        
      </div>
    </div>
  </div>
