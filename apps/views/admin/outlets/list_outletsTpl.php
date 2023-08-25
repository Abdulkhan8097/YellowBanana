<?php //echo print_r($outletData);
//exit; ?>
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">  

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Outlets</div>
                        <?php 
                        $sessionData = $this->session->userdata('adminSession');
                        $userType =  $sessionData['usertype']; 
                        if($userType=='admin'){?>
                            <div class="card-options"><a href="<?php echo site_url('admin_outlet_new'); ?>" class="btn btn-success btn-sm  float-right"> <i class="fa fa-plus"></i>  Add New Outlet</a></div>
                        <?php } ?>
                    </div>
                    <?php $this->load->view('admin/_topmessage'); ?>
                    <div class="card-body">  

                        <form action="" method="get" class="form-inline">
                            <div class="form-group">
                                <p><b>Search By Brand / Location / Address / Manager :&nbsp; </b></p>
                                <input type="text" class="form-control input-sm" name="search" placeholder="Search" value="<?php echo !empty($search)?$search:''?>" />
                            </div>
                            <button type="submit" class="btn btn-success btn-sm" style="margin-left:10px">Search</button>
                            <a href="<?php echo site_url('admin_outlets'); ?>" class="btn btn-primary btn-sm" style="margin-left:10px">Refresh</a>
                        </form>
                        <br/>
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered w-100" >
                                <thead class="bg-info">
                                    <tr>
                                        <th class="wd-3p">S. No.</th>
                                        <th class="wd-15p">Logo</th>
                                        <th class="wd-15p">Brand Name</th>
                                        <th class="wd-15p">Location</th>
                                        <th class="wd-20p">Address</th>
                                        <th class="wd-10p">Manager</th>
                                        <th class="wd-15p">Start date</th>
                                        <?php if($userType=='admin'){?>
                                            <th class="wd-10p">Status</th>
                                            <th class="wd-10p" width="20%">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //echo "<pre>"; print_r($outletData);exit; ?>
                                    <?php if ($pagination['getNbResults']) {
                                        $i = $startLimit; ?>
                                        <?php foreach ($outletData as $kData) { ?>
                                            <?php
                                            $image  = $kData->logo_name;

                                            if($image != "" && file_exists(FCPATH.'assets/upload/outlets/'.$image)){
                                                $imagePath 	= base_url()."assets/upload/outlets/".$image;
                                            }else{
                                                $imagePath 	= base_url()."assets/images/outlets.png";
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>

                                                <td><span><img class="bradius mr-2 avatar" style="background:none !important;"  src="<?php echo $imagePath; ?>" alt=""></span></td>

                                                <td><?php echo $kData->name; ?></td>

                                                <td><?php echo $kData->loc_name; ?></td>

                                                <td><?php echo $kData->address; ?></td>

                                                <td><?php echo $kData->fname; ?></td>
                                                <td><?php echo displayDateTime($kData->created_date); ?></td>

                                                <?php if($userType=='admin'){?>
                                                    <td>
                                                        <?php 
                                                        if($kData->company_status==1)
                                                        { 
                                                            ?>
                                                            <a style="color:#fff" class="btn btn-success btn-sm status_btn" id="<?php echo  $kData->company_id ; ?>" data-status="0">Active</a><!-- <span class="tag tag-lime">Active</span> -->
                                                            <?php 
                                                        }
                                                        else
                                                        { 
                                                            ?>
                                                            <a style="color:#fff" class="btn btn-danger btn-sm status_btn" id="<?php echo  $kData->company_id ; ?>" data-status="1">Inactive</a><!-- <span class="tag tag-red">Inactive</span> -->
                                                        <?php }?>
                                                    </td>
                                                <td>
                                                    <a href="<?php echo site_url('admin_outlet_view?id='.$kData->company_id); ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="<?php echo site_url('admin_outlet_edit?id='. $kData->company_id); ?>" class="btn btn-secondary btn-sm">Edit</a>
                                                    <!-- <a href="<?php echo site_url('admin_outlet_delete?id='. $kData->company_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"> Delete</a> -->
                                                </td>
                                                <?php }?>
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

        <?php if ($pagination['haveToPaginate']) { ?>

            <?php $this->load->view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'admin_outlets', 'varExtra' => $filtres)); ?>

        <?php } ?>
    </div>
    <!--footer-->
    <?php $this->load->view('admin/footer'); ?>
    <!-- End Footer-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
  $('.status_btn').click(function(){
   var id = $(this).attr('id');
   var status = $(this).attr('data-status');
         // alert(id+status);
         $.ajax({
            type:'post',
            data:{'outlet_id':id,'status':status},
            url :"<?php echo site_url('adminOutlets/changeOutletStatus');?>",
            success:function(res)
            {
               // console.log(res);
               if(res == '1')
               {
                  location.reload();
              }
              else
              {
                  alert('Something went wrong. Try again later');
              }
          }
      })
     });
});
</script>