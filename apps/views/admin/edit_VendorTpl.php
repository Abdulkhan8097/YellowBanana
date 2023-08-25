<style>
label.error{
   color:red;
}
</style>
<?php
    // print_r($userdata);
    // die;
?>
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Vendor</div>                       
                    </div>
                    
                    <div class="card-body col-lg-10">
                    <?php $this->load->view('admin/_topmessage'); ?>
                        <!-- <div class="col-lg-8"> -->
                            <form class="card" id='add_vendor_form' method='post' action="<?php echo site_url('adminDashboard/edit_vendor'); ?>" enctype='multipart/form-data'>            
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="fullname" placeholder="Full Name" value="<?php echo $userdata['vendor_name'] ; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile</label>
                                                <input type="number" class="form-control"  name="mobile" placeholder="Mobile"  value="<?php echo $userdata['mobile_no'] ; ?>">
                                            </div>
                                        </div>
                                     
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Email address</label>
                                                <input type="email" class="form-control" name="email"   placeholder="Email"  value="<?php echo $userdata['email'] ; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Company</label>
                                                <input type="text" class="form-control" name="company"   placeholder="Company Name"  value="<?php echo $userdata['company'] ; ?>">
                                            </div>
                                        </div>

                                        <?php 
                                            $adminSession = $this->session->userdata('adminSession');
                                            $userType =  $this->adminSession['usertype'];
                                            $userid =  $this->adminSession['user_id'];
                                            if($userType == 'admin')
                                            {
                                                ?>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Area Manager</label>
                                                        <select class="form-control" name='parentid' >
                                                            <option value="">Select</option>
                                                            <?php 
                                                                for($i=0;$i<sizeof($area_manager);$i++)
                                                                {
                                                                    $selected = $area_manager[$i]['id'] ==$userdata['parent_id'] ? 'selected' : ''; 
                                                                    ?>
                                                                    <option value="<?php echo $area_manager[$i]['id'] ;?>" <?php echo $selected ; ?>><?php echo ucwords($area_manager[$i]['fname'])." ".ucwords($area_manager[$i]['lname']) ;?></option>
                                                                    <?php
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
                                                <input type="hidden" value="<?php echo  $userid ; ?>" name="parentid">
                                                <?php 
                                            }
                                        ?>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" placeholder="addess" name='address'><?php echo $userdata['address'] ; ?></textarea>                                                
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
                                                            $selected = $userdata['state'] == $state[$i]['id'] ? 'selected' : '';
                                                            echo "<option value='".$state[$i]['id']."' ".$selected." >".$state[$i]['name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                     
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="City"  name="city"  value="<?php echo $userdata['city'] ; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Postal Code</label>
                                                <input type="number" class="form-control"  name="postal_code" placeholder="ZIP Code"  value="<?php echo $userdata['pincode'] ; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">PAN No.</label>
                                                <input type="text" class="form-control"  name="pan" placeholder="PAN Number"  value="<?php echo $userdata['pan'] ; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">GST No.</label>
                                                <input type="text" class="form-control"  name="gst" placeholder="GST Number"  value="<?php echo $userdata['gst_no'] ; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control select2-show-search"  id='status' name='status'>
                                                    <!-- <option value=""></option> -->

                                                    <option value="1" <?php echo $userdata['status']=='1' ? "selected" : "" ;?>>Active</option>
                                                    <option value="0" <?php echo $userdata['status']=='0' ? "selected" : "" ;?>>Inactive</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
 

                                        
                                  </div>
                               </div>
                               <?php 
                                    $adminSession = $this->session->userdata('adminSession');
                                    // print_r($adminSession['user_id']);

                                ?>
                               <div class="card-footer text-right">
                                  <input type = 'hidden' name='vendor_id' value="<?php echo $userdata['vendor_id'];?>">                            
                                  <input type = 'hidden' name='parent_id' value="<?php echo $adminSession['user_id'];?>">                            
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){

      //pan
      $.validator.addMethod("pan", function(value, element)
      {
          return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
      }, "Please enter a valid PAN");


      // alert('df');
      $('#add_vendor_form').validate({
         rules: {
            fullname:{
               required:true
            },
            email : {
               required : true,
               email:true
            }, 
            mobile : {
               required: true,
               minlength:10,
               maxlength:10
            },
            postal_code :{
              minlength:6,
              maxlength:6
            },
            pan:{
              pan: true
            }
         },   
         messages:{
            first_name:{
               required:"Please enter first name"
            },
            email : {
               required : "Please enter email",
               email:"Please enter valid email"
            },
            mobile : {
               required:  "Please enter mobile number",
               minlength: "Please enter valid mobile number",
               maxlength:"Please enter valid mobile number"
            },
            postal_code :{
                minlength: "Please enter valid zipcode",
                maxlength: "Please enter valid zipcode"
            },
            pan:{
              pan : "Please enter valid PAN number" 
            }
         }
      });

      //cancel
      $('#cancel').click(function(){
            window.location.href = "<?php echo site_url('adminDashboard/list_vendor'); ?>";
      });

    });
</script>