<div class="app-content  my-3 my-md-5">
 <div class="side-app">
  <div class="row">
   <div class="col-md-12 col-lg-12">
    <div class="card">
     <div class="card-header">
      <h3 class="card-title">View Order</h3>

      <div class="card-options"><a href="<?php echo site_url('porders/'); ?>" class="btn btn-success btn-sm  float-right"> << Back </a></div>
    </div>

    <div class="card-body col-lg-10">
      <?php $this->load->view('admin/_topmessage'); ?>
      <?php //echo"<pre>"; print_r($result[0]); echo "</pre>"; ?>

      <div class="table-responsive" style="overflow-x: none!important;">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td width="25%"><label>Brand Name:</label></td>
              <td><?php echo ucfirst($result[0]['brand_name']); ?> </td>
            </tr>
            <tr>
              <td><label  for="requestid">Party Name:</label></td>
              <td><?php echo ucfirst($result[0]['vendorname']); ?>  </td>
            </tr>
            <tr>
              <td><label  for="requestid">Task Details:</label></td>
              <td><?php echo ucfirst($result[0]['task_details']); ?>  </td>
            </tr>
            <tr>
              <td><label  for="requestid">Amount:</label></td>
              <td><?php echo ucfirst($result[0]['amount']); ?>  </td>
            </tr>
            <tr>
              <td><label  for="requestid">Description:</label></td>
              <td>
                <?php $explode = explode(',', $result[0]['description']);
                foreach ($explode as $key => $value) {?>
                  <li><?php echo ucfirst($value);?></li>
                <?php }?>
              </td>
            </tr>
            <tr>
              <td><label  for="requestid">Tax Slab:</label></td>
              <td><?php echo ucfirst($result[0]['taxname']); ?>  </td>
            </tr>
            <tr>
              <td><label  for="requestid">Priority:</label></td>
              <td><?php echo ucfirst($result[0]['order_priority']); ?>  </td>
            </tr>
            <tr>
              <td><label  for="requestid">Status:</label></td>
              <td>
                <?php echo ucfirst($result[0]['order_status']); ?>  
              </td>
            </tr>
            <tr>
              <td><label  for="requestid">Created Date:</label></td>
              <td>
                <?php echo displayDateTime($result[0]['order_date']); ?>  
              </td>
            </tr>
            <tr>
              <td><label  for="requestid">Attached Document:</label></td>
              <td>
                <?php
                if($result[0]['document_name'] != "")
                {      
                  echo "<a target='_blank' href='".base_url()."assets/upload/poorder/".$result[0]['document_name']."'>".$result[0]['document_name']."</a>";
                                // echo ucfirst($result[0]['order_status']); 
                }
                else
                {
                  echo "";
                }
                ?>  
              </td>
            </tr>
            <?php
            $adminSession = $this->session->userdata('adminSession');
                          // print_r($adminSession);
            $usertype = $adminSession['usertype'];
            if($usertype == 'accountant')
            {
              ?>
              <tr>
                <td>Admin Comment</td>
                <td><?php echo $result[0]['director_comment'] ; ?></td>
              </tr>
              <?php
            }

            if($usertype == 'admin')
            {
              ?>
              <tr>
                <td>General Manager Comment</td>
                <td><?php echo $result[0]['gm_comment'] ; ?></td>
              </tr>
              <tr>
                <td>Accountant Comment</td>
                <td><?php echo $result[0]['accountant_comment'] ; ?></td>
              </tr> 
              <?php
            }

            ?>
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