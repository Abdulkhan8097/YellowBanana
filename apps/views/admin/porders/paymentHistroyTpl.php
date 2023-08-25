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
                        <div class="card-title">Payment History</div>
                    </div>                     
                    <div class="card-body">   
                        <!-- <a href="<?php //echo site_url('adminPorders/list_approved_po'); ?>" class="btn btn-success btn-sm pull-right"> << Back </a>
                        <br/>
                         --><br/>                    
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Pay By</th>
                                <th>Pay To</th>
                                <th>Payment Method</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Transaction Date</th>
                            </tr>
                            <?php
                                if(count($order_history)>0)
                                {
                                    for($i=0;$i<count($order_history);$i++)
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $order_history[$i]['fname']." ".$order_history[$i]['lname']; ?>
                                                    
                                            </td>
                                            <td>
                                                <?php echo $order_history[$i]['vendor_name'] ; ?>    
                                            </td>
                                            <td>
                                                <?php echo $order_history[$i]['payment_method'] ; ?>    
                                            </td>
                                            <td>
                                                <?php echo $order_history[$i]['description'] ; ?>    
                                            </td>
                                            <td>
                                                <?php echo $order_history[$i]['total_amount'] ; ?>    
                                            </td>
                                            <td>
                                                <?php echo $order_history[$i]['transaction_date']; ?>    
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    ?>
                                    <tr>
                                        <td colspan = '6'>Data not found </td>
                                    </tr>
                                    <?php
                                }    
                            ?>
                        </table>        
                    </div>
                </div>
            </div>
         </div>
<!--footer-->
<?php $this->load->view('admin/footer'); ?>
<!-- End Footer-->
</div>
