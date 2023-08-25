 <div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add New Outlet</div>
                    </div>

                    <div class="card-body col-lg-10">
                        <!-- <div class="col-lg-8"> -->
                            <form class="card" id='add_member_form' method='post' action="<?php echo site_url('adminOutlets/save_outlet'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Brand Name</label>
                                                <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Brand Name" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                                                <!-- <input type="text" class="form-control" name="address" id="address" placeholder="Address"> -->
                                            </div>
                                        </div>

                                        <?php 
                                            $adminSession = $this->session->userdata('adminSession');
                                            // print_r($adminSession);
                                            if($adminSession['usertype'] == 'area_manager')
                                            {
                                                ?>
                                                <input type="hidden" name="manager" value="<?php echo $adminSession['user_id']; ?>">
                                                <?php
                                            }
                                            else
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
                                                                    echo "<option value='".$areaManager[$i]['id']."'>".$areaManager[$i]['fname']."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
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
                                                            echo "<option value='".$location[$i]['loc_id']."'>".$location[$i]['loc_name']."</option>";
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
                                                            echo "<option value='".$state[$i]['id']."'>".$state[$i]['name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="City"  name="city" id="city" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control"  name="postal_code" id="postal_code" placeholder="ZIP Code" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control select2-show-search"  id='status' name='status'>
                                                    <!-- <option value=""></option> -->
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                    
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
                                                <img id='preview' src="<?php echo base_url();?>/assets/images/default.png" alt="user-img" class="avatar avatar-xl brround mCS_img_loaded">
                                                <!-- <a href="editprofile.html" class="profile-img">
                                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                                </a> -->
                                            </div>
                                        </div>

                                        

                                  </div>
                               </div>
                               <div class="card-footer text-right">
                                  <input type = 'hidden' name='usertype' value='general_manager'>
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

      $('#cancel').click(function(){
            window.location.href = "<?php echo site_url('admin_outlets'); ?>";
      })
    });
</script>