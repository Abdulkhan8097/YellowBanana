<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Outlets</div>
                        <div class="card-options"><a href="<?php echo site_url('admin_outlet_new'); ?>" class="btn btn-success btn-sm  float-right"> <i class="fa fa-plus"></i>  Add New Outlet</a></div>
                    </div>
                      <?php $this->load->view('admin/_topmessage'); ?>
                    <div class="card-body">                       
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
                                        <th class="wd-10p">Status</th>
                                        <th class="wd-15p">Start date</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
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
                                                <td><?php if($kData->status==1){ ?><span class="tag tag-lime">Active</span>
                                                    <?php }else{ ?>
                                                    <span class="tag tag-red">Inactive</span></td>
                                                <?php } ?>
                                                <td><?php echo displayDateTime($kData->created_date); ?></td>
                                                
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

                        <?php $this->load->view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'admin_outlets', 'varExtra' => $searchArray)); ?>

                        <?php } ?>
         </div>
                            <!--footer-->
<?php $this->load->view('admin/footer'); ?>
    <!-- End Footer-->
</div>

