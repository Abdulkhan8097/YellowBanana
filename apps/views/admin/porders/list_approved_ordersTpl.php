<div class="app-content bg-img my-3 my-md-5"> 
    <div class="side-app"> 

        <div class="row">
            <div class="col-md-12 col-lg-12">
                 <?php $this->load->view('admin/_topmessage'); ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">PO Orders</div>                        
                    </div>                     
                    <div class="card-body">     
                        <form action="" method="get" class="form-inline">
                            <div class="form-group">
                                <p><b>Search By Brand / Party Name  :&nbsp; </b></p>
                                <input type="text" class="form-control input-md" name="search" value="<?php echo !empty($search)?$search:''?>" />
                            </div>

                            <button type="submit" class="btn btn-success btn-sm" style="margin-left:10px">Search</button>
                            <a href="<?php echo site_url('adminPorders/list_approved_po'); ?>" class="btn btn-primary btn-sm" style="margin-left:10px">Refresh</a>
                        </form>
                        <br/>

<?php //print_r($outletData)[0];// die;?>
                        <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-hover card-table table-striped table-vcenter table-outline table-responsive">
                                <thead class="bg-info">
                                    <tr>
                                        <th class="wd-2p">Sr. No.</th>                             
                                        <th class="wd-2p">PO No.</th>                             
                                        <th class="wd-15p">Brand Name</th>
                                        <th class="wd-15p">Party Name</th>
                                        <th class="wd-20p">Amount</th>
                                        <th class="wd-8p">Priority</th>
                                        <th class="wd-10p">Status</th>
                                        <th class="wd-10p">Admin Comment</th>
                                        <th class="wd-15p">Accountant Comment</th>
                                        <th class="wd-15p">Approved Date</th>
                                        <th class="wd-28p" width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($pagination['getNbResults']) {
                                        $i = $startLimit; ?>
                                        <?php foreach ($outletData as $kData) { 
                                            // echo "<pre>";
                                            // print_r($kData);
                                                ?>
                                    
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $kData->order_id; ?></td>
                                                <td><?php echo $kData->companyname; ?></td>
                                                <td><?php echo $kData->vendorname; ?></td>
                                                <td><?php echo $kData->amount; ?></td>
                                                <td><?php echo $kData->order_priority; ?></td>
                                                <td><?php echo $kData->order_status; ?></td>
                                                <td><?php echo $kData->director_comment; ?></td>
                                                <td><?php echo $kData->accountant_comment; ?></td>
                                                <!-- <td><?php //echo displayDateTime($kData->order_date); ?></td> -->
                                                <td><?php echo displayDateTime($kData->director_status_date); ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('porderview?id='. $kData->order_id); ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="<?php echo site_url('adminPorders/pdf?id='. $kData->order_id); ?>" class="tag tag-orange">View pdf</a>

                                                    <?php
                                                        // if($kData->accountant_status != "approved")
                                                        // {
                                                            
                                                            if($kData->amount == $kData->paid_amount)
                                                            {         
                                                                ?>
                                                                <span class="btn btn-success btn-sm">Payment Completed</span>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <a href="<?php echo site_url('adminPorders/makePaymentview/'.$kData->order_id); ?>" class="btn btn-success btn-sm">Make Payment</a>
                                                                <?php
                                                            }
                                                            ?>
                                                        <?php
                                                        // }
                                                    ?>

                                                    <?php
                                                        if($kData->accountant_id != "")
                                                        {
                                                            ?>
                                                            <a href="<?php echo site_url('adminPorders/pamentHistory/'.$kData->order_id); ?>" class="btn btn-primary btn-sm">Payment History</a>                                                            
                                                            <?php
                                                        }
                                                    ?>

                                                </td>                                                     
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <!-- table-wrapper -->
                </div>
                <!-- section-wrapper -->

            </div>
         </div>

        <?php if ($pagination['haveToPaginate']) 
            { ?>
                <?php $this->load->view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'adminPorders/list_approved_po', 'varExtra' => $filtres)); ?>

            <?php } ?>
         </div>
                            <!--footer-->
<?php $this->load->view('admin/footer'); ?>
    <!-- End Footer-->
</div>
