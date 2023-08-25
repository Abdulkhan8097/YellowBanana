
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add New PO</div>
                    </div>

                    <div class="card-body col-md-10">
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
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tax Slab</label>
                                                <select class="form-control select2-show-search" data-placeholder="Select Tax Slab" name='taxslab' id='taxslab'>
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
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"  aria-hidden="true">
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
                </form>
            </div>
            <div class="modal-footer">
                <input type='hidden' name='parent_id' id='parent_id' value="<?php echo $parent_id ;  ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id='add_vendor'>Add</button>
            </div>
        </div>
    </div>
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

        var base_url = "<?php echo site_url(); ?>";



        //add_new_vendor
        $('#add_vendor').click(function(){

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
                    data:{'parent_id':parent_id,'vendor_name':vendor_name,'mobile':mobile,'pan':pan,'gst':gst,'address':address},
                    url : base_url+'/adminDashboard/add_vendor_dynamic',
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

        // alert('df');
        $('#add_po_form').validate({
         rules: {
            outlet:{
                required:true
            },
            party_name:{
               required:true
            },
            task:{
                required: true
            },
            amount : {
                required: true
            },
            taxslab:{
                required:true
            },
            priority:{
                required: true
            }
         },
         messages:{
            outlet:{
                required:"Please select outlet"
            },
            party_name:{
               required:"Please select Party name"
            },
            task:{
                required: "Please enter your task"
            },
            amount : {
                required: "Please enter amount"
            },
            taxslab:{
                required:"Please select tax slab"
            },
            priority:{
                required: "Please select priority"
            }

         }
        });


        //cancel
        $('#cancel').click(function(){
                window.location.href = "<?php echo site_url('porders'); ?>";
        });

    });
</script>