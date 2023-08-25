<div class="app-content  my-3 my-md-5">
   <div class="side-app">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">View Outlets</h3>
               </div>
 
               <div class="card-body col-lg-10">
                  <?php $this->load->view('admin/_topmessage'); ?>
                  
                  <div class="table-responsive" style="overflow-x: none!important;">
                      <table class="table table-bordered">
                      <tbody>
                        <tr>
                            <td width="25%"><label>Brand Name:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->brand_name); ?>	</td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">Address:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->address); ?>	</td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">Area Manager:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->first_name ." ". $outletsEdit[0]->last_name); ?>  </td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">Location:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->loc_name); ?>  </td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">State:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->state_name); ?>  </td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">City:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->city); ?>  </td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">Postal Code:</label></td>
                          <td><?php echo ucfirst($outletsEdit[0]->pincode); ?>  </td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">Photo:</label></td>
                          <td>
                            <?php
                                if($outletsEdit[0]->logo_name !='')
                                {
                                   ?>
                                   <img  id='preview' alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="<?php echo base_url();?>/assets/upload/outlets/<?php echo $outletsEdit[0]->logo_name;?>"/>
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
                          </td>
                        </tr>
                        <tr>
                          <td><label  for="requestid">Status:</label></td>
                          <td>
                            <?php if($outletsEdit[0]->category_status == 1){ ?>
                              <label  for="requestid">Active</label>
                            <?php } else if($outletsEdit[0]->category_status == 0){ ?>
                              <label  for="requestid">Inactive</label>
                            <?php } ?>
                          </td>
                        </tr>
                      </tbody>
                      </table>
                  </div>                        
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php $this->load->view('admin/footer'); ?>
</div>