
<?php  if(settings()=='category_two_menu.php'): ?>
<form class="row" method="post" id="switchCategoryTwo">

  <div class="form-group">
    <label>Objective: </label>
    <select class="form-control" name="category_two" onchange="$('#switchCategoryTwo').submit()">

        <option value="0">All</option>

          <?php 
            foreach($category_twos as $obj):
                  $selected = ($category_two == $obj->id)?'selected':'';
          ?>
            <option <?php echo $selected; ?> value="<?php echo $obj->id; ?>">
                      <?php echo $obj->cat_name; ?>
            </option>
          <?php endforeach; ?>
      </select>
  </div>
       
</form>
<?php 
 endif; // for category two check

foreach ($subdash as $subd) {       
       echo @Modules::run('data/kpi',$subd->kpi_id,'on');             
 }

 if(count($subdash) == 0):

 ?>

 <h2 class="text-muted text-center"> 
       <i class="fa fa-file"></i>
       <br>
      No data found
</h2>

<?php endif; ?>
