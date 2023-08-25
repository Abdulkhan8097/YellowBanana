 <div class="app-content bg-img my-3 my-md-5"> 
    <div class="side-app"> 
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Outlet</div>
                    </div>
                    <div class="card-body col-lg-10">
                        <!-- <div class="col-lg-8"> -->
                            <form class="card" id='add_member_form' method='post' action="<?php echo site_url('adminOutlets/update_outlet'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Brand Name</label>
                                                <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo $editOutlets[0]->brand_name ?>" placeholder="Brand Name" >
                                            </div>
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $editOutlets[0]->company_id ?>">

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $editOutlets[0]->address ?>" placeholder="Address">
                                            </div>
                                        </div>

                                        <?php 
                                            $adminSession = $this->session->userdata('adminSession');
                                            $userType =  $this->adminSession['usertype'];
                                            $userid =  $this->adminSession['user_id'];
                                            if($userType == 'admin')
                                            {
                                                ?>                                       
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Area Manager</label>
                                                        <select class="form-control select2-show-search" data-placeholder="Select Manager" name='manager' id='manager'>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                                for($i=0;$i<count($areaManager);$i++)
                                                                {
                                                                    $selected = $areaManager[$i]['id'] == $editOutlets[0]->manager_id ? 'selected' : '';
                                                                    
                                                                    echo "<option value='".$areaManager[$i]['id']."' ".$selected.">".$areaManager[$i]['fname']."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php 
                                            }
                                            else  
                                            {
                                                ?>
                                                <input type="hidden" name="manager" value="<?php echo $userid; ?>">
                                                <?php 
                                            }   
                                            ?>


                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Location</label>
                                                <select class="form-control select2-show-search" data-placeholder="Select Location" name='location' id='location'>
                                                    <option value="">--Select--</option>
                                                <?php
                                                for($i=0;$i<count($location);$i++)
                                                    {
                                                    $selected = $location[$i]['loc_id'] == $editOutlets[0]->location_id ? 'selected' : '';
                                                        echo "<option value='".$location[$i]['loc_id']."' ".$selected.">".$location[$i]['loc_name']."</option>";
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">State</label>
                                                <select class="form-control select2-show-search" data-placeholder="Select State" id='state' name='state'>
                                                    <option value="">--Select--</option>
                                                <?php
                                                    for($i=0;$i<count($state);$i++)
                                                    {
                                                    $selected = $state[$i]['id'] == $editOutlets[0]->company_state_id ? 'selected' : '';
                                                        echo "<option value='".$state[$i]['id']."' ".$selected.">".$state[$i]['name']."</option>";
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="City" id="city" value="<?php echo $editOutlets[0]->city_name ?>" name="city" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control"  name="postal_code" id="postal_code" value="<?php echo $editOutlets[0]->pincode ?>" placeholder="ZIP Code" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control select2-show-search"  id='status' name='status'>
                                                    <!-- <option value=""></option> -->

                                                    <option value="1" <?php echo $editOutlets[0]->status=='1' ? "selected" : "" ;?>>Active</option>
                                                    <option value="0" <?php echo $editOutlets[0]->status=='0' ? "selected" : "" ;?>>Inactive</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label">Photograph(Optional)</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="photograph" onchange="readURL(this);">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div>
                                    
                                                <?php
                                                if($editOutlets[0]->logo_name !='')
                                                {
                                                   ?>
                                                   <img  id='preview' alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="<?php echo base_url();?>/assets/upload/outlets/<?php echo $editOutlets[0]->logo_name;?>"/>
                                                   
                                                </a>
                                                   <?php
                                                }
                                                else
                                                {
                                                   ?>
                                                   <img id='preview' src="<?php echo base_url();?>/assets/images/default.png" alt="user-img" class="avatar avatar-xl brround mCS_img_loaded">
                                                   <?php
                                                }
                                             ?>

                                            </div>
                                        </div>

                                        

                                  </div>
                               </div>
                               <div class="card-footer text-right">
                                  <button type="submit" class="btn btn-success pull-left">Submit</button>
                                  <button type="button" id='cancel' class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button>
                               </div>
                            </form>
                         <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/footer'); ?>
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      // alert('df');
      $('#add_member_form').validate({
         rules: {
            brand_name:{
               required:true
            },
            address:{
               required:true
            },
            manager:{
               required:true
            },
            location:{
               required:true
            },
            state:{
               required:true
            },
            city:{
               required:true
            },
            postal_code:{
               required:true
            }
         },
         messages:{
            brand_name:{
               required:"Please enter brand name"
            },
            address:{
               required:"Please enter Address"
            },
            manager:{
               required:"Please Select Area Manager"
            },
            manager:{
               required:"Please Select Location"
            },
            state:{
               required:"Please Select State"
            },
            city:{
               required:"Please Enter City"
            },
            postal_code:{
               required:"Please Enter Postal Code"
            }
         }
      });

      //cancel btn
      $('#cancel').click(function(){
            window.location.href = "<?php echo site_url('admin_outlets'); ?>";
      })
    });
</script>