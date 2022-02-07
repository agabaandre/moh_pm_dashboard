    
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       <h4><?php echo (!empty($title)?$title:null) ?></h4>
                       
                    </div>
                </div>
                <div class="panel-body">

                <?php echo form_open_multipart('dashboard/setting/create','class="form-inner"') ?>
                    <?php echo form_hidden('id',$setting->id) ?>

                    <div class="form-group row">
                        <label for="title" class="col-xs-3 col-form-label"><?php echo display('application_title') ?> <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('application_title') ?>" value="<?php echo $setting->title ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                        <div class="col-xs-9">
                            <input name="address" type="text" class="form-control" id="address" placeholder="<?php echo display('address') ?>"  value="<?php echo $setting->address ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-xs-3 col-form-label"><?php echo display('email')?></label>
                        <div class="col-xs-9">
                            <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo $setting->email ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                        <div class="col-xs-9">
                            <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>"  value="<?php echo $setting->phone ?>" >
                        </div>
                    </div>


                    <!-- if setting favicon is already uploaded -->
                    <?php if(!empty($setting->favicon)) {  ?>
                    <div class="form-group row">
                        <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="favicon" class="col-xs-3 col-form-label"><?php echo display('favicon') ?> </label>
                        <div class="col-xs-9">
                            <input type="file" name="favicon" id="favicon">
                            <input type="hidden" name="old_favicon" value="<?php echo $setting->favicon ?>">
                        </div>
                    </div>


                    <!-- if setting logo is already uploaded -->
                    <?php if(!empty($setting->logo)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($setting->logo) ?>" alt="Picture" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="logo" class="col-xs-3 col-form-label"><?php echo display('logo') ?></label>
                        <div class="col-xs-9">
                            <input type="file" name="logo" id="logo">
                            <input type="hidden" name="old_logo" value="<?php echo $setting->logo ?>">
                        </div>
                    </div>
                         <div class="form-group row">
                        <label for="gauge_config" class="col-xs-3 col-form-label"><?php echo display('gauge_config') ?></label>
                        <div class="col-xs-9">
                            <textarea name="gauge_config" class="form-control"  placeholder="" maxlength="140" rows="15">
                                <?php echo $setting->gauge_config; ?></textarea>
                        </div>
                    </div>   

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('language') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('language',$languageList,$setting->language, 'class="form-control"') ?>
                        </div>
                    </div> 

                    
                             <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('time_zone') ?></label>
                        <div class="col-xs-9">
        
                            <?php echo form_dropdown('timezone', $timezonelist, $setting->timezone , array('class'=>'form-control')); ?>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('dash_display') ?></label>
                        <div class="col-xs-9">
                        <select class="form-control" name="dash_rows">
                        <?php $cols=array("1 Column"=>"12","2 Columns"=>"6","3 Columns - Preferred"=>"4","4 columns"=>"3"); 
                        
                        foreach($cols as $key => $value){
                        ?>
                           <option value="<?php echo $value ?>" <?php if ($setting->dash_rows==$value){ echo "selected"; } ?>><?php echo $key; ?></option>
                        <?php } ?>
                        
                        </select>
        
                        </div>
                    </div> 
                        <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('Financial_Year') ?></label>
                        <div class="col-xs-9">
                        <select class="form-control" name="financial_year">

                            <?php  echo financial_years(); ?>
                        
                        </select>
        
                    </div>
                    </div> 
                    
                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('kpi_display') ?></label>
                        <div class="col-xs-9">
                        <select class="form-control" name="kpi_rows">
                        <?php $cols=array("1 Column"=>"12","2 Columns - Preferred"=>"6","3 Columns"=>"4","4 columns"=>"3"); 
                        
                        foreach($cols as $key => $value){
                        ?>
                           <option value="<?php echo $value ?>" <?php if ($setting->kpi_rows==$value){ echo "selected"; } ?>><?php echo $key; ?></option>
                        <?php } ?>
                        
                        </select>
                        </div>
                    </div> 

                     <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('menu_type') ?></label>
                        <div class="col-xs-9">
                            <select class="form-control" name="use_category_two">
                               <option <?php echo ($setting->use_category_two==0)?'selected':'' ?> value="0">Subject Area>>Indictors (MOH)</option>
                               <option <?php echo ($setting->use_category_two==1)?'selected':'' ?> value="1">Department>>Subject Area>>Indictors(MOH)</option>
                               <option <?php echo ($setting->use_category_two==2)?'selected':'' ?> value="1">Inicator Type>>Subject Area>>Indictors(CPHL)</option>
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('site_align') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')) ,$setting->site_align, 'class="form-control"') ?>
                        </div>
                    </div> 
                      <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('font_awesome') ?></label>
                        <div class="col-xs-9">
                            <textarea name="font_awesome" class="form-control"  placeholder="font awesome" maxlength="140" rows="15"><?php echo $setting->font_awesome ?></textarea>
                        </div>
                    </div>   

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('footer_text') ?></label>
                        <div class="col-xs-9">
                            <textarea name="footer_text" class="form-control"  placeholder="Footer Text" maxlength="140" rows="7"><?php echo $setting->footer_text ?></textarea>
                        </div>
                    </div>   

                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>