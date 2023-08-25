<div id="page-wrapper">
  <?php $this->load->view('admin/_topmessage'); ?>


<div class="row">
  <div class="col-md-12 col-sm-12 useraddform">
    <div class="panel panel-default" style="margin-top:-30px">
      <div class="panel-heading">         
        <b style="font-size:16px;">Update User Details</b>
        <a href="<?php echo site_url('adminUsers/index');?>" class="btn btn-warning pull-right">Back</a>
        <div class="clearfix"></div>
      </div>
      <div class="panel-body">
          <form action="<?php echo site_url('adminUsers/updateUser?id='.$userId);?>" method="post" name="editUserForm" id="editUserForm" enctype="multipart/form-data">
	    <div class="col-md-10 col-sm-10">
      <table class="table table-bordered">
      <tbody>
        <tr>
            <td width="25%"><label>User Image:</label></td>
          <td>
              <input type="file" id="file_upload" name="file_upload" style='height:20px;' >
                <div id="divUploadedImages" style="float:left; padding-left: 4px;">
                <?php
               
                        if($userDetail->profile_picture != "" && file_exists($userPath)){
                                $htmlpath = base_url()."assets/upload/users/$userId/".$userDetail->profile_picture."?dummy=".generateKey(5);
                                echo "<div><img src='".$htmlpath."' height='70' width='70'/><br/>
                                <center> <a href='javascript: void(0)' onclick=\"javascript: deleteSaveImage($userId)\" style='color:#015D9D; font-size:11px;' >Delete</a></center><br><br>
                                </div>";
                        }
                ?>
                </div>
          </td>
        </tr>
        <tr>
            <td width="25%"><label> First Name:</label></td>
          <td><input type="text" class="form-control" size="25" value="<?php echo $userDetail->fname; ?>" id="user_fname" name="user_fname">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Last Name:</label></td>
          <td><input type="text" class="form-control" size="25" value="<?php echo $userDetail->lname; ?>" id="user_lname" name="user_lname"></td>
        </tr>

        <tr>
          <td><label  for="requestid">Email:</label></td>
          <td><input type="text" readonly="readonly" class="form-control" size="80" value="<?php echo $userDetail->email; ?>" id="email" name="email"></td>
        </tr>

        <tr>
          <td><label  for="requestid">Company:</label></td>
          <td>
              <select id="txtCompany" name="txtCompany" class="form-control">
                <option value="">Select</option>
                <?php 
                        if(count($companyArray)>0){
                                foreach($companyArray AS $cobj){
                ?>
                        <option value="<?php echo $cobj->id;?>" <?php if($userDetail->company_id == $cobj->id) { ?> selected="selected" <?php } ?>>&nbsp;<?php echo $cobj->name;?></option>
                <?php
                        }
                }
                ?>
        </select>
          </td>
        </tr>

        <tr>
          <td><label  for="requestid">Department:</label></td>
          <td>
              <select id="txtDepartment" name="txtDepartment" class="form-control">
                    <option value="">Select</option>
                    <?php 
                            if(count($departmentArray)>0){
                                    foreach($departmentArray AS $cobj){
                    ?>
                            <option value="<?php echo $cobj->id;?>" <?php if($userDetail->department_id == $cobj->id) { ?> selected="selected" <?php } ?>>&nbsp;<?php echo $cobj->name;?></option>
                    <?php
                            }
                    }
                    ?>
            </select>
          </td>
        </tr>

        <tr>
          <td><label  for="requestid">Country:</label></td>
          <td>
              <select id="txtCountry" name="txtCountry" class="form-control">
                    <option value="">Select</option>
                    <?php 
                            if(count($countryArray)>0){
                                    foreach($countryArray AS $cobj){
                    ?>
                            <option value="<?php echo $cobj->id;?>" <?php if($userDetail->country_id == $cobj->id) { ?> selected="selected" <?php } ?>>&nbsp;<?php echo $cobj->name;?></option>
                    <?php
                            }
                    }
                    ?>
            </select>
          </td>
        </tr>

        <tr>
          <td><label  for="requestid">State:</label></td>
          <td>
              <div id="divState">
                <select id="state" name="state" class="form-control">
                        <option value=""> Select </option>												
                <?php 
                        if(count($stateArray)>0){
                                foreach($stateArray AS $cobj){
                ?>
                                <option value="<?php echo $cobj->id;?>" <?php if($userDetail->state_id == $cobj->id){ echo 'selected="selected"';}?>>&nbsp;<?php echo $cobj->name;?></option>
                <?php
                        }
                }
                ?>
                </select>
                </div>
          </td>
        </tr>

        <tr>
          <td><label  for="requestid">City:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->city; ?>" id="city" name="city"></td>
        </tr>

        <tr>
          <td><label  for="requestid">Physical Location:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->physical_location; ?>" id="physical_location" name="physical_location"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Street Address:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->street_address; ?>" id="street_address" name="street_address"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Zipcode:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->zipcode; ?>" id="zipcode" name="zipcode"></td>
        </tr>
        
        <tr>
          <td><label  for="requestid">Organization:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->organization; ?>" id="organization" name="organization">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Consultant Company:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->consultant_company; ?>" id="consultant_company" name="consultant_company"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Primary Org Unit:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->primary_org_unit; ?>" id="primary_org_unit" name="primary_org_unit">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Professional Status:</label></td>
          <td>
          <select id="professional_status" name="professional_status" class="form-control">
                    <option value="">Select</option>
                    <?php

                        if(count($pstatusArray)>0){
                                foreach($pstatusArray AS $pObj){
                        ?>
                        <option value="<?php echo $pObj->id;?>" <?php if($userDetail->professional_status == $pObj->id){ echo 'selected="selected"';}?>><?php echo $pObj->name;?></option>
                        <?php
                                }
                                        }
                        ?>


          </select>
          </td>
        </tr>
        <tr>
          <td><label  for="requestid">Date of birth:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->dob; ?>" id="dob" name="dob"></td>
        </tr>
<!--        <tr>
          <td><label  for="requestid">Date of hire:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->doh; ?>" id="doh" name="doh">	</td>
        </tr>-->
        <tr>
          <td><label  for="requestid">Type Of Account:</label></td>
          <td>
             <select  id="usertype" name="usertype" class="form-control">
                 <option value=""> Select </option>
                 <?php foreach($resonforjoinArr as $joinTypedetail){ ?>
                <option  value="<?php echo $joinTypedetail->id ?>" <?php echo $userDetail->type_account_id==$joinTypedetail->id ? 'selected' : ''; ?> ><?php echo $joinTypedetail->name; ?></option>
                <?php } ?>

            </select>
          </td>
        </tr>
        <tr>
          <td><label  for="requestid">Bio:</label></td>
          <td>
              <textarea cols="58" rows="10" class="form-control" id="bio" name="bio"><?php echo $userDetail->bio; ?></textarea>
          </td>
        </tr>
        
        
        <tr>
          <td><label  for="requestid">Office Phone:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->office_phone; ?>" id="office_phone" name="office_phone">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Phone:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->office_phone; ?>" id="office_phone" name="office_phone">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Extension:</label></td>
          <td><input type="text" class="form-control" size="80" value="<?php echo $userDetail->extension; ?>" id="extension" name="extension"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Status:</label></td>
          <td><select class="form-control" id="user_status" name="user_status">
            <option value="1" <?php if($userDetail->status == 1) { ?> selected="selected" <?php } ?>>Active</option>
            <option value="0" <?php if($userDetail->status == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
          </select>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <div class="col-md-4 col-md-offset-5">
              <button type="submit" class="btn btn-success"  value="Submit" name="submit">Submit </button>
              <a href="<?php echo site_url('adminUsers/index'); ?>" class="btn btn-primary">Back </a>
            </div>
          </td>
        </tr>

      </tbody>
      </table>
 </div>
            </form>

      </div>
    </div>
  </div>
</div>
</div>
<div class="clear"></div>



<script>
var stateURL = "<?php echo site_url("adminUsers/ajaxGetState"); ?>";
newj(document).ready(function() {
	newj("#editUserForm").validate({
		rules: {
			user_fname: {
				required: true,
				rangelength: [2,50]
			},
			user_lname: {
				required: true,
				rangelength: [2,50]
			},
			user_password: {
				required: true,
				rangelength: [2,50]
			},			
			professional_status: {
				required: true
			},
				
			organization: {
				required: true,
				rangelength: [2,100]
			},
			zipcode: {
				required: true,
				number: true
			}
		},
		messages: {
			user_fname: {
				required: " Please enter a First Name"
			},
			user_lname: {
				required: " Please enter a Last Name"
			},
			user_password: {
				required: " Please enter a Password"
			},			
			professional_status: {
				required: " Please select Professional Status"
			},
					
			organization: {
				required: " Please enter organization",				
			},
			zipcode:{
				required: " Please enter Zip",
				number: " Zip should be numeric only"
			}
		}				
	});


	$("#txtCountry").change(function() {
		var countryId = this.value;
		$.ajax({
		    type: "POST",
		    url: stateURL,
		    data: {countryId: countryId},
		    success: function (data){
				if(data != ""){								
					$("#divState").html(data);
				}
		    }
		});
	});

	

	
});
function deleteSaveImage(userId){
	if(confirm("Are you sure you want to remove this image?")){
		$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('adminUsers/deleteUserImage');?>",
			data: {userId: userId},
	        success: function (data){
	        //    alert(data);
	            $("#divUploadedImages").html("");
	        }
	    });
	}
}
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script>
