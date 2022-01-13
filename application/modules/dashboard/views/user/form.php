<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       
                    </div>
                </div>
                <div class="panel-body">
                <?php echo form_open_multipart("dashboard/user/form/$user->id") ?>
                    
                    <?php echo form_hidden('id',$user->id) ?>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-3 col-form-label"><?php echo display('firstname') ?> *</label>
                        <div class="col-sm-9">
                            <input name="firstname" class="form-control" type="text" placeholder="<?php echo display('firstname') ?>" id="lastname" value="<?php echo $user->firstname ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-sm-3 col-form-label"><?php echo display('lastname') ?> *</label>
                        <div class="col-sm-9">
                            <input name="lastname" class="form-control" type="text" placeholder="<?php echo display('lastname') ?>" id="lastname" value="<?php echo $user->lastname ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> *</label>
                        <div class="col-sm-9">
                            <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email_id" value="<?php echo $user->email ?>">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> *</label>
                        <div class="col-sm-9">
                            <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password">
                            <input name="oldpassword" class="form-control" type="hidden" value="<?php echo $user->password ?>">
                        </div>
                    </div>

                

                    <div class="form-group row">
                    
                        <div class="col-sm-9">
                            <input type="hidden" name="image" id="image" aria-describedby="fileHelp">
                            <small id="fileHelp" class="text-muted"></small>
                             <input type="hidden" name="old_image" value="<?php echo $user->image ?>">
                        </div>
                    </div> 

         
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status *</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($user->status==1 || $user->status==null)?true:false), 'id="status"'); ?>Active
                            </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($user->status=="0")?true:false) , 'id="status"'); ?>Inactive
                            </label> 
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


 