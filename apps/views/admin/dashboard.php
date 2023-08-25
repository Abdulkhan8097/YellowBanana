
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

            <!-- <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="card card-counter bg-gradient-secondary shadow-secondary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $general_manager;  ?></h3>
                                    <a href="<?php echo site_url('adminDashboard/list_generalManager'); ?>">
                                        <p class="text-white mt-1">General<br/> Managers</p>
                                    </a>    
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-user mt-3 mb-0"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="card card-counter bg-gradient-secondary shadow-secondary">
                    <a href="<?php echo site_url('adminDashboard/list_operationalgeneralManager'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $operational_general_manager;  ?></h3>
                                    
                                        <p class="text-white mt-1">Operational<br/> General Managers</p>
                                      
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
                <div class="card card-counter bg-gradient-secondary shadow-secondary">.
                    <a href="<?php echo site_url('adminDashboard/list_projectgeneralManager'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $project_general_manager;  ?></h3>
                                    
                                        <p class="text-white mt-1">Project General<br/> Managers</p>
                                    
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
                    <a href="<?php echo site_url('adminDashboard/list_areaManager'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $area_manager;  ?></h3>
                                    
                                        <p class="text-white mt-1">Area<br/> Managers</p>
                                    
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

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="card card-counter bg-gradient-warning shadow-warning">
                    <a href="<?php echo site_url('adminDashboard/list_Accountant'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $accountant;  ?></h3>
                                    
                                        <p class="text-white mt-1">Accountants</p><br/>
                                      
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
                <div class="card card-counter bg-gradient-success shadow-success">
                    <a href="<?php echo site_url('admin_outlets'); ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-4 mb-0 text-white">
                                    <h3 class="mb-0"><?php echo $outlet_count;  ?></h3>
                                    
                                        <p class="text-white mt-1">Outlets</p><br/>
                                        
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

            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3 ">
                <div class="card card-img-holder">
                    <a href="<?php echo site_url('porders'); ?>">
                    <div class="card-body">
                        <p class="card-text text-muted font-weight-semibold mb-1">Total PO</p>
                        <div class="clearfix">
                            <div class="float-left  mt-2">
                                
                                    <h1><?php echo $po_count;  ?></h1>
                                
                            </div>
                            <div class="float-right text-right">
                                <span class="pie" data-peity='{ "fill": ["#ff685c", "#f2f2f2"]}'>226,134</span>
                            </div>
                        </div>
                        <div class="progress progress-md mt-1 h-2">
                            <div class="progress-bar  bg-gradient-primary w-70"></div>
                        </div>
                    </div>
                    </a>    
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
                <div class="card card-img-holder">
                    <a href="<?php echo site_url('adminDashboard/list_vendor'); ?>">
                    <div class="card-body">
                        <p class="card-text text-muted font-weight-semibold mb-1">Total Vendors</p>
                        <div class="clearfix">
                            <div class="float-left  mt-2">
                                
                                    <h1><?php echo $vendor_count ; ?></h1>
                                
                            </div>
                            <div class="float-right text-right">
                                <span class="pie" data-peity='{ "fill": ["#fdb901", "#f2f2f2"]}'>0.52,1.041</span>
                            </div>
                        </div>
                        <div class="progress progress-md mt-1 h-2">
                            <div class="progress-bar  progress-bar-animated bg-warning w-55"></div>
                        </div>
                    </div>
                    </a>    
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
                <div class="card card-img-holder">
                    <div class="card-body">
                        <p class="card-text text-muted font-weight-semibold mb-1">Total PO Amount</p>
                        <div class="clearfix">
                            <div class="float-left  mt-2">
                                <h1><?php echo "&#x20b9; ".number_format($total_po_amt);  ?></h1>
                            </div>
                            <div class="float-right text-right">
                                <!-- <span class="pie" data-peity='{ "fill": ["#32cafe", "#f2f2f2"]}'>1,4</span> -->
                            </div>
                        </div>
                        <div class="progress progress-md mt-1 h-2">
                            <div class="progress-bar  bg-gradient-secondary w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-3">
                <div class="card card-img-holder">
                    <div class="card-body">
                        <p class="card-text text-muted font-weight-semibold mb-1">Paid Amount</p>
                        <div class="clearfix">
                            <div class="float-left  mt-2">
                                <h1><?php echo "&#x20b9; ".number_format($total_paid_amt);  ?></h1>
                            </div>
                            <div class="float-right text-right">
                                <!-- <span class="pie" data-peity='{ "fill": ["#5ed84f", "#f2f2f2"]}'>0.52/1.561</span> -->
                            </div>
                        </div>
                        <div class="progress progress-md mt-1 h-2">
                            <div class="progress-bar  bg-gradient-success w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title ">PO Orders</h3>

                    </div>

                    <?php 
                        // print_r($this->session->userdata('adminSession') );
                    ?>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-hover card-table table-striped table-vcenter table-outline table-responsive">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">ID</th> -->
                                    <th scope="col">PO No.</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Party Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">PO Status </th>
                                    <th scope="col">Task Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php //echo "<pre>"; print_r($porderData)[0];echo "</pre>"; ?>
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

