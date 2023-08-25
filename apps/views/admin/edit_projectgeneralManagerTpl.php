<style>
label.error{
   color:red;
}
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  margin-right: 2%;
}
</style>

<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit General Manager</div>                       
                    </div>
                    
                     <div class="card-body col-lg-10">
                        <?php $this->load->view('admin/_topmessage'); ?>
                        <?php
                          // print_r($userdata[0]['status']);
                          // die;
                           /*if(!empty($this->session->flashdata('message')))
                           {
                              echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$this->session->flashdata('message').'</div>';
                           }*/
                        ?>
                        <!-- <div class="col-lg-8"> -->
                            <form class="card" id='add_member_form' method='post' action="<?php echo site_url('adminDashboard/edit_profile'); ?>" enctype='multipart/form-data'>            
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $userdata[0]['fname'] ?>" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $userdata[0]['lname'] ?>">
                                            </div>
                                        </div>   
                                     
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Email address</label>
                                                <input type="email" class="form-control" name="email"   placeholder="Email" value="<?php echo $userdata[0]['email'] ?>" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <input id='password' type="password" class="form-control"  name="password" placeholder="Password" value="<?php echo $userdata[0]['password'] ?>">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile</label>
                                                <input type="number" class="form-control"  name="mobile" placeholder="Mobile" value="<?php echo $userdata[0]['mobile'] ?>">
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
                                                            $selected = $location[$i]['loc_id']==$userdata[0]['region_id'] ? 'selected' : '';
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
                                                         $selected = $state[$i]['id']==$userdata[0]['state_id'] ? 'selected' : '';
                                                         echo "<option value='".$state[$i]['id']."' ".$selected." >".$state[$i]['name']."</option>";
                                                      }
                                                   ?>
                                                </select>
                                            </div>
                                        </div>
                                     
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="City"  name="city" value="<?php echo $userdata[0]['city'] ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Postal Code</label>
                                                <input type="number" class="form-control"  name="postal_code" placeholder="ZIP Code" value="<?php echo $userdata[0]['zipcode'] ?>">
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
                                                if($userdata[0]['profile_picture'] !='')
                                                {
                                                   ?>
                                                   <img  id='preview' alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="<?php echo base_url();?>/assets/upload/users/<?php echo $userdata[0]['profile_picture'] ;?>"/>
                                                   <a href="<?php echo site_url('adminDashboard/remove_profile_image/'.$userdata[0]['id'])?>" class="profile-img"  style='margin-right: 50%'>
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
                                                <!-- <img id='preview' src="<?php //echo base_url();?>/assets/images/default.png" alt="user-img" class="avatar avatar-xl brround mCS_img_loaded"> -->
                                                
                                            </div>
                                        </div> 

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control select2-show-search"  id='status' name='status'>
                                                    <!-- <option value=""></option> -->

                                                    <option value="1" <?php echo $userdata[0]['status']=='1' ? "selected" : "" ;?>>Active</option>
                                                    <option value="0" <?php echo $userdata[0]['status']=='0' ? "selected" : "" ;?>>Inactive</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                     
                                  </div>
                               </div>

                               <div class="card-footer text-right">
                                 <input type = 'hidden' name='usertype' value='project_general_manager'>
                                 <?php 
                                    $old_profile_img = $userdata[0]['profile_picture'] != "" ? $userdata[0]['profile_picture'] : "";
                                 ?>
                                 <input type = 'hidden' name='old_profile_img' value="<?php echo $old_profile_img ; ?>">
                                 <input type = 'hidden' name='profile_id' value="<?php echo $userdata[0]['id'] ; ?>">
                                 <button type="submit" class="btn btn-success pull-left">Update</button>   
                                 <button id='cancel' type="button" class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button>
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
   function readURL(input) 
   {
      if (input.files && input.files[0]) 
      {
         var reader = new FileReader();
         reader.onload = function (e) 
         {
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
      $('#edit_member_form').validate({
         rules: {
            first_name:{
               required:true
            },
            last_name : {
               required : true
            }, 
            email : {
               required : true,
               email:true
            }, 
            password:{
               required: true
            },
            mobile : {
               required: true,
               minlength:10,
               maxlength:10
            }
         },   
         messages:{
            first_name:{
               required:"Please enter first name"
            },
            last_name : {
               required : "Please enter last name"
            }, 
            email : {
               required : "Please enter email",
               email:"Please enter valid email"
            }, 
            password:{
               required:"Please enter password"
            },
            mobile : {
               required:  "Please enter mobile number",
               minlength: "Please enter valid mobile number",
               maxlength:"Please enter valid mobile number"
            }
         }
      });

      $('#cancel').click(function(){
            window.location.href = "<?php echo site_url('adminDashboard/list_projectgeneralManager'); ?>";
      });
    });
</script>
<script type="text/javascript">
   $(".toggle-password").click(function() 
   {
      // alert('sd');
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      var x = document.getElementById("password");
      if (x.type === "password") 
      {
         x.type = "text";
      } 
      else 
      {
         x.type = "password";
      }
   });
</script>