 
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="page-header" >            
            <div class="card">
            <div class="card-header">
                    <h4 class="page-title">Dashboard</h4>
            </div>
            </div>
        </div>
        

        <div class="row row-cards">

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="card card-counter bg-gradient-success shadow-primary">
                    <a href="<?php echo site_url('adminDashboard/list_vendor'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $vendor_count;  ?></h3>
                                    
                                        <p class="text-white mt-1">Total Vendors</p>
                                    
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-user mt-3 mb-0"></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>    

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="card card-counter bg-gradient-primary shadow-primary">
                    <a href="<?php echo site_url('porders'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $po_count;  ?></h3>
                                    
                                        <p class="text-white mt-1">Total PO</p>
                                    
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-bar-chart mt-3 mb-0"></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="card card-counter bg-gradient-secondary shadow-primary">
                    <a href="<?php echo site_url('myoutlets'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $outlet_count;  ?></h3>
                                    
                                        <p class="text-white mt-1">Total Outlets</p>
                                       
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-file mt-3 mb-0"></i>
                            </div>
                        </div>
                    </div>
                    </a> 
                </div>
            </div>
            
                    
        </div>

      

        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title ">PO Orders</h3>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">PO No.</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Party Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">PO Status </th>
                                    <th scope="col">Work Status </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php //echo "<pre>"; print_r($porderData);exit; ?>
                            <?php foreach($porderData as $kdata){ ?>
                                <tr>
                                    <th scope="row"><?php echo $kdata->order_id ?></th>
                                    <td><?php echo $kdata->companyname ?></td>
                                    <td><?php echo $kdata->vendorname ?></td>
                                    <td><?php echo $kdata->amount ?></td>
                                    <td>
                                        <?php 
                                            if($kdata->order_priority == 'medium')
                                            {
                                                echo '<span class="tag tag-orange">'.$kdata->order_priority.'</span>';
                                            }    
                                            else if($kdata->order_priority == 'high')
                                            {
                                                echo '<span class="tag tag-red">'.$kdata->order_priority.'</span>';
                                            }
                                            else if($kdata->order_priority == 'low')
                                            {
                                                echo '<span class="tag tag-yellow">'.$kdata->order_priority.'</span>';
                                            }    
                                        ?>                                            
                                    </td>

                                    <td><?php echo $kdata->order_date ?></td>

                                    <td>
                                        <?php
                                            if($kdata->order_status == 'approved')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-success w-100"></div>
                                                </div>
                                                <?php
                                            }
                                            else if($kdata->order_status == 'inprocess')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-secondary w-60"></div>
                                                </div>
                                                <?php
                                            }
                                            else if($kdata->order_status == 'cancel')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-primary w-1"></div>
                                                </div>
                                                <?php
                                            }
                                            else if($kdata->order_status == 'pending')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-danger w-30"></div>
                                                </div>
                                                <?php
                                            }
                                        ?>                                        
                                    </td>

                                    <td>
                                        <?php
                                            if($kdata->task_status == 'completed')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-success w-100" title='Completed'></div>
                                                </div>
                                                <?php
                                            }
                                            else if($kdata->task_status == 'inprocess')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-secondary w-60" title="In Process"></div>
                                                </div>
                                                <?php
                                            }
                                            else if($kdata->task_status == 'cancelled')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-primary w-1" title="Cancelled"></div>
                                                </div>
                                                <?php
                                            }
                                            else if($kdata->task_status == 'pending')
                                            {
                                                ?>
                                                <div class="progress progress-md mt-1 h-2">
                                                    <div class="progress-bar  progress-bar-animated bg-danger w-30" task_status="Pending"></div>
                                                </div>
                                                <?php
                                            }
                                        ?>                                        
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
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

