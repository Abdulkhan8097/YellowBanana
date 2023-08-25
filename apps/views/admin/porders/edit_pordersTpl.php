<?php //echo"<pre>"; ?>
<?php //print_r($edit); die;?>
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit New PORDER</div>
                    </div>
                    <?php //echo "<pre>"; print_r($result[0]);echo "</pre>"; ?>
                    <div class="card-body col-md-10">
                        <!-- <div class="col-lg-8"> -->
                            <form class="card" id='add_po_form' method='post' action="<?php echo site_url('adminPorders/update_poorder'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">

                                            <div class="form-group">
                                                <label class="form-label">Select Outlet</label>
                                                <select class="form-control select2-show-search" data-placeholder="Select Outlet" name='outlet' id='outlet' required>
                                                    <option value="">--Select--</option>
                                                   
                                                     <?php if(isset($outlets) && !empty($outlets)){
                                                    foreach($outlets as $value)
                                                    { ?>
                                                    
                                                        <option value="<?php echo $value['id']; ?>" <?php echo (isset($edit) && !empty($edit) && $edit['id']==$value['id']) ? 'selected' : '';?>>
                                                        <?php echo $value['name']; ?>
                                                         </option>
                                                         <?php } }?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Party Name</label>
                                                <select class="form-control select2-show-search" data-placeholder="Select Vendor" name='party_name' id='outlet' required>
                                                    <option value="">--Select--</option>
                                                    <?php
                                                    foreach($party as $vendor)
                                                    { ?>
                                                      
                                                         <option value="<?php echo $vendor['vendor_id']; ?>" <?php echo (isset($vendors) && !empty($vendors) && $vendors['vendor_id']==$vendor['vendor_id']) ? 'selected' : '';?>>
                                                        <?php echo $vendor['vendor_name']; ?>
                                                         </option>
                                                         <?php } ?>
                                                    
                                                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Task</label>
                                                <textarea class="form-control" name="task" id="tasklist"><?php echo $result[0]['task_details'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-responsive createpo" style="display: inline-table;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:2%">SR.No</th>
                                                        <th>Discription</th>
                                                        <th style="width:14%">HSN</th>
                                                        <th style="width:14%">Qty</th>
                                                        <th style="width:14%">Unit Price</th>
                                                        <th style="width:14%">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $exp_discri    = explode(',',$result[0]['description']);
                                                    $exp_hsn       = explode(',',$result[0]['hsn']);
                                                    $exp_quantity  = explode(',',$result[0]['quantity']);
                                                    $exp_total     = explode(',',$result[0]['total']);
                                                    $exp_unit_price= explode(',',$result[0]['unit_price']);
                                                    $exp_mo_id= explode(',',$result[0]['mo_id']);
                                                    
                                                    $count = count($exp_discri);
                                                    for ($i=0; $i < $count; $i++)
                                                    {
                                                    // }
                                                    // foreach ($exp_discri as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i+1 ?> <input type="hidden" name="mo_id[]" value="<?php echo $exp_mo_id[$i] ?>"></td>
                                                            <td><textarea class="form-control" name="description[]" id="description1"><?php echo $exp_discri[$i] ?></textarea></td>
                                                            <td><input type="number" class="form-control" value="<?php echo $exp_hsn[$i] ?>" name="hsn[]" id="hsn1" placeholder="hsn" required=""></td>
                                                            <td><input type="number" class="form-control qty" value="<?php echo $exp_quantity[$i] ?>" name="qty[]" id="qty1" placeholder="quantity" required=""></td>
                                                            <td><input type="number" class="form-control unit_price" value="<?php echo $exp_unit_price[$i] ?>" name="unit_price[]" id="unit_price1" placeholder="Unit price" required=""></td>
                                                            <td><input type="number" class="form-control total" readonly="" value="<?php echo $exp_total[$i] ?>" name="total[]" id="total1" placeholder="Total" required=""></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                           <!--  <button type="button" style="float: none;" class="btn btn-primary add_new_discription pull-right" id="add_new_discription">Add</button>
                                            <button type="button" style="float: none;" class="btn btn-primary remove_last_discription pull-right" id="remove_last_discription">Cancel</button>
                                            <div class="form-group"> -->
                                                <!-- </div> -->
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Gross Total</label>
                                                    <input type="number" class="form-control" readonly="" value="<?php echo $result[0]['gross_total'] ?>" name="gross_total" id="gross_total" placeholder="Amount" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tax Slab</label>
                                                    <select class="form-control" data-placeholder="Select Tax Slab" name='taxslab' id='taxslabs'>
                                                        <option value="">--Select--</option>
                                                        <?php
                                                        foreach($arrTaxslab as $taxDetail)
                                                        {
                                                          $selected = $taxDetail['id'] == $result[0]['tax_id'] ?'selected':''; 
                                                          echo "<option value='".$taxDetail['id']."' ".$selected.">".$taxDetail['taxname']."</option>";
                                                      }
                                                      ?>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Amount</label>
                                                <input readonly="" type="number" class="form-control" name="amount" id="amount" value="<?php echo $result[0]['amount'] ?>" placeholder="Amount" required>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Priority</label>
                                                <select class="form-control select2-show-search" data-placeholder="Select Priority" name='priority' id='priority'>
                                                    <option value="">--Select--</option>
                                                    <?php
                                                    foreach($arrpriority as $key=>$value)
                                                    {
                                                        $selected = $key == $result[0]['order_priority'] ?'selected':''; 
                                                        echo "<option value='".$key."' ".$selected.">".$value."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label">Attached Document (Optional)</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="photograph" onchange="readURL(this);">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div id='preview'>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                  <!-- <input type = 'hidden' name='usertype' value='general_manager'> -->
                                  <input type="hidden" name="id" value="<?php echo $result[0]['order_id']; ?>">
                                  <input type="hidden" name="document_name" value="<?php echo $result[0]['document_name']; ?>">
                                  <button type="submit" class="btn btn-success pull-left">Submit</button>
                                  <button id='cancel' type="button" class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button>
                              </div>
                          </form>
                          <!-- </div> -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php $this->load->view('admin/footer'); ?>
  </div>
  <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
           $('#preview').html(input.files[0].name);
       }
   }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
    $('#add_po_form').validate({
        rules: {
            amount    : {required: true,number:true},
            outlet    :{required:true},
            party_name:{required:true},
            priority  :{required: true},
            task      :{required: true},
            taxslab   :{required:true},
            qty   :{required:true,number:true},
            unit_price   :{required:true,number:true},
            description:{required:true},
        },
        messages:{
            amount    : {required: "Please enter amount"},
            outlet    :{required:"Please select outlet"},
            party_name:{required:"Please select Party name"},
            priority  :{required: "Please select priority"},
            task      :{required: "Please enter your task"},
            qty      :{required: "Please enter quantity"},
            unit_price      :{required: "Please enter unit_price"},
            taxslab   :{required:"Please select tax slab"},
            description:{required:"Please Enter discription"},
        }
    });

      //cancel
      $('#cancel').click(function(){
        window.location.href = "<?php echo site_url('porders'); ?>";
    });

  });
 $('.qty, .unit_price').keydown(function(e)
 {  
    // var keyCode = (e.keyCode ? e.keyCode : e.which);
    // if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107 )
    // {
    //     alert('Please enter integer value only');
    //     this.value = this.value.replace(/[0-9]/g, "");
    // }
});

 $(document).on('change','.qty, .unit_price',function(event) {

    var parent=$(this).parent().parent();

    var qty = $(parent).find(".qty").val();
    var unit_price = $(parent).find(".unit_price").val();
    if(unit_price == null || unit_price == '')
    {
        unit_price = 0;
    }
    var total = qty*unit_price;
    parent.find(".total").val(qty*unit_price);
    calculateGrossTotal();
});

 function calculateGrossTotal()
 {
    var gross_total =0;
    $(".total").each(function () {
        var stval = parseFloat($(this).val());
        gross_total += isNaN(stval) ? 0 : stval;
    });
    // console.log(gross_total);
    $("#gross_total").val(gross_total);
    var percent =  $("#taxslabs option:selected").text();
    if (percent!='NIL / EXEMPT') {

        var percent =  $("#taxslabs option:selected").text().split("%");
        percent = percent[0];

        var grand_total =Math.round(parseInt(gross_total)+parseFloat(gross_total*(percent/100)));
        $('#amount').val(grand_total);
    }else{
        $('#amount').val(gross_total);
    }
}

$('#taxslabs').change(function(event) {
    // console.log(event);
    var gross_total = $("#gross_total").val();
    var percent =  $("#taxslabs option:selected").text();
    if (percent!='NIL / EXEMPT') {

        var percent =  $("#taxslabs option:selected").text().split("%");
        percent = percent[0];

        var grand_total =Math.round(parseInt(gross_total)+parseFloat(gross_total*(percent/100)));
        $('#amount').val(grand_total);
    }else{
        $('#amount').val(gross_total);
    }
});

$('#add_new_discription').click(function(event)
{

        // var td = parseInt(document.getElementsByTagName('tbody')[0].lastChild.previousSibling.innerText)+1;
        var td = parseInt($('tbody tr:last').text())+1;

        var tr = "<tr><td>"+td+"</td><td><textarea class='form-control' name='description[]'></textarea></td><td><input type='number' class='form-control' name='hsn[]' id='hsn2' placeholder='hsn' required=''></td><td><input type='number' class='form-control qty' name='qty[]' id='qty2' placeholder='quantity' required=''></td><td><input type='number' class='form-control unit_price' name='unit_price[]' id='unit_price2' placeholder='Unit price' required=''></td><td><input type='number' class='form-control total' readonly=' name='total[]' id='total2' placeholder='Total' required=''></td></tr>";
        $('tbody').append(tr);
    });
$('#remove_last_discription').click(function(event){
    $('tbody tr:last').remove();
    calculateGrossTotal();
});
</script>