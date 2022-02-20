<style>
input {
    clear: both;
    padding: 2px;
    border: 0px #FFF;

}

label{
    font-size: x-small;
}
.form-group,.row{
    padding: 5px;
}
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <form class="form" action="<?php echo base_url(); ?>kpi/skpidata" method="post">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>KPI</label>
                                            <select placeholder="Enter KPI" value="" class="form-control select2 kpi" name="kpi">
                                                <?php foreach($kpis as $kpi): ?>
                                                <option value="<?=$kpi->kpi_id?>" data-kpi="<?=json_encode($kpi)?>">
                                                    <?=$kpi->short_name?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <blockquote class="description" style="display: none; margin-top: 10px;"></blockquote>
                                        </div>


                                        <div class="form-group col-md-4">
                                            <label>Financial Year</label>
                                            <input type="text" placeholder="Financial Year" value="" class="form-control">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Frequency</label>
                                            <input type="text" placeholder="Frequency" value="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Period</label>
                                            <input type="text" placeholder="Period" value="" class="form-control">
                                        </div>



                                        <div class="form-group col-md-4">
                                        <label>Dimension One</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Dimension One" value="" class="form-control dimension1">
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label>Dimension One Key</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Dimension One Key" value="" class="form-control dimension1_key">
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label>Dimension Two</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Dimension Two" value="" class="form-control dimension2">
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label>Dimension Two Key</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Dimension Two Key" value="" class="form-control dimension2_key">
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label>Dimension Three</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Dimension Three" value="" class="form-control dimension3">
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label>Dimension Three Key</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Dimension Three Key" value="" class="form-control dimension3_key">
                                        </div>



                                        <div class="form-group col-md-4">
                                        <label>Target</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Target" value="" class="form-control current_target">
                                        </div>

                                         <div class="form-group col-md-4">
                                        <label>Denominator</label>
                                        <input onblur="validateInput($(this))" type="text" placeholder="Denominator" value="" class="form-control denominator">
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label>Numerator</label>
                                        <input  type="text" placeholder="Numerator" value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-4 col-md-offset-8">
                                            <input type="submit" value="SUBMIT DATA" class="btn btn-success col-md-12">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {


   // $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

   function populateInputs(data){

    
    if(data.data){
         $('.dimension1').val(data.data.dimension1).attr('data',data.data.dimension1);
        $('.dimension1_key').val(data.data.dimension1).attr('data',data.data.dimension1);
        $('.dimension2').val(data.data.dimension1).attr('data',data.data.dimension1);
        $('.dimension2_key').val(data.data.dimension1).attr('data',data.data.dimension1);
        $('.dimension3').val(data.data.dimension1).attr('data',data.data.dimension1);
        $('.dimension3_key').val(data.data.dimension1).attr('data',data.data.dimension1);
        $('.denominator').val(data.data.denominator).attr('data',data.data.dimension1);
        $('.current_target').val(data.kpi.current_target).attr('data',data.data.dimension1);
    }
    if(data.kpi){
      $('.description').html(`<h4>${data.kpi.kpi_id} - ${data.kpi.short_name}</h4>${data.kpi.description}`).show();
    }

   }

   function validateInput(input){

     let referenceData  = $(input).attr('data');
     let currentValue   = $(input).val();

     if(referenceData && referenceData !== currentValue){
        $(input).append(`<p> Invalid value for field, expected ${referenceData}.</p>`);
     }

   }

    $(".kpi").change( function(){

        $.blockUI({ css: { backgroundColor: '#000', color: '#fff'} });

        let selectedKpi = $( ".kpi option:selected" ).attr('value');//text();
        console.log(selectedKpi);

      fetch('<?=base_url()?>kpi/fetch_kpi/'+selectedKpi)
      .then(response => response.json())
      .then((data)=>{

            console.log(data);
            populateInputs(data);

            $.unblockUI();

       });
       
    });
})

</script>