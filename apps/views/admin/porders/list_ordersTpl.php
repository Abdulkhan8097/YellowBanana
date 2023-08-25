<div class="app-content bg-img my-3 my-md-5"> 
    <div class="side-app"> 

        <div class="row">
            <div class="col-md-12 col-lg-12">
               <?php $this->load->view('admin/_topmessage'); ?>
               <div class="card">
                <div class="card-header">
                    <div class="card-title">PO Orders</div>
                    <?php $adminSession = $this->session->userdata('adminSession'); ?>
                    <?php if ($adminSession['usertype']=='area_manager') {?>
                    <div class="card-options"><a href="<?php echo site_url('pordernew'); ?>" class="btn btn-success btn-sm  float-right"> <i class="fa fa-plus"></i>  Create New PO</a></div>
                <?php } ?>
                </div>                     
                <div class="card-body">    

                    <form action="" method="get" class="form-inline">
                        <div class="form-group">
                            <p><b>Search By Brand / Party Name  :&nbsp; </b></p>
                            <input type="text" class="form-control input-md" name="search" placeholder="Search By Brand/Party Name" value="<?php echo !empty($search)?$search:''?>" />
                        </div>

                        <!-- <div class="form-group">
                            <select class="form-control" name='order_status'>
                                <option value="">Select PO Status</option>
                                <option value="pending">Pending</option>
                                <option value="cancel">Cancelled</option>
                                <option value="approved">Approved</option>
                            </select>
                        </div> -->

                        <button type="submit" class="btn btn-success btn-sm" style="margin-left:10px">Search</button>
                        <a href="<?php echo site_url('porders'); ?>" class="btn btn-primary btn-sm" style="margin-left:10px">Refresh</a>
                    </form>
                    <br/>

                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-hover card-table table-striped table-vcenter table-outline table-responsive">
                            <thead class="bg-info">
                                <tr>
                                    <th class="wd-2p">Sr. No.</th>                             
                                    <th class="wd-15p">PO.No</th>
                                    <th class="wd-15p">Brand Name</th>
                                    <th class="wd-15p">Party Name</th>
                                    <th class="wd-20p">Amount</th>
                                    <th class="wd-8p">Priority</th>
                                    <th class="wd-10p">PO Status</th>
                                    <th class="wd-10p">Task Status</th>
                                    <th class="wd-15p">Created Date</th>
                                    <th class="wd-28p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pagination['getNbResults']) {
                                    $i = $startLimit; ?>
                                    <?php foreach ($outletData as $kData) { ?>
                                    
                                    <tr>
                                        <td><?php echo ++$i; ?></td>                                                
                                        <td><?php echo $kData->order_id; ?></td>
                                        <td><?php echo $kData->companyname; ?></td>
                                        <td><?php echo $kData->vendorname; ?></td>
                                        <td><?php echo $kData->amount; ?></td>

                                        <td>
                                            <?php //echo $kData->order_priority; ?>
                                            <?php 
                                            if($kData->order_priority == 'medium')
                                            {
                                                echo '<span class="tag tag-orange">'.$kData->order_priority.'</span>';
                                            }    
                                            else if($kData->order_priority == 'high')
                                            {
                                                echo '<span class="tag tag-red">'.$kData->order_priority.'</span>';
                                            }
                                            else if($kData->order_priority == 'low')
                                            {
                                                echo '<span class="tag tag-yellow">'.$kData->order_priority.'</span>';
                                            }    
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if($kData->order_status == 'approved')
                                            {
                                                echo '<span class="tag tag-green">'.$kData->order_status.'</span>'; 
                                            }
                                            else if($kData->order_status == 'cancel')
                                            {
                                                echo '<span class="tag tag-red">'.$kData->order_status.'</span>'; 
                                            }
                                            else if($kData->order_status == 'inprocess')
                                            {
                                                echo '<span class="tag tag-yellow">'.$kData->order_status.'</span>'; 
                                            }
                                            else if($kData->order_status == 'pending')
                                            {
                                                echo '<span class="tag tag-orange">'.$kData->order_status.'</span>'; 
                                            }
                                            ?>                                            
                                        </td>

                                        <td>
                                            <?php
                                                if($kData->task_status == 'completed')
                                                {
                                                    ?>
                                                    <div class="progress progress-md mt-1 h-2">
                                                        <div class="progress-bar  progress-bar-animated bg-success w-100" title="Completed"></div>
                                                    </div>
                                                    <?php
                                                }
                                                else if($kData->task_status == 'inprocess')
                                                {
                                                    ?>
                                                    <div class="progress progress-md mt-1 h-2">
                                                        <div class="progress-bar  progress-bar-animated bg-secondary w-60" title="In Process"></div>
                                                    </div>
                                                    <?php
                                                }
                                                else if($kData->task_status == 'cancel')
                                                {
                                                    ?>
                                                    <div class="progress progress-md mt-1 h-2">
                                                        <div class="progress-bar  progress-bar-animated bg-primary w-1" title="Canceled"></div>
                                                    </div>
                                                    <?php
                                                }
                                                else if($kData->task_status == 'pending')
                                                {
                                                    ?>
                                                    <div class="progress progress-md mt-1 h-2">
                                                        <div class="progress-bar  progress-bar-animated bg-danger w-30" title="Pending"></div>
                                                    </div>
                                                    <?php
                                                }
                                            ?>                                        
                                        </td>

                                        <!-- <td><?php //echo $kData->order_date; ?></td> -->
                                        <td><?php echo displayDateTime($kData->order_date); ?></td>
                                        <?php

                                        if($usertype == 'area_manager')
                                        {
                                            ?>
                                            <td>
                                                <a href="<?php echo site_url('adminPorders/pdf?id='. $kData->order_id); ?>" class="tag tag-orange">View pdf</a>
                                                <a href="<?php echo site_url('porderview?id='. $kData->order_id); ?>" class="btn btn-info btn-sm">View</a>
                                                <?php
                                                if($kData->order_status == 'pending')
                                                {
                                                    ?>
                                                    <a href="<?php echo site_url('porderedit?id='. $kData->order_id); ?>" class="btn btn-secondary btn-sm">Edit</a>
                                                    <a href="<?php echo site_url('adminPorders/delete?id='. $kData->order_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"> Delete</a>
                                                    <?php
                                                }
                                                else if($kData->order_status == 'approved')
                                                {
                                                    ?>
                                                    <a href="<?php echo site_url('adminPorders/pamentHistory/'.$kData->order_id); ?>" class="btn btn-success btn-sm">Payment History</a>
                                                    <?php
                                                    if($kData->task_status != 'completed')    
                                                    {
                                                        ?>
                                                        <a class="btn btn-warning btn-sm update_task_status" id="<?php echo $kData->order_id; ?> ">Update Task Status</a>
                                                        <?php
                                                    }
                                                }

                                                if($kData->accountant_status == 'approved')
                                                {
                                                    ?>
                                                    <a href="<?php echo site_url('porderedit?id='. $kData->order_id); ?>" class="btn btn-secondary btn-sm">Mark as complete</a>        
                                                    <?php
                                                }

                                                ?>    
                                            </td>                                                            
                                            <?php
                                        }
                                        // else if($usertype == 'general_manager')
                                        else if($usertype == 'operational_general_manager' || $usertype =='project_general_manager')
                                        {
                                            ?>
                                            <td>
                                                <a href="<?php echo site_url('adminPorders/pdf?id='. $kData->order_id); ?>" class="tag tag-orange">View pdf</a>
                                                <a href="<?php echo site_url('porderview?id='. $kData->order_id); ?>" class="btn btn-info btn-sm">View</a>

                                                <?php
                                                if($kData->order_status == 'pending')
                                                {
                                                    ?>

                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm gm_approve" id="<?php echo $kData->order_id;?>" data-toggle="modal" data-target="#gm_comment_modal" >Approve</a>

                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm gm_cancel" id="<?php echo $kData->order_id;?>" data-toggle="modal" data-target="#gm_comment_modal" >Reject</a>

                                                    <?php
                                                }

                                                if($kData->accountant_status == 'approved')
                                                {
                                                    ?>
                                                    <a href="<?php echo site_url('adminPorders/pamentHistory/'.$kData->order_id); ?>" class="btn btn-success btn-sm">Payment History</a>
                                                    <a href="<?php echo site_url('porderedit?id='. $kData->order_id); ?>" class="btn btn-secondary btn-sm">Mark as complete</a>        
                                                    <?php
                                                }   
                                                ?> 

                                            </td>  

                                            <?php
                                        }
                                        else if($usertype == 'admin')
                                        {
                                            ?>
                                            <td>
                                                <a href="<?php echo site_url('adminPorders/pdf?id='. $kData->order_id); ?>" class="tag tag-orange">View pdf</a>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-md dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action 
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo site_url('porderview?id='. $kData->order_id); ?>" class="btn btn-info btn-sm">View</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo site_url('adminPorders/orderHistory/'.$kData->order_id); ?>" class="btn btn-primary btn-sm">View Order History</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo site_url('adminPorders/pamentHistory/'.$kData->order_id); ?>" class="btn btn-success btn-sm">Payment History</a>
                                                        </li>
                                                        <?php
                                                            if($kData->order_status == 'inprocess')
                                                            {
                                                                ?>
                                                                <li>
                                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm admin_approve" id="<?php echo $kData->order_id;?>" data-toggle="modal" data-target="#admin_comment_modal" >Approve</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm admin_cancel" id="<?php echo $kData->order_id;?>" data-toggle="modal" data-target="#admin_comment_modal" >Reject</a>
                                                                </li>    
                                                                <?php
                                                            }
                                                        ?>
                                                    </ul>
                                                </div>
                                                                                                                                            
                                            </td>  

                                            <?php
                                        }
                                        ?>                                                  
                                    </tr>
                                    <?php }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($pagination['haveToPaginate']) 
            { ?>
                <?php $this->load->view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'porders', 'varExtra' => $filtres)); ?>

            <?php } ?>
        </div>
            <!--footer-->
            <?php $this->load->view('admin/footer'); ?>
            <!-- End Footer-->
        </div>

        <div class="modal fade" id="gm_comment_modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3"><b>General Manager Comment</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="card" id='gm_comment_form' method="post" action ="<?php echo site_url('adminPorders/gm_comment') ; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea class="form-control" name="gm_comment" id='gm_comment'></textarea>
                            </div>                                
                            <span id='er'></span>
                        </div>
                        <div class="modal-footer">

                            <input type="hidden" name='gm_status' id='gm_status_modal' value=''>    
                            <input type="hidden" name='po_id' id='po_id_modal' value=''>    
                            <button type="submit" class="btn btn-success pull-left">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="admin_comment_modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3"><b>Admin Comment</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="card" id='admin_comment_form' method="post" action ="<?php echo site_url('adminPorders/admin_comment') ; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea class="form-control" name="admin_comment" id='admin_comment'></textarea>
                            </div>                                
                        </div>
                        <div class="modal-footer">

                            <input type="hidden" name='admin_status' id='admin_status_modal' value=''>    
                            <input type="hidden" name='o_id' id='o_id_modal' value=''>    
                            <button type="submit" class="btn btn-success pull-left">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="task_status_modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3"><b>Update Task Status</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br/>
                    <div class="alert" role="alert" id='dd'>
                    </div>
                    <form class="card" id='task_status_form' method="post" >
                        <div class="modal-body">
                            <div class="form-group">
                                <label><b>Task Status : </b></label>
                                <select class="form-control" name="form_task_status" id='form_task_status'>
                                    <option value="">Select</option>
                                    <option value="pending">Pending</option>
                                    <option value="inprocess">Inprocess</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>                                
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="task_status_po_id" id='task_status_po_id'>
                            <button type="submit" class="btn btn-success pull-left" id='task_status_form_sbmt'>Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){

            //get PO id and status when approved by GM
            $('.gm_approve').click(function(){
                var po_id = $(this).attr('id');
                var gm_status = 'approved';
                // alert(gm_status+po_id);
                $('#gm_status_modal').val(gm_status);
                $('#po_id_modal').val(po_id);
            });

            //get PO id and status when rejected by GM
            $('.gm_cancel').click(function(){
                var po_id = $(this).attr('id');
                var gm_status = 'cancel';
                // alert(gm_status+po_id);
                $('#gm_status_modal').val(gm_status);
                $('#po_id_modal').val(po_id);
            });

            //get PO id and status when approved by Admin
            $('.admin_approve').click(function(){
                var po_id = $(this).attr('id');
                var admin_status = 'approved';
                // alert(admin_status+po_id);
                $('#admin_status_modal').val(admin_status);
                $('#o_id_modal').val(po_id);
            });

            //get PO id and status when rejected by Admin
            $('.admin_cancel').click(function(){
                var po_id = $(this).attr('id');
                var admin_status = 'cancel';
                // alert(gm_status+po_id);
                $('#admin_status_modal').val(admin_status);
                $('#o_id_modal').val(po_id);
            });


            //GM comment modal validation
            $('#gm_comment_form').validate({
                rules: {
                    gm_comment:{
                        required:true
                    }
                },
                messages:{
                    gm_comment:{
                        required:"Please write your comment"
                    }
                }
            });


            //admin comment modal validation
            $('#admin_comment_form').validate({
                rules: {
                    admin_comment:{
                        required:true
                    }
                },
                messages:{
                    admin_comment:{
                        required:"Please write your comment"
                    }
                }
            });


            //update task status
            $('.update_task_status').click(function(){
                var po_id = $(this).attr('id');
                // alert(po_id);
                $('#task_status_modal').modal('show');
                $('#task_status_po_id').val(po_id);

                $('#task_status_form_sbmt').click(function(){
                    var po_id = $('#task_status_po_id').val();
                    var task_status = $('#form_task_status').val();

                    if(task_status == '')
                    {
                        // alert('Please select task_status');
                        $('#dd').addClass('alert-danger');
                        $('#dd').html('Please select task status');
                        $('#dd').fadeIn('slow').delay(3000).hide(10);
                        return false;
                    }
                    else
                    {
                        $.ajax({
                            type:'post',
                            data:{"po_id":po_id,'task_status':task_status},
                            url :"<?php echo site_url('adminPorders/update_task_status'); ?>",
                            success:function(res)
                            {
                                // alert(res);
                                if(res == '1')
                                {
                                    // alert('Task status updated');
                                    $('#dd').addClass('alert-success');
                                    $('#dd').html('Task status updated');
                                    $('#dd').fadeIn('slow').delay(3000).hide(10);
                                }
                                else
                                {
                                    $('#dd').addClass('alert-danger');
                                    $('#dd').html('Something went wrong. tray again later');
                                    $('#dd').fadeIn('slow').delay(3000).hide(10);
                                    return false;
                                    // alert('Something went wrong. tray again later');
                                }
                            }
                        });
                    }
                });


            });


        });
    </script>
