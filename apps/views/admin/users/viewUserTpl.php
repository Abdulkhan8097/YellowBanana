<div id="page-wrapper">
  <?php $this->load->view('admin/_topmessage'); ?>


<div class="row">
  <div class="col-md-12 col-sm-12 useraddform">
    <div class="panel panel-default" style="margin-top:-30px">
      <div class="panel-heading">
          <?php if($userDetail[0]->profile_picture != "" && file_exists($userPath)){ 
            $htmlpath = base_url()."assets/upload/users/$userId/".$userDetail[0]->profile_picture."?dummy=".generateKey(5);
            echo "<div><img src='".$htmlpath."' height='90' width='110'/>";
             } ?>
        <b style="font-size:16px;">Users Detail</b>
        <a href="<?php echo site_url('adminUsers/index');?>" class="btn btn-warning pull-right">Back</a>
        <div class="clearfix"></div>
      </div>
      <div class="panel-body">
     
	    <div class="col-md-10 col-sm-10">
      <table class="table table-bordered">
      <tbody>
        <tr>
            <td width="25%"><label> First Name:</label></td>
          <td><?php echo ucfirst($userDetail[0]->fname); ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Last Name:</label></td>
          <td><?php echo ucfirst($userDetail[0]->lname); ?>	</td>
        </tr>

        <tr>
          <td><label  for="requestid">Email:</label></td>
          <td><?php echo $userDetail[0]->email; ?>	</td>
        </tr>

        <tr>
          <td><label  for="requestid">Company:</label></td>
          <td><?php if($userDetail[0]->consultant_company != "") echo $userDetail[0]->consultant_company; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>

        <tr>
          <td><label  for="requestid">Department:</label></td>
          <td><?php if($userDetail[0]->department == 0) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-"; } else { echo ucfirst($userDetail[0]->department);} ?></td>
        </tr>

        <tr>
          <td><label  for="requestid">Country:</label></td>
          <td><?php if($userDetail[0]->country != "") echo $userDetail[0]->country; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-"; ?></td>
        </tr>

        <tr>
          <td><label  for="requestid">State:</label></td>
          <td><?php if($userDetail[0]->state != "") echo $userDetail[0]->state; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?></td>
        </tr>

        <tr>
          <td><label  for="requestid">City:</label></td>
          <td><?php if($userDetail[0]->city != "") echo $userDetail[0]->city; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?></td>
        </tr>

        <tr>
          <td><label  for="requestid">Physical Location:</label></td>
          <td><?php if($userDetail[0]->physical_location != "") echo $userDetail[0]->physical_location; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?></td>
        </tr>
        <tr>
          <td><label  for="requestid">Street Address:</label></td>
          <td><?php if($userDetail[0]->street_address != "") echo $userDetail[0]->street_address; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Zipcode:</label></td>
          <td><?php if($userDetail[0]->zipcode != "") echo $userDetail[0]->zipcode; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Other:</label></td>
          <td><?php if($userDetail[0]->other != "") echo $userDetail[0]->other; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Organization:</label></td>
          <td><?php if($userDetail[0]->organization != "") echo $userDetail[0]->organization; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Consultant Company:</label></td>
          <td><?php if($userDetail[0]->consultant_company != "") echo $userDetail[0]->consultant_company; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Primary Org Unit:</label></td>
          <td><?php if($userDetail[0]->primary_org_unit != "") echo $userDetail[0]->primary_org_unit; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
<!--        <tr>
          <td><label  for="requestid">Professional Status:</label></td>
          <td><?php if($userDetail[0]->professional != "") echo $userDetail[0]->professional; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>-->
        <tr>
          <td><label  for="requestid">Date of birth:</label></td>
          <td><?php if($userDetail[0]->dob != "") echo $userDetail[0]->dob; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
<!--        <tr>
          <td><label  for="requestid">Date of hire:</label></td>
          <td><?php if($userDetail[0]->doh != "") echo $userDetail[0]->doh; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>-->
        <tr>
          <td><label  for="requestid">Type Of Account:</label></td>
          <td><?php if($userDetail[0]->type_account != "") echo $userDetail[0]->type_account; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Bio:</label></td>
          <td><?php if($userDetail[0]->bio != "") echo $userDetail[0]->bio; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?></td>
        </tr>
        <tr>
          <td><label  for="requestid">Background:</label></td>
          <td><?php if($userDetail[0]->background != "") echo $userDetail[0]->background; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Created Date:</label></td>
          <td><?php if($userDetail[0]->created_date != "") echo $userDetail[0]->created_date; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Last Login:</label></td>
          <td><?php if($userDetail[0]->last_login != "") echo $userDetail[0]->last_login; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Office Phone:</label></td>
          <td><?php if($userDetail[0]->office_phone != "") echo $userDetail[0]->mobile_phone; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Phone:</label></td>
          <td><?php if($userDetail[0]->office_phone != "") echo $userDetail[0]->office_phone; else echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-";  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Extension:</label></td>
          <td><?php if($userDetail[0]->extension != "") echo $userDetail[0]->extension;  ?>	</td>
        </tr>
        <tr>
          <td><label  for="requestid">Status:</label></td>
          <td><?php if($userDetail[0]->status == 0) echo "Inactive"; else echo "Active"; ?>	</td>
        </tr>


      
      </tbody>
      </table>
 </div>

     
      </div>
    </div>
  </div>
</div>
</div>
<div class="clear"></div>