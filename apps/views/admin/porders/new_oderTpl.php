
<div class="app-content bg-img my-3 my-md-5">
	<div class="side-app">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Add New PO</div>
					</div>

					<div class="card-body col-md-12">
						<!-- <div class="col-lg-8"> -->
							<form class="card" id='add_po_form' method='post' action="<?php echo site_url('adminPorders/save_poorder'); ?>" enctype='multipart/form-data'>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 col-md-12">

											<div class="form-group">
												<label class="form-label">Select Outlet</label>
												<select class="form-control select2-show-search" data-placeholder="Select Outlet" name='outlet' id='outlet' required>
													<option value="">--Select--</option>
													<?php
													foreach($outlets as $outletDetails)
													{ 
														echo "<option value='".$outletDetails['id']."'>".$outletDetails['name']."</option>";
													}
													?>
												</select>

											</div>
										</div>
										<div class="col-sm-12 col-md-12">
											<div class="form-group">
												<label class="form-label">Party Name</label>
												<div class="row">
													<div class="col-md-9">
														<select class="form-control select2-show-search" data-placeholder="Select Vendor" name='party_name' id='outlet' required>
															<option value="">--Select--</option>
															<?php
															foreach($party as $vendor)
															{ 
																echo "<option value='".$vendor['vendor_id']."'>".$vendor['vendor_name']."</option>";
															}
															?>
														</select>
													</div>
													<div class="col-md-1"></div>
													<div class="col-md-2">
														<button type="button" class="btn btn-primary add_new_vendor pull-right" data-toggle="modal" data-target="#exampleModal3"  id='add_new_vendor'>Add New Vendor</button>

														<!-- <input type = 'button' class="btn btn-md btn-primary add_new_vendor pull-right" id='add_new_vendor' value='Add New Vendor' > -->
													</div>
												</div>
											</div>
										</div>

										<div class="col-sm-12 col-md-12">
											<div class="form-group">
												<label class="form-label">Task</label>
												<textarea class="form-control" name="task" id="tasklist"></textarea>
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
													<tr id='1'>
														<td>1</td>
														<td><textarea class="form-control" name="description[]" id="description1"></textarea></td>
														<td><input type="number" class="form-control" name="hsn[]" id="hsn1" placeholder="hsn" required></td>
														<td><input type="number" class="form-control qty" name="qty[]" id="qty1" placeholder="quantity" required></td>
														<td><input type="number" class="form-control unit_price" name="unit_price[]" id="unit_price1" placeholder="Unit price" required></td>
														<td><input type="number" class="form-control total" readonly="" name="total[]" id="total1" placeholder="Total" required></td>
													</tr>
													<!-- <tr id='2'>
														<td>2</td>
														<td><textarea class="form-control" name="description[]" id="description2"></textarea></td>
														<td><input type="number" class="form-control" name="hsn[]" id="hsn2" placeholder="hsn" required></td>
														<td><input type="number" class="form-control qty" name="qty[]" id="qty2" placeholder="quantity" required></td>
														<td><input type="number" class="form-control unit_price" name="unit_price[]" id="unit_price2" placeholder="Unit price" required></td>
														<td><input type="number" class="form-control total" readonly="" name="total[]" id="total2" placeholder="Total" required></td>
													</tr> -->
												</tbody>
											</table>
										</div>
										<div class="col-sm-12 col-md-12">
											<button type="button" style="float: none;" class="btn btn-primary add_new_discription pull-right" id='add_new_discription'>Add</button>
											<button type="button" style="float: none;" class="btn btn-primary remove_last_discription pull-right" id='remove_last_discription'>Cancel</button>
											<div class="form-group">
												<label class="form-label">Gross Total</label>
												<input type="number" class="form-control" readonly="" name="gross_total" id="gross_total" placeholder="Amount" required>
											</div>
										</div>

										<div class="col-sm-6 col-md-6">
											<div class="form-group">
												<label class="form-label">Tax Slab</label>
												<select class="form-control" data-placeholder="Select Tax Slab" name='taxslab' id='taxslabs'>
													<option value="">--Select--</option>
													<?php
													foreach($arrTaxslab as $taxDetail)
													{
														echo "<option value='".$taxDetail['id']."'>".$taxDetail['taxname']."</option>";
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-12 col-md-12">
											<div class="form-group">
												<label class="form-label">Grand Total</label>
												<input type="number" class="form-control" readonly="" name="grand_total" id="grand_total" placeholder="Amount" required>
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
														echo "<option value='".$key."'>".$value."</option>";
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
									<input type = 'hidden' name='usertype' value='general_manager'>
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
	<!-- Message Modal -->
	<form id="saveEmpForm" method="post">
	<div class="modal fade" id="exampleModal3" id="addEmpModal" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="example-Modal3"><b>New Vendor</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id='add_dynamicVendorForm' class="form-control">
											<div class="form-group">
							<label for="recipient-name" class="form-control-label">Vendor Name:</label>
							<input type="text" class="form-control" id="vendor_name" name='fullname'>
						</div>
						<div class="form-group">
							<label class="form-label">Mobile</label>
							<input type="number" class="form-control" id='mobile' name="mobile" placeholder="Mobile">
						</div> 
						<div class="form-group">
							<label class="form-label">PAN No.</label>
							<input type="text" class="form-control" id='pan' name="pan" placeholder="PAN Number" >
						</div> 
						<div class="form-group">
							<label class="form-label">GST No.</label>
							<input type="text" class="form-control" id='gst' name="gst" placeholder="GST Number" >
						</div> 
						<div class="form-group">
							<label class="form-label">Address</label>
							<textarea class="form-control" placeholder="addess" id='address' name='address'></textarea>
						</div>                                
						<span id='er'></span>
						<br/>
					
				</div>
				<div class="modal-footer">
					<input type='hidden' name='parent_id' id='parent_id' value="<?php echo $parent_id ;  ?>">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id='add_vendor'>Add</button>
				</div>
				</form>
			</div>
		</div>
	</div>

<!--  <script type="text/javascript">
    	$('#saveEmpForm').submit('click',function(){
		var vendor_name = $('#vendor_name').val();
		var mobile_no = $('#mobile').val();
		var pan = $('#pan').val();
		var gst_no = $('#gst').val();
		var address = $('#address').val();
		$.ajax({
			type : "POST",
			url  : "emp/save",
			dataType : "JSON",
			data : {vendor_name:vendor_name, mobile:mobile_no, pan:pan, gst:gst_no, address:address},
			success: function(data){
				$('#name').val("");
				$('#skills').val("");
				$('#address').val("");
				$('#addEmpModal').modal('hide');
						}
		});
		return false;
	});
    </script> -->
	<script type="text/javascript">
		function readURL(input) {
			if (input.files && input.files[0]) {
				$('#preview').html(input.files[0].name);
			}
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		;
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
		});



        //add_new_vendor
        $('#add_vendor').click(function()
        {

        	var vendor_name = $('#vendor_name').val();
        	 var parent_id = $('#parent_id').val()
        	var mobile = $('#mobile').val();
        	var pan = $('#pan').val();
        	var gst = $('#gst').val();
        	var address = $('#address').val();

            // alert(vendor_name+parent_id);
            if(vendor_name == "")
            {
            	$('#vendor_name').focus();
            	var ermsg = "Please enter vendor's name";
            	$('#er').addClass('alert alert-danger');
            	$('#er').text(ermsg) ;
            	return false;
            }
            else if(mobile == "")
            {
            	$('#mobile').focus();
            	var ermsg = "Please enter vendor's mobile number";
            	$('#er').addClass('alert alert-danger');
            	$('#er').text(ermsg) ;
            	return false;    
            }
            else
            {
            	$.ajax({
            		type:'post',
            		data:{'parent_id':parent_id ,'vendor_name':vendor_name,'mobile':mobile,'pan':pan,'gst':gst,'address':address},
            		url : 'adminDashboard/add_vendor_dynamic',
            		success:function(res)
            		{
                        // alert(res);
                        console.log(res);
                        if(res == 1)
                        {
                        	alert('New vendor added');
                        	$('#exampleModal3').modal('hide');
                        	location.reload();
                        }
                        else
                        {
                        	$('#exampleModal3').modal('hide');
                        	alert('Something went wrong.Please try again');
                        }
                    }
                })
            }
        });



        $('#cancel').click(function(){
        	window.location.href = "<?php echo site_url('porders'); ?>";
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
        	$("#gross_total").val(gross_total);
        }

        $('#taxslabs').change(function(event) {
        	console.log(event);
        	var gross_total = $("#gross_total").val();
        	var percent =  $("#taxslabs option:selected").text();
        	if (percent!='NIL / EXEMPT') {

        		var percent =  $("#taxslabs option:selected").text().split("%");
        		percent = percent[0];

        		var grand_total =Math.round(parseInt(gross_total)+parseFloat(gross_total*(percent/100)));
        		$('#grand_total').val(grand_total);
        	}else{
        		$('#grand_total').val(gross_total);
        	}
        });

        $('#add_new_discription').click(function(event)
        {
        	
        // var td = parseInt(document.getElementsByTagName('tbody')[0].lastChild.previousSibling.innerText)+1;
        var td = parseInt($('tbody tr:last').text())+1;

        var tr = "<tr><td>"+td+"</td><td><textarea class='form-control' name='description[]'></textarea></td><td><input type='number' class='form-control' name='hsn[]' id='hsn2' placeholder='hsn' required=''></td><td><input type='number' class='form-control qty' name='qty[]' id='qty2' placeholder='quantity' required=''></td><td><input type='number' class='form-control unit_price' name='unit_price[]' id='unit_price2' placeholder='Unit price' required=''></td><td><input type='number' class='form-control total' readonly='' name='total[]' id='total2' placeholder='Total' required=''></td></tr>";
        $('tbody').append(tr);
        if($('tbody tr').length == '1')
		{
			$('#remove_last_discription').hide();
		}
		else 
		{	
			$('#remove_last_discription').show();
		}	
    });
        $('#remove_last_discription').click(function(event){
        	$('tbody tr:last').remove();
        	calculateGrossTotal();
        	if($('tbody tr').length == '1')
    		{
    			$('#remove_last_discription').hide();
    		}
    		else 
    		{
    			$('#remove_last_discription').show();
    		}
        });
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){

    		if($('tbody tr').length == '1')
    		{
    			$('#remove_last_discription').hide();
    		}
    	});
    </script>
   