<?php
    // print_r(count($order_history));
    // print_r($order_history);
    // die;
?>
<div class="app-content bg-img my-3 my-md-5"> 
    <div class="side-app"> 

        <div class="row">
            <div class="col-md-12 col-lg-12">
                 <?php $this->load->view('admin/_topmessage'); ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Order History</div>   
                    </div>                           
                    <div class="card-body">      
                        <a href="<?php echo site_url('porders'); ?>" class="btn btn-success btn-sm pull-right"> << Back </a>
                        <br/>
                        <br/>
                        <!-- <h2>Order </h2>                  -->
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover card-table table-striped table-vcenter table-outline table-responsive">
                                <tr>
                                    <!-- <th>Order No.</th> -->
                                    <th>Changed By</th>
                                    <th>Usertype</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Datetime</th>
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
                                                    <?php
                                                        if($order_history[$i]['usertype'] == 'area_manager')
                                                        {
                                                            echo "Area Manager"; 
                                                            
                                                        }
                                                        if($order_history[$i]['usertype'] == 'accountant')
                                                        {
                                                            echo "Accountant"; 
                                                            
                                                        } 
                                                        if($order_history[$i]['usertype'] == 'operational_general_manager')
                                                        {
                                                            echo "Operational General Manager"; 
                                                            
                                                        }
                                                        if($order_history[$i]['usertype'] == 'project_general_manager')
                                                        {
                                                            echo "Project General Manager"; 
                                                            
                                                        }
                                                        if($order_history[$i]['usertype'] == 'admin')
                                                        {
                                                            echo "Admin"; 
                                                            
                                                        }
                                                    ?>    
                                                </td>
                                                <td>
                                                    <?php echo $order_history[$i]['order_status'] ; ?>    
                                                </td>
                                                <td>
                                                    <?php echo $order_history[$i]['order_comment'] ; ?>    
                                                </td>
                                                <td>
                                                    <?php echo $order_history[$i]['Changed_date'] ; ?>    
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
         </div>
<!--footer-->
<?php $this->load->view('admin/footer'); ?>
<!-- End Footer-->
</div>
