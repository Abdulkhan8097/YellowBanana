<?php
    // print_r($po_id);
    // die;
?>
<div class="app-content bg-img my-3 my-md-5"> 
    <div class="side-app"> 

        <div class="row">
            <div class="col-md-12 col-lg-12">
                 <?php $this->load->view('admin/_topmessage'); ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Payment</div>
                    </div>                     
                    <div class="card-body">                       
                        <form class="card" id='payment_form' method='post' action="<?php echo site_url('adminPorders/make_payment'); ?>" enctype='multipart/form-data'>            
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-control" name='payment_method'>
                                                <option value=''>Select Payment Method</option>
                                                <option value='cheque'>Cheque</option>
                                                <option value='cash'>Cash</option>
                                                <option value='online'>Online</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name='payment_desc' id='payment_desc'></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Pending Amount</label>
                                            <input type="text" readonly="" class="form-control" id='old_pending_amount' value="<?php echo $pending_amount ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Amount</label>
                                            <input type="number" name="amount" class="form-control" id='amount'>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Pay To</label>
                                            <input type="text" readonly name="vendor_name" class="form-control" value="<?php echo $vendor_name ;  ?>">
                                            <input type="hidden" readonly name="vendor_id" value="<?php echo $vendor_id ; ?>">
                                        </div>
                                    </div>  

                                    <!-- <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control select2-show-search"  id='status' name='accountant_status'>
                                                <option value="pending">Pending</option>
                                                <option value="inprocess">Inprocess</option>         
                                                <option value="cancel">Cancel</option>         
                                                <option value="approved">Approved</option>         
                                            </select>
                                        </div>
                                    </div> --> 

                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control select2-show-search"  id='status' name='accountant_status'>
                                                <option value="pending">Pending</option>
                                                <option value="cancel">Cancelled</option>         
                                                <option value="approved">Completed</option>         
                                                <option value="inprocess">Inprocess</option>         
                                                <!-- <option value="invalid">Invalid</option>           -->
                                            </select>
                                        </div>
                                    </div>  


                                          

                                    
                                </div>
                            </div>   
                            <div class="card-footer text-right">
                                <input type = 'hidden' name='usertype' value='accountant'>                            
                                <input type = 'hidden' name='payby_user_id' value="<?php echo $payby_user_id ;?>">                            
                                <input type = 'hidden' name='paid_amount' value="<?php echo $paid_amount ;?>">                            
                                <input type = 'hidden' name='order_id' value="<?php echo $po_id ;?>">                            
                                <button type="submit" class="btn btn-success pull-left">Submit</button>                                        
                                <a class="btn btn-danger pull-left" href="<?php echo  site_url('adminPorders/list_approved_po'); ?>" style='margin-left:10px;color:#fff;'>Cancel</a>                                        
                            </div>     
                                                                 
                        </form>    
                    </div>
                    <!-- table-wrapper -->
                </div>
                <!-- section-wrapper -->
            </div>
         </div>

<!--footer-->
<?php $this->load->view('admin/footer'); ?>
<!-- End Footer-->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //admin comment modal validation
        $('#payment_form').validate({
            rules: {
                payment_method:{
                    required:true
                },
                amount:{
                    required:true,
                }
            },
            messages:{
                payment_method:{
                    required:"Please select payment method"
                },
                amount:{
                    required:"Please enter amount"
                }
            }
        });

    });
    $('#amount').change(function(event) {
        var old_pending_amount = parseInt($('#old_pending_amount').val());
        var paid_amount = parseInt($('#amount').val());
        if (paid_amount>old_pending_amount) {
            alert('Sorry you cant enter amount more than pending amount');
            $('#amount').val('');
            $('#amount').focus();
        }
    });
</script>
