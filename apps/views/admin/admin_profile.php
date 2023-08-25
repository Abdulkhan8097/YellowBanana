<style>
label.error{
   color:red;
}
</style>
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update Profile</div>
                    </div>

                    <div class="card-body col-lg-10">
                        <!-- <div class="col-lg-8"> -->
                            <form class="card" id='add_member_form' method='post' action="<?php echo site_url('adminprofile/update_profile'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $profile_data['fname']; ?>" placeholder="First Name" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $profile_data['lname']; ?>" placeholder="Last Name">
                                            </div>
                                        </div>                                                                             

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile</label>
                                                <input type="number" class="form-control"  name="mobile" value="<?php echo $profile_data['mobile']; ?>" placeholder="Mobile">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Location</label>
                                                <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" name='location' id='location'>
                                                    <option value="">--Select--</option>
                                                    <?php
                                                        for($i=0;$i<count($location);$i++)
                                                        {
                                                            $selected = $location[$i]['loc_id']==$profile_data['region_id'] ? 'selected' : '';
                                                            echo "<option value='".$location[$i]['loc_id']."' ".$selected." >".$location[$i]['loc_name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">State</label>
                                                <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" id='state' name='state'>
                                                   <option value="">--Select--</option>
                                                   <?php
                                                      for($i=0;$i<count($state);$i++)
                                                      {
                                                         $selected = $state[$i]['id']==$profile_data['state_id'] ? 'selected' : '';
                                                         echo "<option value='".$state[$i]['id']."' ".$selected." >".$state[$i]['name']."</option>";
                                                      }
                                                   ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="City"  value="<?php echo $profile_data['city'] ?>" name="city" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" value="<?php echo $profile_data['zipcode']; ?>"  name="postal_code" placeholder="ZIP Code" >
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
                                                if($profile_data['profile_picture'] !='')
                                                {
                                                   ?>
                                                   <img  id='preview' alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="<?php echo base_url();?>/assets/upload/users/<?php echo $profile_data['profile_picture'] ;?>"/>
                                                   <a href="<?php echo site_url('adminDashboard/remove_profile_image/'.$profile_data['id'])?>" class="profile-img" style='margin-right: 50%'>
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </a>
                                                   <?php
                                                }
                                                else
                                                {
                                                   ?>
                                                   <img  id='preview' alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="<?php echo base_url();?>/assets/images/default.png"/>
                                                   <?php
                                                }
                                             ?>                                               

                                            </div>
                                        </div>

                                  </div>
                               </div>
                               <div class="card-footer text-right">                                 
                                  <button type="submit" class="btn btn-success pull-left">Submit</button>
                                  <button type="button" class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button>
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
            first_name:{
               required:true
            },
            last_name : {
               required : true
            },            
            mobile : {
               required: true,
               minlength:10,
               maxlength:10
            },
            location:{
                required : true
            }
         },
         messages:{
            first_name:{
               required:"Please enter first name"
            },
            last_name : {
               required : "Please enter last name"
            },           
            mobile : {
               required:  "Please enter mobile number",
               minlength: "Please enter valid mobile number",
               maxlength:"Please enter valid mobile number"
            },
            location:{
               required:"Please select location"
            }
         }
      });
    });
</script>