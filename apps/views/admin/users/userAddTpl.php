<div id="page-wrapper">
  <?php $this->load->view('admin/_topmessage'); ?>


<div class="row">
  <div class="col-md-12 col-sm-12 useraddform">
    <div class="panel panel-default" style="margin-top:-30px">
      <div class="panel-heading">
        <b style="font-size:16px;">Add New User</b>
        <a href="<?php echo site_url('adminUsers/index');?>" class="btn btn-warning pull-right">Back</a>
        <div class="clearfix"></div>
      </div>
      <div class="panel-body">
          <form action="<?php echo site_url('adminUsers/registerNewUser');?>" method="post" name="addUserForm" id="addUserForm" enctype="multipart/form-data">
	    <div class="col-md-10 col-sm-10">
      <table class="table table-bordered">
      <tbody>
        <tr>
            <td width="25%"><label>User Image:</label></td>
          <td>

              <input type="file" id="file_upload" name="file_upload" style='height:20px;' >
                
          </td>
        </tr>
        <tr>
            <td width="25%"><label> First Name:</label></td>
          <td><input type="text" class="form-control" size="25" value="" id="user_fname" name="user_fname" required="">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Last Name:</label></td>
          <td><input type="text" class="form-control" size="25" value="" id="user_lname" name="user_lname" required=""></td>
        </tr>

        <tr>
          <td><label  for="requestid">Email:</label></td>
          <td><input type="text"  class="form-control" size="80" value="" id="email" name="email" required=""></td>
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
                        <option value="<?php echo $cobj->id;?>" >&nbsp;<?php echo $cobj->name;?></option>
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
                            <option value="<?php echo $cobj->id;?>" >&nbsp;<?php echo $cobj->name;?></option>
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
                            <option value="<?php echo $cobj->id;?>" >&nbsp;<?php echo $cobj->name;?></option>
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
                                <option value="<?php echo $cobj->id;?>" >&nbsp;<?php echo $cobj->name;?></option>
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
          <td><input type="text" class="form-control" size="80" value="" id="city" name="city"></td>
        </tr>

        <tr>
          <td><label  for="requestid">Physical Location:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="physical_location" name="physical_location"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Street Address:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="street_address" name="street_address"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Zipcode:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="zipcode" name="zipcode"></td>
        </tr>

        <tr>
          <td><label  for="requestid">Organization:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="organization" name="organization">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Consultant Company:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="consultant_company" name="consultant_company"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Primary Org Unit:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="primary_org_unit" name="primary_org_unit">	</td>
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
                        <option value="<?php echo $pObj->id;?>"><?php echo $pObj->name;?></option>
                        <?php
                                }
                                        }
                        ?>
          </select>
          </td>
        </tr>
        <tr>
          <td><label  for="requestid">Date of birth:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="dob" name="dob"></td>
        </tr>
        
        <tr>
          <td><label  for="requestid">Type Of Account:</label></td>
          <td>
              <select  id="usertype" name="usertype" class="form-control">
                  <option value=""> Select </option>
                 <?php foreach($resonforjoinArr as $joinTypedetail){ ?>
                <option  value="<?php echo $joinTypedetail->id ?>"><?php echo $joinTypedetail->name; ?></option>
                <?php } ?>

            </select>
          </td>
        </tr>
        <tr>
          <td><label  for="requestid">Bio:</label></td>
          <td>
              <textarea cols="58" rows="10" class="form-control" id="bio" name="bio"></textarea>
          </td>
        </tr>


        <tr>
          <td><label  for="requestid">Office Phone:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="office_phone" name="office_phone">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Phone:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="office_phone" name="office_phone">	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Extension:</label></td>
          <td><input type="text" class="form-control" size="80" value="" id="extension" name="extension"></td>
        </tr>
        <tr>
          <td><label  for="requestid">Status:</label></td>
          <td><select class="form-control" id="user_status" name="user_status">
            <option value="1" >Active</option>
            <option value="0" >Inactive</option>
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
	newj("#addUserForm").validate({
		rules: {
			user_fname: {
				required: true,
				rangelength: [2,50]
			},
			user_lname: {
				required: true,
				rangelength: [2,50]
			},
			txtDepartment: {
			required: true,
			},
			user_password: {
				required: true,
				rangelength: [2,50]
			},
			email: {
				required: true,
				email: true,
				remote: {
                    url: "<?php echo site_url('dashboard/checkEmailExist');?>",
					type: "post"
                 }				
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
			txtDepartment:{
				required: " Please select department",
			},
			email: {
				required: " Please enter an Email Address",
				email: " This is not valid Email Address",
				remote: "&nbsp;&nbsp;Email already in use!"
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
