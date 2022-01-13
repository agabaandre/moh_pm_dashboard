 "use strict"; 
 function parentchange() {
            var  hdcode     = $('#paytype').val();
            var dataString  = 'paytype='+ hdcode;
            var base_url    = $('#baseUrl').val();
            var paymentcode = '#headcode';
            var csrf_test_name = $('[name="csrf_test_name"]').val();
              $.ajax
                   ({
                        type: "POST",
                        url: base_url+"/income/income/retrieve_paytypedata",
                        data: {
                          'paytype':hdcode,
                          csrf_test_name:csrf_test_name
                        },
                        cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                            $(paymentcode).html(obj.headcode);
                        } 
                    });

}

 "use strict"; 
 function formatcheck(input) {

  var nStr = input.value + '';  
  nStr = nStr.replace(/[^0-9]/g, "");
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';  
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  input.value = x1 + x2;

}

 "use strict"; 
  function cmbCode_onchange(){
      var Sel=$('#cmbCode').val();
      var Text=$('#cmbCode').text();
      var select= $("option:selected", $("#cmbCode")).text()
        $("#txtName").val(select);
        $("#txtCode").val(Sel);
    }

    /*contra voucher */
 "use strict"; 
     function load_codecontra(id,sl){
    var base_url = $("#base_url").val();

    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

 "use strict"; 
    function addaccountcontra(divName){
      var optionval = $("#headoption").val();
    var row = $("#debtAccVoucher tbody tr").length;
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");

           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codecontra(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='0' id='txtAmount_"+ count +"' onkeyup='calculationcontra("+ count +")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_"+ count +"' value='0' onkeyup='calculationcontra("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowcontra(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
            $("#cmbCode_"+count).html(optionval);
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

 "use strict"; 
function calculationcontra(sl) {
        var gr_tot1=0;
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

 $(".total_price1").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
        });
        $("#grandTotal").val(gr_tot.toFixed(2,2));
         $("#grandTotal1").val(gr_tot1.toFixed(2,2));
    }

 "use strict"; 
    function deleteRowcontra(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationcontra()
    }
     /*Credit voucher part*/
      "use strict"; 
      function load_codeCreditv(id,sl){
    var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

 "use strict"; 
    function addaccountCreditv(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codeCreditv(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='text' name='txtAmount[]' class='form-control total_price' id='txtAmount_"+ count +"' onkeyup='calculationCreditv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowCreditv(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
           $("#cmbCode_"+count).html(optionval);
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

 "use strict"; 
function calculationCreditv(sl) {
       
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }

 "use strict"; 
    function deleteRowCreditv(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationCreditv()
    }


/*Debit Voucher part*/
 "use strict"; 
 function load_codeDebtv(id,sl){
    var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

 "use strict"; 
    function addaccountDebt(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codeDebtv(this.value,"+ count +")'><?php foreach ($acc as $acc2) {?><option value='<?php echo $acc2->HeadCode;?>'><?php echo $acc2->HeadName;?></option><?php }?></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='text' name='txtAmount[]' class='form-control total_price' id='txtAmount_"+ count +"' onkeyup='calculationDebtv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowDebtv(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          $("#cmbCode_"+count).html(optionval);
          document.getElementById(tabin).focus();
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }


 "use strict"; 
function calculationDebtv(sl) {
       
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }


 "use strict"; 
    function deleteRowDebtv(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationDebtv()
    }

   /* Generel Ledger part*/
       $(document).ready(function(){
         "use strict"; 
        $('#cmbGLCode').on('change',function(){
          var base_url = $("#base_url").val();
           var Headid=$(this).val();
            var csrf_test_name = $('[name="csrf_test_name"]').val();
            $.ajax({
                 url: base_url + 'accounts/general_led',
                type: 'POST',
                data: {
                    Headid: Headid,
                    csrf_test_name:csrf_test_name
                },
                success: function (data) {
                   $("#ShowmbGLCode").html(data);
                }
            });

        });
    });
/*       Journal voucher */
"use strict";
function load_codeJournalv(id,sl){
var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
   "use strict";
    function addaccountJournalv(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codeJournalv(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='0' id='txtAmount_"+ count +"' onkeyup='calculationJournalv("+ count +")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_"+ count +"' value='0' onkeyup='calculationJournalv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowJournalv(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
          $("#cmbCode_"+count).html(optionval);
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

"use strict";
function calculationJournalv(sl) {
        var gr_tot1=0;
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

 $(".total_price1").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
        });
        $("#grandTotal").val(gr_tot.toFixed(2,2));
         $("#grandTotal1").val(gr_tot1.toFixed(2,2));
    }
 
 "use strict";
    function deleteRowJournalv(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationJournalv()
    }
  /*chart of account*/
  "use strict";
  function loadData(id){
  var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/accounts/selectedform/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            $('#newform').html(data);
             $('#btnSave').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

  "use strict";
    function newdata(id){
       var base_url = $("#base_url").val(); 
     $.ajax({
        url : base_url + "accounts/accounts/newform/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
           console.log(data.rowdata);
           var headlabel = data.headlabel;
           $('#txtHeadCode').val(data.headcode);
            document.getElementById("txtHeadName").value = '';
            $('#txtPHead').val(data.rowdata.HeadName);
            $('#txtHeadLevel').val(headlabel);
            $('#btnSave').prop("disabled", false);
             $('#btnSave').show();
            $('#btnUpdate').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

    $(document).ready(function () {
       "use strict";
  $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
  });