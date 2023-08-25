
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


            <!-- <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3 ">
                <div class="card card-img-holder">
                    <div class="card-body">
                        <p class="card-text text-muted font-weight-semibold mb-1">Total PO</p>
                        <div class="clearfix">
                            <div class="float-left  mt-2">
                                <a href="<?php echo site_url('porders'); ?>">
                                    <h1><?php echo $po_count;  ?></h1>
                                </a>    
                            </div>
                            <div class="float-right text-right">
                                <span class="pie" data-peity='{ "fill": ["#ff685c", "#f2f2f2"]}'>226,226</span>
                            </div>
                        </div>
                        <div class="progress progress-md mt-1 h-2">
                            <div class="progress-bar  bg-gradient-primary w-70"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
                <div class="card card-counter bg-gradient-success shadow-success">
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
                                <i class="fa fa-file mt-3 mb-0"></i>
                            </div>
                        </div>
                    </div>
                    </a>    
                </div>
            </div>
            
            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
                <div class="card card-counter bg-gradient-primary shadow-primary">
                    <a href="<?php echo site_url('adminOutlets/index'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <!-- <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $area_manager;  ?></h3>
                                    <a href="<?php echo site_url('adminDashboard/list_areaManager'); ?>">
                                        <p class="text-white mt-1">Area Managers</p>
                                    </a>    
                                </div> -->
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $outlet_count;  ?></h3>
                                    
                                        <p class="text-white mt-1">Total outlets</p>
                                    
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-users mt-3 mb-0"></i>
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Party Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">WorkLoad </th>
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
                                        <!-- <td><?php //echo $kdata->order_priority ?></td> -->
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
                                                    <div class="progress-bar  progress-bar-animated bg-warning w-30"></div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </td>
                                    <!-- <td>
                                        <div class="progress progress-md mt-1 h-2">
                                            <div class="progress-bar  progress-bar-animated bg-primary w-60"></div>
                                        </div>
                                    </td> -->
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

